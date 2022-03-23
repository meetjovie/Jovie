<?php

namespace App\Http\Controllers\Teamwork;

use App\Http\Controllers\Controller;
use App\Models\Team;
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

        $key = \config('services.stripe.secret');
        $stripe = new \Stripe\StripeClient($key);
        try {
            $product = $stripe->products->retrieve($product);
        } catch (ApiErrorException $e) {
            return response([
                'status' => false,
                'message' => 'Error creating subscription.',
                'error' => $e->getMessage()
            ]);
        }
        if ($user->currentTeam) {
            $user->currentTeam->createOrGetStripeCustomer();
            $user->currentTeam->addPaymentMethod($paymentMethod);
            $user->currentTeam->updateDefaultPaymentMethod($paymentMethod);
            try {
                $user->currentTeam->newSubscription($product->name, $plan)->create($paymentMethod, [
                    'email' => $user->email
                ]);
                return response([
                    'status' => true,
                    'message' => 'You are subscribed'
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
}
