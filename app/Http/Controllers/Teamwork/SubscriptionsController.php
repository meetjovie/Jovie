<?php

namespace App\Http\Controllers\Teamwork;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Team;
use App\Models\User;
use Illuminate\Validation\ValidationException;
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
        $coupon = $request->coupon;

        if (!empty($coupon)) {
            $coupon = $this->validateCoupon($coupon, $user);
            if (!$coupon) {
                throw ValidationException::withMessages([
                    'coupon' => ['Invalid coupon code.']
                ]);
            }
        }
        return $this->subscribeTeam($product, $plan, $paymentMethod, $coupon, $user);
    }

    public function validateCoupon($coupon, $user)
    {
        return $user->currentTeam->findPromotionCode($coupon);
    }

    public function subscribeTeam($product, $plan, $paymentMethod, $coupon, $user)
    {
        $key = \config('services.stripe.secret');
        $stripe = new \Stripe\StripeClient($key);
        try {
            $product = $stripe->products->retrieve($product);
            $plan = $stripe->plans->retrieve($plan);
            if ($user->currentTeam) {
                $subscription = $user->currentTeam->subscribeTeam($paymentMethod, $coupon, $product, $plan);
                if ($subscription) {
                    return response([
                        'status' => true,
                        'message' => 'You are subscribed',
                        'subscription' => $subscription,
                    ]);
                } else {
                    return response([
                        'status' => false,
                        'message' => 'Error creating subscription.',
                        'error' => $e->getMessage(),
                    ]);
                }
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

    public function subscriptionStats(Request $request)
    {
        $user = $request->user()->load('currentTeam');
        if ($user->currentTeam) {
            $teamContacts = Contact::getAllContactsCount();
            $currentSubscription = $user->currentTeam->currentSubscription();
            if ($currentSubscription) {
                $stats = [
                    [
                        'name' => 'Contacts',
                        'stat' => $teamContacts >= $currentSubscription->contacts ? $currentSubscription->contacts : $teamContacts,
                        'limit' => $currentSubscription->contacts,
                        'description' => 'The number of people you can add to your CRM. This limit',
                        'totalContacts' => $teamContacts,
                        'reached' => $teamContacts > $currentSubscription->contacts,
                        'message' => "Your contact limit is reached. Please upgrade to acces your" . ($teamContacts - $currentSubscription->contacts ?: null) . " other contacts.",
                    ],
                    [
                        'name' => 'AI Credits',
                        'stat' => '100',
                        'limit' => '500',
                        'description' => 'AI Credits are used when you use our AI features such as AI Feilds, or AI copywriting.',
                    ],
                    [
                        'name' => 'Enrichment Credits',
                        'stat' => $currentSubscription->credits - ($currentSubscription->credits - $user->currentTeam->credits) ?? 0,
                        'limit' => $currentSubscription->credits,
                        'description' => 'Enrichment credits are used everytime you enrich a contact.',
                    ],
                ];

                foreach($stats as &$stat){
                    if ($stat['name'] === 'Contacts') {
                        $stat['progressBar'] = round((($stat['limit'] - $stat['stat']) / $stat['limit']) * 100);
                    } else {
                        $stat['progressBar'] = round(($stat['stat'] / $stat['limit']) * 100);
                    }
                }
                
                return response([
                    'status' => true,
                    'data' => $stats,
                    'message' => 'Stats for current team.',
                ]);
            }
        }

        return response([
            'status' => false,
            'message' => 'Stats are not available.',
        ]);
    }

    public function changeSubscription(Request $request)
    {
        $user = $request->user()->load('currentTeam');
        $paymentMethod = $request->paymentMethod;
        $plan = $request->selectedPlan;
        $product = $request->selectedProduct;
        $coupon = $request->coupon;

        if (!empty($coupon)) {
            $coupon = $this->validateCoupon($coupon, $user);
            if (!$coupon) {
                throw ValidationException::withMessages([
                    'coupon' => ['Invalid coupon code.']
                ]);
            }
        }

        $currentSubscription = $user->currentTeam->currentSubscription(false);
        if ($currentSubscription) {
            $user->currentTeam->subscription($currentSubscription->name)->cancelNow();
            return $this->subscribeTeam($product, $plan, $paymentMethod, $coupon, $user);
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
}
