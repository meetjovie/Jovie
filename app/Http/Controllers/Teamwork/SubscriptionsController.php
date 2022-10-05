<?php

namespace App\Http\Controllers\Teamwork;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use Stripe\BillingPortal\Session;
use Stripe\Stripe;
use function Clue\StreamFilter\fun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\SubscriptionItem;
use Stripe\Exception\ApiErrorException;

class SubscriptionsController extends Controller
{
    public function paymentIntent(Request $request)
    {
        $user = $request->user()->load('currentTeam');
        if ($user->currentTeam) {
            return response([
                'intent' => $user->currentTeam->createSetupIntent(),
                'stripeKey' => config('services.stripe.key'),
                'status' => true,
            ]);
        }

        return response([
            'status' => false,
            'message' => 'Please select a team to continue.',
        ]);
    }

    public function getSubscriptionProducts()
    {
        $key = \config('services.stripe.secret');
        $stripe = new \Stripe\StripeClient($key);
        $productsraw = $stripe->products->all([
            'active' => true,
        ]);
        $products = $productsraw->data;

        $products = array_filter($products, function ($product) {
            return $product->metadata->is_featured == 1;
        });
        foreach ($products as &$product) {
            $plansRaw = $stripe->plans->all([
                'product' => $product->id,
            ]);

            $plans = collect($plansRaw->data);
            $finalPlans = [];
            foreach ($plans as $plan) {
                if ($plan->metadata->type != Team::AD_ON_SEAT) {
                    $finalPlans[] = $plan;
                }
            }
            $product->plans = $finalPlans;
        }

        return response([
            'status' => true,
            'products' => $products,
        ]);
    }

    public function subscribe(Request $request)
    {
        $user = $request->user()->load('currentTeam');
        $paymentMethod = $request->paymentMethod;
        $plan = $request->selectedPlan;
        $product = $request->selectedProduct;

        return $this->subscribeTeam($product, $plan, $paymentMethod, $user);
    }

