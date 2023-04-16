<?php

namespace App\Services;

use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class ContactService
{
    public function findDuplicates($params)
    {
        // Get all contacts for the given team
//        $contacts = DB::table('contacts')->where('team_id', $team_id)->where('archived', 0)->get();

        $contacts = Contact::getContacts($params);

        $duplicates = [];

        // Loop through each contact and compare it to the others
        foreach ($contacts as $i => $contact1) {
            for ($j = $i + 1; $j < count($contacts); $j++) {
                $contact2 = $contacts[$j];

                // If the two contacts are duplicates, add them to the duplicates array
                if ($this->isDuplicate($contact1, $contact2)) {
                    $matchedFields = $this->getMatchedFields($contact1, $contact2);
                    $mergedContact = $this->getMergedContact($contact1, $contact2);
                    $duplicates[] = [
                        'contacts' => [$contact1, $contact2, $mergedContact],
                        'matched_fields' => $matchedFields
                    ];
                }
            }
        }


        return [$duplicates[0]];
    }

    private function isDuplicate($contact1, $contact2)
    {
        // Compare the relevant fields to determine if the contacts are duplicates
        if ((($contact1->full_name && $contact2->full_name) && ($contact1->full_name == $contact2->full_name))
            || (($contact1->first_name && $contact2->first_name) && $contact1->first_name == $contact2->first_name)
            || (($contact1->last_name && $contact2->last_name) && $contact1->last_name == $contact2->last_name)
            || count(array_intersect($contact1->phones, $contact2->phones))
            || count(array_intersect($contact1->emails, $contact2->emails))
            || $this->socialHandlesMatch($contact1, $contact2)
        ) {
            return true;
        }

        return false;
    }

    private function socialHandlesMatch($contact1, $contact2)
    {
        $socialHandles = ['instagram', 'twitter', 'linkedin', 'tiktok', 'twitch', 'youtube', 'snapchat', 'onlyfans', 'wiki'];

        $matchedHandles = [];
        foreach ($socialHandles as $handle) {
            if (isset($contact1->$handle) && isset($contact2->$handle) && $contact1->$handle == $contact2->$handle) {
                $matchedHandles[$handle] = $contact1->$handle;
            }
        }

        return $matchedHandles;
    }

    private function getMatchedFields($contact1, $contact2)
    {
        $matchedFields = [];

        // Compare the relevant fields to determine which ones match
        if (($contact1->full_name && $contact2->full_name) && $contact1->full_name == $contact2->full_name) {
            $matchedFields['full_name'] = $contact1->full_name;
        }
        if (($contact1->first_name && $contact2->first_name) && $contact1->first_name == $contact2->first_name) {
            $matchedFields['first_name'] = $contact1->first_name;
        }
        if (($contact1->last_name && $contact2->last_name) && $contact1->last_name == $contact2->last_name) {
            $matchedFields['last_name'] = $contact1->last_name;
        }
        $matchedPhones = array_intersect($contact1->phones, $contact2->phones);
        if (count($matchedPhones)) {
            $matchedFields['phones'] = implode(', ', $matchedPhones);
        }
        $matchedEmails = array_intersect($contact1->emails, $contact2->emails);
        if (count($matchedEmails)) {
            $matchedFields['emails'] = implode(', ', $matchedEmails);
        }
        $matches = $this->socialHandlesMatch($contact1, $contact2);
        if (count($matches)) {
            $matchedFields['social_handles'] = $matches;
        }

        return $matchedFields;
    }

    private function getMergedContact($contact1, $contact2)
    {
        $latestUpdated = $contact1->updated_at > $contact2->updated_at ? $contact1 : $contact2;

        $mergedContact = new Contact();
        $mergedContact->phones = array_merge($contact1->phones, $contact2->phones);
        $mergedContact->emails = array_merge($contact1->emails, $contact2->emails);

        return $mergedContact;
    }
}
