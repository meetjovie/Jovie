<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;
use Mpociot\Teamwork\TeamworkTeam;

class Team extends TeamworkTeam
{
    use Billable;

    public function currentSubscription()
    {
        $currentSubscription = $this->subscriptions()->first();
        if ($currentSubscription && $this->subscribed($currentSubscription->name)) {
            $key = \config('services.stripe.secret');
            $stripe = new \Stripe\StripeClient($key);
            $plan = $stripe->plans->retrieve($currentSubscription->stripe_price);
            $currentSubscription->interval = $plan->interval;
            $currentSubscription->currency = $plan->currency;
            $currentSubscription->amount = $plan->amount;
            $currentSubscription->meta = $plan->meta;
            return $currentSubscription;
        }
        return null;
    }
}
