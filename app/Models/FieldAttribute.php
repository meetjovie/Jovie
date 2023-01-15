<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldAttribute extends Model
{
    use HasFactory;

    const DEFAULT_FIELDS = [
        [
            'name' => 'Location',
            'icon' => 'MapPinIcon',
            'id' => 1,
            'model' => 'creator.meta.location',
            'value' => 'creator.meta.location',
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
            'model' => 'creator.meta.emails',
            'value' => 'creator.meta.emails',
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
            'model' => 'creator.meta.phone',
            'value' => 'creator.meta.phone',
            'isCopyable' => true,
            'placeholder' => 'Phone',
        ],
        [
            'name' => 'Website',
            'icon' => 'LinkIcon',
            'id' => 4,
            'actionIcon' => 'ArrowTopRightOnSquareIcon',
            /*   'action' => this.openLink('creator.meta.website'), */
            'model' => 'creator.meta.website',
            'method' => 'openURL',
            'params' => 'creator.meta.website',
            /*  'params' => 'creator.meta.website', */
            'value' => 'creator.meta.website',
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
            'model' => 'creator.meta.instagram_handler',
            'method' => 'openLink',
            'method2' => 'instagramDMContact',
            'params' => 'creator.meta.instagram_handler',
            'value' => 'creator.meta.instagram_handler',
            'isCopyable' => true,
            'placeholder' => 'Instagram',
        ],
        [
            'name' => 'Twitter',
            'socialicon' => 'twitter',
            'id' => 6,
            'actionIcon' => 'ArrowTopRightOnSquareIcon',
            /*   'action' => this.openLink('creator.meta.twitter_handler'), */
            'model' => 'creator.meta.twitter_handler',

            'method' => 'openURL',
            'params' => 'creator.meta.twitter_handler',
            'value' => 'creator.meta.twitter_handler',
            'isCopyable' => true,
            'placeholder' => 'Twitter',
        ],
        [
            'name' => 'TikTok',
            'socialicon' => 'tiktok',
            'id' => 7,
            'actionIcon' => 'ArrowTopRightOnSquareIcon',
            /*   'action' => this.openLink('creator.meta.tiktok_handler'), */
            'model' => 'creator.meta.tiktok_handler',
            'value' => 'creator.meta.tiktok_handler',
            'method' => 'openURL',
            'params' => 'creator.meta.tiktok_handler',
            'isCopyable' => true,
            'placeholder' => 'TikTok',
        ],
        [
            'name' => 'Youtube',
            'socialicon' => 'youtube',
            'id' => 8,
            'actionIcon' => 'ArrowTopRightOnSquareIcon',
            /*      'action' => this.openLink('creator.meta.youtube_handler'), */
            'model' => 'creator.meta.youtube_handler',
            'value' => 'creator.meta.youtube_handler',
            'method' => 'openURL',
            'params' => 'creator.meta.youtube_handler',
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
            'model' => 'creator.meta.twitch_handler',
            'params' => 'creator.meta.twitch_handler',
            'value' => 'creator.meta.twitch_handler',
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
            'model' => 'creator.meta.linkedin_handler',
            'value' => 'creator.meta.linkedin_handler',
            'params' => 'creator.meta.linkedin_handler',
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
