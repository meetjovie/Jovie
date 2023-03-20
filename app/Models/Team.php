<?php

namespace App\Models;

use App\Models\Scopes\ContactsLimitScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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

    public function currentSubscription()
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

        return null;
    }

    public function addCredits($credits)
    {
        if (! empty($credits)) {
            $this->credits += (int) $credits;
            $this->save();
        }
    }

    public function addContacts($contacts)
    {
        if (! empty($credits)) {
            $this->contacts += (int) $contacts;
            $this->save();
        }
    }

    public function deductCredits($credits = 1)
    {
        $this->credits -= (int) $credits;
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
