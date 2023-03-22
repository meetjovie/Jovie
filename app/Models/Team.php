<?php

namespace App\Models;

use App\Models\Scopes\ContactsLimitScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Billable;
use Mpociot\Teamwork\TeamworkTeam;

class Team extends TeamworkTeam
{
    use Billable;

    protected $fillable = ['name', 'owner_id', 'emoji'];

    const PLAN_TYPE_BASIC = 0;

    const PLAN_TYPE_TEAM = 1;

    const AD_ON_SEAT = 1;

    const AD_ON_CREDITS = 0;

    public function subscribeTeam($paymentMethod, $coupon, $product, $plan)
    {
        try {
            DB::beginTransaction();
            if (empty($this->stripe_id)) {
                $customer = $this->createAsStripeCustomer();
            } else {
                $customer = $this->createOrGetStripeCustomer();
            }

            $this->addPaymentMethod($paymentMethod);
            $this->updateDefaultPaymentMethod($paymentMethod);

            $subscription = $this->newSubscription($product->name, $plan->id);
            if ($coupon && !empty($coupon->id)) {
                $subscription->withPromotionCode($coupon->id);
            }

            $subscription = $subscription->create($customer->invoice_settings->default_payment_method, [
                'email' => $this->owner->email,
            ]);
            $subscription->seats = $product->metadata->seats;
            $subscription->credits = $product->metadata->credits;
            $subscription->contacts = $product->metadata->contacts;
            $subscription->type = $product->metadata->is_team == 1 ? Team::PLAN_TYPE_TEAM : Team::PLAN_TYPE_BASIC;
            $subscription->amount = $plan->amount;
            $subscription->currency = $plan->currency;
            $subscription->interval = $plan->interval;
            $subscription->save();

            $this->addCredits($subscription->credits);
            $this->addContacts($subscription->contacts);
            $item = $subscription->items->first();
            $item->type = $product->metadata->type == 1 ? Team::AD_ON_SEAT : null;
            $item->save();
            DB::commit();

            return $subscription;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function currentSubscription($basicPlan = true)
    {
        $currentSubscription = $this->subscriptions()->first();
        if ($currentSubscription && $this->subscribed($currentSubscription->name)) {
            foreach ($currentSubscription->items as $item) {
                if ($item->type == self::AD_ON_SEAT) {
                    $currentSubscription->seats += $item->quantity;
                }
            }

            return $currentSubscription;
        }

        return $basicPlan ? json_decode(json_encode(config('services.stripe.basic_plan'))) : null;
    }

    public function addCredits($credits)
    {
        if (!empty($credits)) {
            $this->credits += (int)$credits;
            $this->save();
        }
    }

    public function addContacts($contacts)
    {
        if (!empty($credits)) {
            $this->contacts += (int)$contacts;
            $this->save();
        }
    }

    public function deductCredits($credits = 1)
    {
        $this->credits -= (int)$credits;
        $this->save();
    }

    public function userLists()
    {
        return $this->hasMany(UserList::class);
    }

    public function customFields()
    {
        return $this->hasMany(CustomField::class);
    }

    public function currentContactsLimit()
    {
        return $this->currentSubscription()->contacts ?? 100;
    }

    public function contactsLimitExceeded()
    {
        $totalContacts = Contact::getAllContactsCount();
        $currentContactsLimit = Auth::user()->currentTeam->currentContactsLimit();
        return ($totalContacts - $currentContactsLimit) ?? 0;
    }
}
