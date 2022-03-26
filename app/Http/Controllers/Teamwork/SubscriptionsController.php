<?php

namespace App\Http\Controllers\Teamwork;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
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
            $plans = $plansRaw->data;
            $product->plans = $plans;
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
            $product = $stripe->products->retrieve($product);
            $plan = $stripe->plans->retrieve($plan);
        } catch (ApiErrorException $e) {
            return response([
                'status' => false,
                'message' => 'Error creating subscription.',
                'error' => $e->getMessage()
            ]);
        }
        if ($user->currentTeam) {
            $customer = $user->currentTeam->createOrGetStripeCustomer();
            $user->currentTeam->addPaymentMethod($paymentMethod);
            $user->currentTeam->updateDefaultPaymentMethod($paymentMethod);
            try {
                $subscription = $user->currentTeam->newSubscription($product->name, $plan->id)->create($customer->invoice_settings->default_payment_method, [
                    'email' => $user->email
                ]);
                $subscription->seats = $product->metadata->seats;
                $subscription->credits = $product->metadata->credits;
                $subscription->amount = $plan->amount;
                $subscription->currency = $plan->currency;
                $subscription->interval = $plan->interval;
                $subscription->save();
                return response([
                    'status' => true,
                    'message' => 'You are subscribed',
                    'subscription' => $subscription
                ]);
            } catch (\Exception $e) {
                return response([
                    'status' => false,
                    'message' => 'Error creating subscription.',
                    'error' => $e->getMessage()
                ]);
            }
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
}
