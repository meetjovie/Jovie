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

    const NETWORKS = ['instagram'];

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