    public function subscribeTeam($product, $plan, $paymentMethod, $user)
    {
        $key = \config('services.stripe.secret');
        $stripe = new \Stripe\StripeClient($key);
        try {
            DB::beginTransaction();
            $product = $stripe->products->retrieve($product);
            $plan = $stripe->plans->retrieve($plan);
            if ($user->currentTeam) {
                $customer = $user->currentTeam->createOrGetStripeCustomer();
                $user->currentTeam->addPaymentMethod($paymentMethod);
                $user->currentTeam->updateDefaultPaymentMethod($paymentMethod);

                $subscription = $user->currentTeam->newSubscription($product->name, $plan->id)->create($customer->invoice_settings->default_payment_method, [
                    'email' => $user->email,
                ]);
                $subscription->seats = $product->metadata->seats;
                $subscription->credits = $product->metadata->credits;
                $subscription->type = $product->metadata->is_team == 1 ? Team::PLAN_TYPE_TEAM : Team::PLAN_TYPE_BASIC;
                $subscription->amount = $plan->amount;
                $subscription->currency = $plan->currency;
                $subscription->interval = $plan->interval;
                $subscription->save();

                $user->currentTeam->addCredits($subscription->credits);
                $item = $subscription->items->first();
                $item->type = $product->metadata->type == 1 ? Team::AD_ON_SEAT : null;
                $item->save();
                DB::commit();

                return response([
                    'status' => true,
                    'message' => 'You are subscribed',
                    'subscription' => $subscription,
                ]);
            }
        } catch (ApiErrorException $e) {
            DB::rollBack();

            return response([
                'status' => false,
                'message' => 'Error creating subscription.',
                'error' => $e->getMessage(),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response([
                'status' => false,
                'message' => 'Error creating subscription.',
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function cancelSubscription(Request $request)
    {
        $user = $request->user()->load('currentTeam');
        if ($user->currentTeam) {
            $currentSubscription = $user->currentTeam->currentSubscription();
            if ($currentSubscription) {
                $user->currentTeam->subscription($currentSubscription->name)->cancel();

                return response([
                    'message' => 'Subscription cancelled. You can resume it during the grace period.',
                    'status' => true,
                    'subscription' => $user->currentTeam->currentSubscription(),
                ]);
            }

            return response([
                'status' => false,
                'message' => 'You are not subscribed to any plan.',
            ]);
        }

        return response([
            'status' => false,
            'message' => 'Please select a team to continue.',
        ]);
    }

    public function resumeSubscription(Request $request)
    {
        $user = $request->user()->load('currentTeam');
        if ($user->currentTeam) {
            $currentSubscription = $user->currentTeam->currentSubscription();
            if ($currentSubscription) {
                $user->currentTeam->subscription($currentSubscription->name)->resume();

                return response([
                    'message' => 'Subscription resumed.',
                    'status' => true,
                    'subscription' => $user->currentTeam->currentSubscription(),
                ]);
            }

            return response([
                'status' => false,
                'message' => 'You are not subscribed to any plan.',
            ]);
        }

        return response([
            'status' => false,
            'message' => 'Please select a team to continue.',
        ]);
    }

    public function changeSubscription(Request $request)
    {
        $user = $request->user()->load('currentTeam');
        $paymentMethod = $request->paymentMethod;
        $plan = $request->selectedPlan;
        $product = $request->selectedProduct;

        $currentSubscription = $user->currentTeam->currentSubscription();
        if ($currentSubscription) {
            $user->currentTeam->subscription($currentSubscription->name)->cancelNow();

            return $this->subscribeTeam($product, $plan, $paymentMethod, $user);
        }

        return response([
            'status' => false,
            'message' => 'You are not subscribed to any plan. Try subscribing to a new plan.',
        ]);
    }

    public function buySeats(Request $request)
    {
        if ($request->numberOfSeats < 1) {
            return response([
                'status' => false,
                'message' => 'Seats must be 1 or more.',
            ]);
        }
        $user = $request->user()->load('currentTeam');
        $currentSubscription = $user->currentTeam->currentSubscription();

        if ($currentSubscription->type != Team::PLAN_TYPE_TEAM) {
            return response([
                'status' => false,
                'message' => 'You need to subscribe to a team plan to buy additional seats.',
            ]);
        }

        $key = \config('services.stripe.secret');
        $stripe = new \Stripe\StripeClient($key);

        try {
            DB::beginTransaction();
            $plansraw = $stripe->plans->all([
                'active' => true,
                'product' => $currentSubscription->items->first()->stripe_product,
            ]);
            $plans = $plansraw->data;
            for ($i = 0; $i <= count($plans); $i++) {
                if ($plans[$i]->metadata->type == Team::AD_ON_SEAT && $plans[$i]->interval == $currentSubscription->interval) {
                    $similarAdOn = SubscriptionItem::query()
                        ->where('subscription_id', $currentSubscription->id)
                        ->where('stripe_price', $plans[$i]->id)
                        ->latest()
                        ->first();
                    if (is_null($similarAdOn)) {
                        $currentSubscription->addPriceAndInvoice($plans[$i]->id, $request->numberOfSeats);
                        DB::commit();
                        $currentSubscription->items->where('stripe_price', $plans[$i]->id)->first()->update(['type' => Team::AD_ON_SEAT]);
                    } else {
                        $similarAdOn->type = Team::AD_ON_SEAT;
                        $similarAdOn->save();
                        DB::commit();
                        $currentSubscription->incrementQuantity($request->numberOfSeats, $plans[$i]->id);
                    }

                    return response([
                        'status' => true,
                        'subscription' => $user->currentTeam->currentSubscription(),
                        'message' => 'Seats added to your plan.',
                    ]);
                }
            }

            return response([
                'status' => false,
                'message' => 'There are no add ons for seats in your package.',
            ]);
        } catch (ApiErrorException $e) {
            DB::rollBack();

            return response([
                'status' => false,
                'message' => 'Error adding seats.',
                'error' => $e->getMessage(),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response([
                'status' => false,
                'message' => 'Error adding seats.',
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function createCustomerPortalSession(Request $request)
    {
        $key = \config('services.stripe.secret');
        Stripe::setApiKey($key);
        $user = $request->user()->load('currentTeam');
        $customer = $user->currentTeam->createOrGetStripeCustomer();
        $session = Session::create([
            'customer' => $customer->id,
            'return_url' => config('app.url')
        ]);

        return response([
            'status' => true,
            'url' => $session->url
        ]);
    }
}
