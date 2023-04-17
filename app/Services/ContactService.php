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

        $duplicate = null;

        // Loop through each contact and compare it to the others
        foreach ($contacts as $i => $contact1) {
            for ($j = $i + 1; $j < count($contacts); $j++) {
                $contact2 = $contacts[$j];

                // If the two contacts are duplicates, add them to the duplicates array
                if ($this->isDuplicate($contact1, $contact2)) {
                    $matchedFields = $this->getMatchedFields($contact1, $contact2);
                    $mergedContact = $this->getMergedContact($contact1, $contact2);
                    $duplicate = [
                        'contacts' => [$contact1, $contact2, $mergedContact],
                        'matched_fields' => $matchedFields
                    ];
                    break;
                }
            }
        }


        return $duplicate;
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
        $latestEnriched = $contact1->last_enriched_at > $contact2->last_enriched_at ? $contact1 : $contact2;

        $mergedContact = new Contact();
        $mergedContact->id = rand(rand(), rand());

        $mergedContact->first_name = $this->returnStringValueWithMoreData($contact1->first_name, $contact2->first_name, $latestUpdated->first_name);
        $mergedContact->last_name = $this->returnStringValueWithMoreData($contact1->last_name, $contact2->last_name, $latestUpdated->last_name);
        $mergedContact->full_name = $this->returnStringValueWithMoreData($contact1->full_name, $contact2->full_name, $latestUpdated->full_name);
        $mergedContact->nickname = $this->returnStringValueWithMoreData($contact1->nickname, $contact2->nickname, $latestUpdated->nickname);
        $mergedContact->suffix = $this->returnStringValueWithMoreData($contact1->suffix, $contact2->suffix, $latestUpdated->suffix);
        $mergedContact->company = $this->returnStringValueWithMoreData($contact1->company, $contact2->company, $latestUpdated->company);
        $mergedContact->department = $this->returnStringValueWithMoreData($contact1->department, $contact2->department, $latestUpdated->department);
        $mergedContact->title = $this->returnStringValueWithMoreData($contact1->title, $contact2->title, $latestUpdated->title);
        $mergedContact->biography = $this->returnStringValueWithMoreData($contact1->biography, $contact2->biography, $latestUpdated->biography);
        $mergedContact->website = $this->returnStringValueWithMoreData($contact1->website, $contact2->website, $latestUpdated->website);
        $mergedContact->gender = $this->returnStringValueWithMoreData($contact1->gender, $contact2->gender, $latestUpdated->gender);
        $mergedContact->emails = array_values(array_unique(array_merge($contact1->emails, $contact2->emails)));
        $mergedContact->phones = array_values(array_unique(array_merge($contact1->phones, $contact2->phones)));
        $mergedContact->tags = array_values(array_unique(array_merge($contact1->tags, $contact2->tags)));
        $mergedContact->city = $this->returnStringValueWithMoreData($contact1->city, $contact2->city, $latestUpdated->city);
        $mergedContact->country = $this->returnStringValueWithMoreData($contact1->country, $contact2->country, $latestUpdated->country);
        $mergedContact->address = $this->returnMoreAddress($contact1->address, $contact2->address, $latestUpdated->address);

        $mergedContact->profile_pic_url = $latestUpdated->profile_pic_url;
        $mergedContact->description = $latestUpdated->description;
        $mergedContact->description_updated_by = $latestUpdated->description_updated_by;
        $mergedContact->last_contacted = $latestUpdated->last_contacted;
        $mergedContact->offer = $latestUpdated->offer;
        $mergedContact->archived = $latestUpdated->archived;
        $mergedContact->rating = $latestUpdated->rating;
        $mergedContact->stage = $latestUpdated->stage;
        $mergedContact->favourite = $latestUpdated->favourite;
        $mergedContact->source = $latestUpdated->source;
        $mergedContact->muted = $latestUpdated->muted;

        $mergedContact->instagram = $this->getExistingOrLatest($contact1->instagram, $contact2->instagram, $latestUpdated->instagram);
        $mergedContact->instagram_data = $latestEnriched->instagram_data;
        $mergedContact->youtube = $this->getExistingOrLatest($contact1->youtube, $contact2->youtube, $latestUpdated->youtube);
        $mergedContact->youtube_data = $latestEnriched->youtube_data;
        $mergedContact->twitter = $this->getExistingOrLatest($contact1->twitter, $contact2->twitter, $latestUpdated->twitter);
        $mergedContact->twitter_data = $latestEnriched->twitter_data;
        $mergedContact->twitch = $this->getExistingOrLatest($contact1->twitch, $contact2->twitch, $latestUpdated->twitch);
        $mergedContact->twitch_data = $latestEnriched->twitch_data;
        $mergedContact->onlyFans = $this->getExistingOrLatest($contact1->onlyFans, $contact2->onlyFans, $latestUpdated->onlyFans);
        $mergedContact->onlyFans_data = $latestEnriched->onlyFans_data;
        $mergedContact->tiktok = $this->getExistingOrLatest($contact1->tiktok, $contact2->tiktok, $latestUpdated->tiktok);
        $mergedContact->tiktok_data = $latestEnriched->tiktok_data;
        $mergedContact->linkedin = $this->getExistingOrLatest($contact1->linkedin, $contact2->linkedin, $latestUpdated->linkedin);
        $mergedContact->linkedin_data = $latestEnriched->linkedin_data;
        $mergedContact->snapchat = $this->getExistingOrLatest($contact1->snapchat, $contact2->snapchat, $latestUpdated->snapchat);
        $mergedContact->snapchat_data = $latestEnriched->snapchat_data;
        $mergedContact->wiki = $this->getExistingOrLatest($contact1->wiki, $contact2->wiki, $latestUpdated->wiki);
        $mergedContact->wiki_data = $latestEnriched->wiki_data;
        $mergedContact->enriched_viewed = 0;

        $customFields = $mergedContact->getFieldsByTeam($contact1->team_id);
        foreach ($customFields as $customField) {
            $inputValue = $mergedContact->getInputValues($customField, $contact1->id);
            $mergedContact->{$customField->code} = !empty($inputValue) ? $inputValue : $mergedContact->getInputValues($customField, $contact2->id);
        }

        $commonLists = $contact1->userLists->merge($contact2->userLists)->unique('id');
        $mergedContact->user_lists = $commonLists;

        return $mergedContact;
    }

    public function returnStringValueWithMoreData($string1, $string2, $latest)
    {
        if (strlen($string1) > strlen($string2)) {
            return $string1;
        } else if (strlen($string1) < strlen($string2)) {
            return $string2;
        } else {
            return $latest;
        }
    }

    public function getExistingOrLatest($string1, $string2, $latest)
    {
        return $latest ?: ($string1 ?: $string2);
    }

    private function returnMoreAddress($address1, $address2, $latest)
    {
        $count1 = count(array_filter((array) $address1, function($value) { return !is_null($value); }));
        $count2 = count(array_filter((array) $address2, function($value) { return !is_null($value); }));

        if ($count1 > $count2) {
            return $address1;
        } elseif ($count2 > $count1) {
            return $address2;
        } else {
            return $latest;
        }
    }
}
