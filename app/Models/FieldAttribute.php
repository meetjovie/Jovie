<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldAttribute extends Model
{
    use HasFactory, HasUuids;

    const DEFAULT_FIELDS = [
        [
            'name' => 'Location',
            'icon' => 'MapPinIcon',
            'id' => 1,
            'model' => 'location',
            'value' => 'location',
            'isCopyable' => true,
            'placeholder' => 'Location',
        ],
        [
            'name' => 'Email',
            'icon' => 'EnvelopeIcon',
            'id' => 2,
            'actionIcon' => 'EnvelopeIcon',
            'method' => 'emailCreator',
            /* 'action' => this.emailCreator('creator.meta.emails'), */
            'model' => 'emails',
            'value' => 'emails',
            'isCopyable' => true,
            'placeholder' => 'Email',
        ],
        [
            'name' => 'Phone',
            'icon' => 'PhoneIcon',
            'id' => 3,
            'actionIcon' => 'ChatBubbleLeftEllipsisIcon',
            'method' => 'textCreator',
            /*  'action' => this.callCreator('creator.meta.phone'), */
            'model' => 'phone',
            'value' => 'phone',
            'isCopyable' => true,
            'placeholder' => 'Phone',
        ],
        [
            'name' => 'Website',
            'icon' => 'LinkIcon',
            'id' => 4,
            'actionIcon' => 'ArrowTopRightOnSquareIcon',
            /*   'action' => this.openLink('creator.meta.website'), */
            'model' => 'website',
            'method' => 'openURL',
            'params' => 'website',
            /*  'params' => 'website', */
            'value' => 'website',
            'isCopyable' => true,
            'placeholder' => 'Website',
        ],
        [
            'name' => 'Instagram',
            'socialicon' => 'instagram',
            'id' => 5,
            'actionIcon' => 'ChatBubbleLeftEllipsisIcon',
            'actionIcon2' => 'ArrowTopRightOnSquareIcon',
            /*  'method' => 'openLink', */
            /*      'action' => this.openLink('creator.meta.instagram_handler'), */
            'model' => 'instagram_handler',
            'method' => 'openLink',
            'method2' => 'instagramDMContact',
            'params' => 'instagram_handler',
            'value' => 'instagram_handler',
            'isCopyable' => true,
            'placeholder' => 'Instagram',
        ],
        [
            'name' => 'Twitter',
            'socialicon' => 'twitter',
            'id' => 6,
            'actionIcon' => 'ArrowTopRightOnSquareIcon',
            /*   'action' => this.openLink('creator.meta.twitter_handler'), */
            'model' => 'twitter_handler',

            'method' => 'openURL',
            'params' => 'twitter_handler',
            'value' => 'twitter_handler',
            'isCopyable' => true,
            'placeholder' => 'Twitter',
        ],
        [
            'name' => 'TikTok',
            'socialicon' => 'tiktok',
            'id' => 7,
            'actionIcon' => 'ArrowTopRightOnSquareIcon',
            /*   'action' => this.openLink('creator.meta.tiktok_handler'), */
            'model' => 'tiktok_handler',
            'value' => 'tiktok_handler',
            'method' => 'openURL',
            'params' => 'tiktok_handler',
            'isCopyable' => true,
            'placeholder' => 'TikTok',
        ],
        [
            'name' => 'Youtube',
            'socialicon' => 'youtube',
            'id' => 8,
            'actionIcon' => 'ArrowTopRightOnSquareIcon',
            /*      'action' => this.openLink('creator.meta.youtube_handler'), */
            'model' => 'youtube_handler',
            'value' => 'youtube_handler',
            'method' => 'openURL',
            'params' => 'youtube_handler',
            /* 'method' => 'openLink', */
            'isCopyable' => true,
            'placeholder' => 'Youtube',
        ],
        [
            'name' => 'Twitch',
            'socialicon' => 'twitch',
            'id' => 9,
            'actionIcon' => 'ArrowTopRightOnSquareIcon',
            /*   'action' => this.openLink('creator.meta.twitch_handler'), */
            'model' => 'twitch_handler',
            'params' => 'twitch_handler',
            'value' => 'twitch_handler',
            'method' => 'openURL',
            'isCopyable' => true,
            'placeholder' => 'Twitch',
        ],
        [
            'name' => 'Linkedin',
            'socialicon' => 'linkedin',
            'id' => 10,
            'actionIcon' => 'ArrowTopRightOnSquareIcon',
            /*    'action' => this.openLink('creator.meta.linkedin_handler'), */
            'model' => 'linkedin_handler',
            'value' => 'linkedin_handler',
            'params' => 'linkedin_handler',
            /*  'method' => 'openLink', */
            'isCopyable' => true,
            'placeholder' => 'Linkedin',
        ],
    ];

    protected $fillable = [
        'user_id',
        'team_id',
        'field_id',
        'type',
        'order',
        'hide',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

//    public function customField()
//    {
//        return $this->belongsTo(CustomField::class);
//    }
}
