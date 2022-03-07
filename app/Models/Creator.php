<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Creator extends Model
{
    use HasFactory;

    const CREATORS_MEDIA_PATH = 'public/creators_media/timeline_media/';
    const CREATORS_PROFILE_PATH = 'public/creators_media/profiles/';
    const CREATORS_CSV_PATH = 'public/creators_csv/';

    const NETWORKS = ['instagram', 'twitch', 'onlyFans', 'snapchat', 'linkedin', 'youtube', 'twitter', 'tiktok'];

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function userLists()
    {
        return $this->belongsToMany(UserList::class)->withTimestamps();
    }

    public function crms()
    {
        return $this->belongsToMany(User::class, 'crms')->withPivot(['offer', 'stage', 'last_contacted', 'muted'])->withTimestamps();
    }

    public function crmRecordByUser()
    {
        return $this->hasOne(Crm::class)->where('user_id', Auth::user()->id);
    }

    public function setInstagramHandlerAttribute($value)
    {
        // Regex for verifying an instagram URL
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:instagram\.com|instagr\.am)\/([A-Za-z0-9-_\.]+)/im';

        // Verify valid Instagram URL
        if ( preg_match( $regex, $value, $matches ) ) {
            $this->attributes['instagram_handler'] =  $matches[1];
        }
        $this->attributes['instagram_handler'] = $value;
    }

    public function setTiktokHandlerAttribute($value)
    {
        // Regex for verifying an tiktok URL
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:tiktok\.com)\/([\@|A-Za-z0-9-_\.]+)/';

        // Verify valid tiktok URL
        if ( preg_match( $regex, $value, $matches ) ) {
            $this->attributes['tiktok_handler'] = $matches[1];
        }
        $this->attributes['tiktok_handler'] = $value;
    }

    public function setOnlyFansHandlerAttribute($value)
    {
        // Regex for verifying an onlyFans URL
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:onlyfans\.com)\/([A-Za-z0-9-_\.]+)/';

        // Verify valid onlyFans URL
        if ( preg_match( $regex, $value, $matches ) ) {
            $this->attributes['onlyFans_handler'] = $matches[1];
        }
        $this->attributes['onlyFans_handler'] = $value;
    }

    public function setLinkedinHandlerAttribute($value)
    {
        // Regex for verifying an linkedin URL
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:linkedin\.com\/)?(?:in)\/([A-Za-z0-9-_\.]+)/';

        // Verify valid linkedin URL
        if ( preg_match( $regex, $value, $matches ) ) {
            $this->attributes['linkedin_handler'] = $matches[1];
        }
        $this->attributes['linkedin_handler'] = $value;
    }

    public function setTwitterHandlerAttribute($value)
    {
        // Regex for verifying a twitter URL
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:twitter\.com)\/([A-Za-z0-9-_\.]+)/';

        // Verify valid twitter URL
        if ( preg_match( $regex, $value, $matches ) ) {
            $this->attributes['twitter_handler'] = $matches[1];
        }
        $this->attributes['twitter_handler'] = $value;
    }

    public function setSnapchatHandlerAttribute($value)
    {
        // Regex for verifying a snapchat URL
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:snapchat\.com\/)?(?:add)\/([A-Za-z0-9-_\.]+)/';

        // Verify valid snapchat URL
        if ( preg_match( $regex, $value, $matches ) ) {
            $this->attributes['snapchat_handler'] = $matches[1];
        }
        $this->attributes['snapchat_handler'] = $value;
    }

    public function setTwitchHandlerAttribute($value)
    {
        // Regex for verifying a twitch URL
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:twitch\.tv)\/([A-Za-z0-9-_\.]+)/';

        // Verify valid twitch URL
        if ( preg_match( $regex, $value, $matches ) ) {
            $this->attributes['twitch_handler'] = $matches[1];
        }
        $this->attributes['twitch_handler'] = $value;
    }

    public function setYoutubeHandlerAttribute($value)
    {
        $oldYoutube = $this->youtube_handler;
        // Regex for verifying a youtube URL - channel id
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:youtube\.com\/)?(?:channel)\/([A-Za-z0-9-_\.]+)/';
        // Verify valid youtube URL
        if ( preg_match( $regex, $value, $matches ) ) {
            $oldYoutube->channel_id = $matches[1];
            $this->attributes['youtube_handler'] = json_encode($oldYoutube);
        }
        // Regex for verifying a youtube URL - channel name
        elseif ( preg_match( '/(?:(?:http|https):\/\/)?(?:www\.)?(?:youtube\.com\/)?(?:c)\/([A-Za-z0-9-_\.]+)/', $value, $matches ) ) {
            $oldYoutube->channel_name = $matches[1];
            $this->attributes['youtube_handler'] = json_encode($oldYoutube);
        }

        elseif (in_array(substr($value, 0, 2), ['UC', 'HC'])) {
            $oldYoutube->channel_id = $value;
            $this->attributes['youtube_handler'] = json_encode($oldYoutube);
        } else {
            $oldYoutube->channel_name = $value;
            $this->attributes['youtube_handler'] = json_encode($oldYoutube);
        }
    }

    public function getYoutubeHandlerAttribute()
    {
        if (isset($this->attributes['youtube_handler'])) {
            return json_decode(is_null($this->attributes['youtube_handler']) ? '{}' : $this->attributes['youtube_handler']);
        } else {
            return json_decode('{}');
        }
    }

    public function getInstagramMediaAttribute($value)
    {
        return json_decode($value ?? '[]');
    }

    public function getInstagramMetaAttribute($value)
    {
        return json_decode($value ?? '[]');
    }

    public function getSocialLinksAttribute($value)
    {
        return json_decode($value ?? '[]');
    }

    public function getTagsAttribute($value)
    {
        return json_decode($value ?? '[]');
    }

    public function getEmailsAttribute($value)
    {
        return json_decode($value ?? '[]');
    }

    public function getInstagramHandlerAttribute($value)
    {
        if ($value) {
            return 'https://instagram.com/' . $value;
        }
        return null;
    }

    public function brands()
    {
        return $this->belongsToMany(Creator::class, 'brand_creator',
            'creator_id',
            'brand_id',
            'id',
            'id')->withTimestamps();
    }

    public static function getCrmCreators($params)
    {
        $creators = Creator::with(['crmRecordByUser'])
            ->whereHas('crmRecordByUser', function ($q) use ($params) {
                $q->where(function ($q) {
                    $q->where('muted', 0)->orWhere('muted', null);
                })->where(function ($q) use ($params) {
                    if (isset($params['archived']) && $params['archived'] == 1) {
                        $q->where('instagram_archived', true);
                    } else {
                        $q->where(function ($q) {
                            $q->where('instagram_archived', 0)->orWhere('instagram_archived', null);
                        });
                    }
                });
            })->when(!empty($params['list']), function ($q) use ($params) {
                return $q->whereHas('userLists', function ($query) use ($params) {
                    $query->where('user_lists.id', $params['list']);
                });
            });

        if (isset($params['id'])) {
            $creators = $creators->where('creators.id', $params['id']);
        }

        if (!isset($params['export'])) {
            $creators = $creators->paginate(50);
        } else {
            $creators = $creators->get();
        }

        // have suggested offer and make instagram offer == suggester offer in case instagram
        // offer is null or 0, so we can use same model on frontend
        // same goes for ratings
        // on frontend one can check if instagram_suggested_offer or instagram_average_rating is present then style different
        // these properties would only show up if user specific values are not set

        $ids = $creators->pluck('id')->toArray();
        // fetch all rating for available creators once, so we don't do multiple queries
        $avgRatings = Crm::selectRaw('AVG(rating) average_rating, creator_id')
            ->whereIn('id', $ids)
            ->groupBy('creator_id')
            ->get()->keyBy('creator_id');

        foreach ($creators as &$creator) {
            if (!$creator->crmRecordByUser->instagram_offer) {
                $creator->crmRecordByUser->instagram_suggested_offer = round($creator->instagram_meta->engaged_follows * 0.5, 0);
            }
            if (!$creator->crmRecordByUser->rating && isset($avgRatings[$creator->id])) {
                $creator->crmRecordByUser->average_rating = round($avgRatings[$creator->id]->average_rating);
            }
        }

        return $creators;
    }
}
