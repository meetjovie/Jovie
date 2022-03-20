<?php

namespace App\Http\Controllers\Teamwork;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    public function getSubscriptionPlans()
    {
        $key = \config('services.stripe.secret');
        $stripe = new \Stripe\StripeClient($key);
        $plansraw = $stripe->plans->all();
        $plans = $plansraw->data;

        foreach($plans as &$plan) {
            $prod = $stripe->products->retrieve(
                $plan->product,[]
            );
            $plan->product = $prod;
        }
        return response([
            'status' => true,
            'plans' => $plans
        ]);
    }
    public function subscribe(Request $request)
    {
        $user = $request->user()->load('currentTeam');
        $paymentMethod = $request->paymentMethod;
        $plan = $request->selectedPlan;
        if ($user->currentTeam) {
            $user->currentTeam->createOrGetStripeCustomer();
            $user->currentTeam->addPaymentMethod($paymentMethod);
            $user->currentTeam->updateDefaultPaymentMethod($paymentMethod);
            try {
                $user->currentTeam->newSubscription('default', $plan)->create($paymentMethod, [
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
}
