<?php

namespace App\Listeners;

use App\Models\Team;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Events\WebhookReceived;

class StripeEventListener
{
    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(WebhookReceived $event)
    {
        try {
            if ($event->payload['type'] === 'invoice.payment_succeeded') {
                $customerId = $event->payload['data']['object']['customer'];
                $owner = Team::where('stripe_id', $customerId)->first();
                $subscription = $owner->currentSubscription();
                $owner->credits = $subscription->credits;
                $owner->save();
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
