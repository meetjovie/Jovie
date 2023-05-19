<?php

namespace App\Exports;

use App\Models\Creator;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CrmExport implements FromCollection, WithMapping, WithHeadings
{
    protected $contacts;
    protected $custom_headings;

    public function __construct($contacts, $custom_headings)
    {
        $this->contacts = $contacts;
        $this->custom_headings = $custom_headings;
    }

    public function headings(): array
    {
        $fields = [
            'id',
            'First Name',
            'Last Name',
            'Full Name',
            'City',
            'Country',
            'Email',

            'Company',
            'Department',
            'Title',
            'Category',
            'Biography',
            'Phone',
            'Website',
            'Gender',
            'DOB',
            'Tags',
            'Offer',
            'Archived',
            'Rating',
            'Stage',
            'Favourite',
            'Muted',
            'Source',
            'Description',

            'Instagram Username',
            'Instagram Followers',
            'Instagram Engagement Rate',
            'Instagram Engaged Followers',
            'Instagram Category',
            'Instagram Biography',

            'Twitter Username',
            'Twitter Followers',
            'Twitter Engaged Followers',
            'Twitter Biography',

            'Linkedin Username',
            'Linkedin Followers',
            'Linkedin Engagement Rate',
            'Linkedin Engaged Followers',
            'Linkedin Category',
            'Linkedin Biography',

            'Tiktok Username',
            'Tiktok Followers',
            'Tiktok Engagement Rate',
            'Tiktok Engaged Followers',
            'Tiktok Biography',

            'Twitch Username',
            'Twitch Followers',
            'Twitch Engagement Rate',
            'Twitch Engaged Followers',
            'Twitch Category',
            'Twitch Biography',

            'Youtube Username',
            'Youtube Followers',
            'Youtube Engagement Rate',
            'Youtube Engaged Followers',
            'Youtube Category',
            'Youtube Biography',
        ];
        if ($this->custom_headings) {
            foreach ($this->custom_headings as $custom_heading) {
                $fields[] = $custom_heading;
            }
        }
        return $fields;
    }

    /**
     * @var Creator
     */
    public function map($contact): array
    {
        $data = [
            $contact->id,
            $contact->first_name,
            $contact->last_name,
            $contact->full_name,
            $contact->city,
            $contact->country,
            $contact->emails[0] ?? null,

            $contact->company,
            $contact->department,
            $contact->title,
            $contact->category,
            $contact->biography,
            $contact->phone[0] ?? null,

            $contact->website,
            $contact->gender,
            $contact->dob,
            $contact->tags,
            $contact->offer,
            $contact->archived,
            $contact->rating,
            $contact->stage,
            $contact->favourite,
            $contact->muted,
            $contact->source,
            $contact->description,

            $contact->instagram_data ? $contact->instagram_data->instagram_handler : null,
            $contact->instagram_data ? $contact->instagram_data->instagram_followers : null,
            $contact->instagram_data ? $contact->instagram_data->instagram_engagement_rate : null,
            $contact->instagram_data ? $contact->instagram_data->instagram_meta->engaged_follows ?? null : null,
            $contact->instagram_data ? $contact->instagram_data->instagram_category : null,
            $contact->instagram_data ? $contact->instagram_data->instagram_biography : null,

            $contact->twitter_data ? $contact->twitter_data->twitter_handler : null,
            $contact->twitter_data ? $contact->twitter_data->twitter_followers : null,
            $contact->twitter_data ? $contact->twitter_data->twitter_meta->engaged_follows ?? null : null,
            $contact->twitter_data ? $contact->twitter_data->twitter_biography : null,

            $contact->linkedin_data ? $contact->linkedin_data->linkedin_handler : null,
            $contact->linkedin_data ? $contact->linkedin_data->linkedin_followers : null,
            $contact->linkedin_data ? $contact->linkedin_data->linkedin_engagement_rate : null,
            $contact->linkedin_data ? $contact->linkedin_data->linkedin_meta->engaged_follows ?? null : null,
            $contact->linkedin_data ? $contact->linkedin_data->linkedin_category : null,
            $contact->linkedin_data ? $contact->linkedin_data->linkedin_biography : null,

            $contact->tiktok_data ? $contact->tiktok_data->tiktok_handler : null,
            $contact->tiktok_data ? $contact->tiktok_data->tiktok_followers : null,
            $contact->tiktok_data ? $contact->tiktok_data->tiktok_engagement_rate : null,
            $contact->tiktok_data ? $contact->tiktok_data->tiktok_meta->engaged_follows ?? null : null,
            $contact->tiktok_data ? $contact->tiktok_data->tiktok_biography : null,

            $contact->twitch_data ? $contact->twitch_data->twitch_handler : null,
            $contact->twitch_data ? $contact->twitch_data->twitch_followers : null,
            $contact->twitch_data ? $contact->twitch_data->twitch_engagement_rate : null,
            $contact->twitch_data ? $contact->twitch_data->twitch_meta->engaged_follows ?? null : null,
            $contact->twitch_data ? $contact->twitch_data->twitch_category : null,
            $contact->twitch_data ? $contact->twitch_data->twitch_biography : null,

            $contact->youtube_data ? $contact->youtube_data->youtube_handler : null,
            $contact->youtube_data ? $contact->youtube_data->youtube_followers : null,
            $contact->youtube_data ? $contact->youtube_data->youtube_engagement_rate : null,
            $contact->youtube_data ? $contact->youtube_data->youtube_meta->engaged_follows ?? null : null,
            $contact->youtube_data ? $contact->youtube_data->youtube_category : null,
            $contact->youtube_data ? $contact->youtube_data->youtube_biography : null,
        ];
        if ($contact->custom_fields) {
            foreach ($contact->custom_fields as $custom_field) {
                $data[] = $custom_field;
            }
        }
        return $data;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->contacts;
    }
}
