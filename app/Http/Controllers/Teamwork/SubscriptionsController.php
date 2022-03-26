<?php

namespace App\Http\Controllers\Teamwork;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
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
                'status' => true,
            ]);
        }
        return response([
            'status' => false,
            'message' => 'Please select a team to continue.'
        ]);
    }

    public function getSubscriptionProducts()
    {
        $key = \config('services.stripe.secret');
        $stripe = new \Stripe\StripeClient($key);
        $productsraw = $stripe->products->all([
            'active' => true
        ]);
        $products = $productsraw->data;

        foreach($products as &$product) {
            $plansRaw = $stripe->plans->all([
                'product' => $product->id
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
            'products' => $products
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
                    'email' => $user->email
                ]);
                $subscription->seats = $product->metadata->seats;
                $subscription->credits = $product->metadata->credits;
                $subscription->type = $product->metadata->is_team == 1 ? Team::PLAN_TYPE_TEAM : Team::PLAN_TYPE_BASIC;
                $subscription->amount = $plan->amount;
                $subscription->currency = $plan->currency;
                $subscription->interval = $plan->interval;
                $subscription->save();

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
                'error' => $e->getMessage()
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response([
                'status' => false,
                'message' => 'Error creating subscription.',
                'error' => $e->getMessage()
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
                    'subscription' => $user->currentTeam->currentSubscription()
                ]);
            }
            return response([
                'status' => false,
                'message' => 'You are not subscribed to any plan.'
            ]);
        }
        return response([
            'status' => false,
            'message' => 'Please select a team to continue.'
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
                    'subscription' => $user->currentTeam->currentSubscription()
                ]);
            }
            return response([
                'status' => false,
                'message' => 'You are not subscribed to any plan.'
            ]);
        }
        return response([
            'status' => false,
            'message' => 'Please select a team to continue.'
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
            'message' => 'You are not subscribed to any plan. Try subscribing to a new plan.'
        ]);
    }

    public function buySeats(Request $request)
    {
        $user = $request->user()->load('currentTeam');
        $currentSubscription = $user->currentTeam->currentSubscription();

        if ($currentSubscription->type != Team::PLAN_TYPE_TEAM) {
            return response([
                'status' => false,
                'message' => 'You need to subscribe to a team plan to buy additional seats.'
            ]);
        }

        $key = \config('services.stripe.secret');
        $stripe = new \Stripe\StripeClient($key);

        try {
            DB::beginTransaction();
            $plansraw = $stripe->plans->all([
                'active' => true,
                'product' => $currentSubscription->items->first()->stripe_product
            ]);
            $plans = $plansraw->data;
            for ($i=0; $i <= count($plans); $i++) {
                if ($plans[$i]->metadata->type == Team::AD_ON_SEAT && $plans[$i]->interval == $currentSubscription->interval) {
                    $similarAdOn = SubscriptionItem::query()
                        ->where('subscription_id', $currentSubscription->id)
                        ->where('stripe_price', $plans[$i]->id)
                        ->latest()
                        ->first();
                    if (is_null($similarAdOn)) {
                        $currentSubscription->addPriceAndInvoice($plans[$i]->id, $request->numberOfSeats);
                        $currentSubscription->items->where('stripe_price', $plans[$i]->id)->update('type', Team::AD_ON_SEAT);
                    } else {
                        $similarAdOn->type = Team::AD_ON_SEAT;
                        $similarAdOn->save();
                        $currentSubscription->incrementQuantity($request->numberOfSeats, $plans[$i]->id);
                    }
                    DB::commit();
                    return response([
                        'status' => true,
                        'subscription' => $user->currentTeam->currentSubscription()
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
                'error' => $e->getMessage()
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response([
                'status' => false,
                'message' => 'Error adding seats.',
                'error' => $e->getMessage()
            ]);
        }
    }
}
