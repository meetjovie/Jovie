<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SubscriptionInvoicePaidListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // Retrieve the invoice object
//        $invoice = $event->invoice;
//
//        // Determine the owner of the subscription
//        $owner = $invoice->owner;
//        // The owner is a Team
//        $subscription = $owner->subscription('team-monthly');
//        if ($subscription->stripe_plan == 'team-monthly-plan') {
//            // Set the team's credits to 100
//            $owner->credits = $subscription->credits;
//            $owner->save();
//        }
    }
}
