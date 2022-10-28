<?php

namespace App\Models;

use App\Events\CreatorImported;
use App\Traits\GeneralTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Laravel\Scout\Searchable;

class Creator extends Model
{
    use HasFactory, Searchable, GeneralTrait;

    const CREATORS_MEDIA_PATH = 'public/creators_media/timeline_media/';

    const CREATORS_PROFILE_PATH = 'public/creators_media/profiles/';

    const CREATORS_CSV_PATH = 'public/creators_csv/';

    const NETWORKS = ['instagram', 'twitch', /* 'onlyFans', 'snapchat', */ 'linkedin', 'youtube', 'twitter', 'tiktok'];

    protected $guarded = [];

    protected $appends = ['name', 'biography', 'category', 'social_links_with_followers', 'overview_media', 'profile_pic_url', 'has_emails'];

    public function getHasEmailsAttribute()
    {
        return is_array($this->emails) && count($this->emails);
    }

    public function getProfilePicUrlAttribute($creator = null)
    {
        if (is_null($creator)) {
            $creator = $this;
        }
        foreach (self::NETWORKS as $network) {
            if (! empty($creator->{$network.'_meta'}->profile_pic_url)) {
                return $creator->{$network.'_meta'}->profile_pic_url;
            }
        }

        return asset('img/noimage.webp');
    }

    public function getMeta($creator)
    {
        if (is_null($creator)) {
            $creator = $this;
        }

        $meta['instagram_handler'] = $creator->crm_record_by_user->meta->instagram_handler ?? $creator->instagram_handler;
        $meta['twitter_handler'] = $creator->crm_record_by_user->meta->twitter_handler ?? $creator->twitter_handler;
        $meta['twitch_handler'] = $creator->crm_record_by_user->meta->twitch_handler ?? $creator->twitch_handler;
        $meta['emails'] = $creator->crm_record_by_user->meta->emails ?? $creator->emails ?? [];
        $meta['phone'] = $creator->crm_record_by_user->meta->phone ?? $creator->phone;
        $meta['website'] = $creator->crm_record_by_user->meta->website ?? $creator->website;
        $meta['location'] = $creator->crm_record_by_user->meta->location ?? $creator->location;
        $meta['first_name'] = $creator->crm_record_by_user->meta->first_name ?? null;
        $meta['last_name'] = $creator->crm_record_by_user->meta->last_name ?? null;
        $meta['platform_title'] = $creator->crm_record_by_user->meta->platform_title ?? $creator->platform_title;
        $meta['platform_employer'] = $creator->crm_record_by_user->meta->platform_employer ?? $creator->platform_employer;
        $creatorAccessor = new self();
        $meta['name'] = $creator->crm_record_by_user->meta->name ?? $creatorAccessor->getName($creator);
        return $meta;
    }

    public function getVerifiedAttribute($creator = null)
    {
        if (is_null($creator)) {
            $creator = $this;
        }
        foreach (self::NETWORKS as $network) {
            if (! empty($creator->{$network.'_is_verified'})) {
                return $creator->{$network.'_is_verified'};
            }
        }
        return false;
    }

    public function getCategoryAttribute($creator = null)
    {
        if (is_null($creator)) {
            $creator = $this;
        }
        foreach (self::NETWORKS as $network) {
            if (! empty($creator->{$network.'_category'})) {
                return $creator->{$network.'_category'};
            }
        }
        return null;
    }

    public function getNameAttribute()
    {
        return $this->full_name ?? ($this->first_name ? ($this->first_name.' '.$this->last_name) : null) ?? $this->instagram_name ?? $this->twitch_name ?? $this->twitter_name;
    }

    public function getName($creator = null)
    {
        if (is_null($creator)) {
            $creator = $this;
        }

        return $creator->full_name ?? ($creator->first_name ? ($creator->first_name.' '.$creator->last_name) : null) ?? $creator->instagram_name ?? $creator->twitch_name ?? $creator->twitter_name;
    }

    public function getBiographyAttribute($creator)
    {
        if (is_null($creator)) {
            $creator = $this;
        }
        foreach (self::NETWORKS as $network) {
            if (! empty($creator->{$network.'_biography'})) {
                return $creator->{$network.'_biography'};
            }
        }
        return null;
    }

    public function getSocialLinksWithFollowersAttribute()
    {
        $socialLinks = collect();
        $networks = self::NETWORKS;

        foreach ($networks as $network) {
            if (! is_null($this[$network.'_handler']) && isset($this[$network.'_handler'])) {
                $socialLinks->push([
                    'url' => $this[$network.'_handler'],
                    'followers' => $this[$network.'_followers'],
                    'network' => $network,
                ]);
            }
        }

        return $socialLinks;
    }

    public function getOverviewMediaAttribute()
    {
        $media = [];
        foreach (self::NETWORKS as $network) {
            if (! empty($this->{$network.'_media'})) {
                $nMedia = array_map(function ($value) use ($network) {
                    $value->network = $network;

                    return $value;
                }, $this->{$network.'_media'});
                $media = array_merge($media, $nMedia);
            }
        }

        return collect($media)->sortByDesc('datetime')->take(3);
    }

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

    public function crmRecords()
    {
        return $this->hasMany(Crm::class);
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
        if (preg_match($regex, $value, $matches)) {
            $this->attributes['instagram_handler'] = $matches[1];

            return;
        }
        $this->attributes['instagram_handler'] = $value;
    }

    public function setTiktokHandlerAttribute($value)
    {
        // Regex for verifying an tiktok URL
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:tiktok\.com)\/([\@|A-Za-z0-9-_\.]+)/';

        // Verify valid tiktok URL
        if (preg_match($regex, $value, $matches)) {
            $this->attributes['tiktok_handler'] = $matches[1];

            return;
        }
        $this->attributes['tiktok_handler'] = $value;
    }

    public function setOnlyFansHandlerAttribute($value)
    {
        // Regex for verifying an onlyFans URL
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:onlyfans\.com)\/([A-Za-z0-9-_\.]+)/';

        // Verify valid onlyFans URL
        if (preg_match($regex, $value, $matches)) {
            $this->attributes['onlyFans_handler'] = $matches[1];

            return;
        }
        $this->attributes['onlyFans_handler'] = $value;
    }

    public function setLinkedinHandlerAttribute($value)
    {
        // Regex for verifying an linkedin URL
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:linkedin\.com\/)?(?:in)\/([A-Za-z0-9-_\.]+)/';

        // Verify valid linkedin URL
        if (preg_match($regex, $value, $matches)) {
            $this->attributes['linkedin_handler'] = $matches[1];

            return;
        }
        $this->attributes['linkedin_handler'] = $value;
    }

    public function setTwitterHandlerAttribute($value)
    {
        // Regex for verifying a twitter URL
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:twitter\.com)\/([A-Za-z0-9-_\.]+)/';

        // Verify valid twitter URL
        if (preg_match($regex, $value, $matches)) {
            $this->attributes['twitter_handler'] = $matches[1];

            return;
        }
        $this->attributes['twitter_handler'] = $value;
    }

    public function setSnapchatHandlerAttribute($value)
    {
        // Regex for verifying a snapchat URL
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:snapchat\.com\/)?(?:add)\/([A-Za-z0-9-_\.]+)/';

        // Verify valid snapchat URL
        if (preg_match($regex, $value, $matches)) {
            $this->attributes['snapchat_handler'] = $matches[1];

            return;
        }
        $this->attributes['snapchat_handler'] = $value;
    }

    public function setTwitchHandlerAttribute($value)
    {
        // Regex for verifying a twitch URL
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:twitch\.tv|twitch\.com)\/([A-Za-z0-9-_\.]+)/';

        // Verify valid twitch URL
        if (preg_match($regex, $value, $matches)) {
            $this->attributes['twitch_handler'] = $matches[1];

            return;
        }
        $this->attributes['twitch_handler'] = $value;
    }

    public function setYoutubeHandlerAttribute($value)
    {
        $oldYoutube = $this->youtube_handler;
        if (! count((array) $value)) {
            return $oldYoutube;
        }
        // Regex for verifying a youtube URL - channel id
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:youtube\.com\/)?(?:channel)\/([A-Za-z0-9-_\.]+)/';
        // Verify valid youtube URL
        if (preg_match($regex, $value, $matches)) {
            $oldYoutube->channel_id = $matches[1];
            $this->attributes['youtube_handler'] = json_encode($oldYoutube);
        }
        // Regex for verifying a youtube URL - channel name
        elseif (preg_match('/(?:(?:http|https):\/\/)?(?:www\.)?(?:youtube\.com\/)?(?:c)\/([A-Za-z0-9-_\.]+)/', $value, $matches)) {
            $oldYoutube->channel_name = $matches[1];
            $this->attributes['youtube_handler'] = json_encode($oldYoutube);
        } elseif (preg_match('/(?:(?:http|https):\/\/)?(?:www\.)?(?:youtube\.com\/)?(?:user)\/([A-Za-z0-9-_\.]+)/', $value, $matches)) {
            $oldYoutube->channel_name = $matches[1];
            $this->attributes['youtube'] = json_encode($oldYoutube);
        } elseif (in_array(substr($value, 0, 2), ['UC', 'HC'])) {
            $oldYoutube->channel_id = $value;
            $this->attributes['youtube_handler'] = json_encode($oldYoutube);
        } else {
            $oldYoutube->channel_name = $value;
            $this->attributes['youtube_handler'] = json_encode($oldYoutube);
        }
    }

    public function getTwitterHandlerAttribute($value)
    {
        if ($value) {
            return 'https://twitter.com/'.$value;
        }

        return null;
    }

    public function getTwitchHandlerAttribute($value)
    {
        if ($value) {
            return 'https://twitch.tv/'.$value;
        }

        return null;
    }

    public function getLinkedinHandlerAttribute($value)
    {
        if ($value) {
            return 'https://www.linkedin.com/in/'.$value;
        }

        return null;
    }

    public function getTiktokHandlerAttribute($value)
    {
        if ($value) {
            return 'https://www.tiktok.com/'.$value;
        }

        return null;
    }

    public function getInstagramHandlerAttribute($value)
    {
        if ($value) {
            return 'https://instagram.com/'.$value;
        }

        return null;
    }

    public function getTwitterMetaAttribute($value)
    {
        return json_decode($value ?? '{}');
    }

    public function setTwitterMetaAttribute($value)
    {
        $this->attributes['twitter_meta'] = json_encode($value ?? []);
    }

    public function brands()
    {
        return $this->belongsToMany(self::class, 'brand_creator',
            'creator_id',
            'brand_id',
            'id',
            'id')->withTimestamps();
    }

    public function getYoutubeHandlerAttribute($value)
    {
        if (is_null($value)) {
            return json_decode('{}');
        }

        return json_decode($value ?? '{}');
    }

    public function getInstagramMediaAttribute($value)
    {
        return json_decode($value ?? '[]');
    }

    public function getInstagramMetaAttribute($value)
    {
        return json_decode($value ?? '{}');
    }

    public function getTwitchMetaAttribute($value)
    {
        return json_decode($value ?? '{}');
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

    public function setEmailsAttribute($value)
    {
        $this->attributes['emails'] = json_encode($value ?? []);
    }

    public function setTagsAttribute($value)
    {
        $this->attributes['tags'] = json_encode($value ?? []);
    }

    public function setInstagramMediaAttribute($value)
    {
        $this->attributes['instagram_media'] = json_encode($value ?? []);
    }

    public function setInstagramMetaAttribute($value)
    {
        $this->attributes['instagram_meta'] = json_encode($value ?? []);
    }

    public function setSocialLinksAttribute($value)
    {
        $this->attributes['social_links'] = json_encode($value ?? []);
    }

    public function setTwitchMetaAttribute($value)
    {
        $this->attributes['twitch_meta'] = json_encode($value ?? []);
    }

    public static function getCrmCreators($params, $userId = null)
    {
        $userId = $userId ?? Auth::id();
        $user = User::with('currentTeam')->where('id', $userId)->first();
        $creators = DB::table('creators')
            ->addSelect('crms.*')->addSelect('crms.id as crm_id')->addSelect('cn.note')
            ->addSelect('creators.*')->addSelect('creators.id as id')
            ->join('crms', function ($join) use ($params, $user) {
                $join->on('crms.creator_id', '=', 'creators.id')
                    ->where('crms.team_id', $user->currentTeam->id)
                    ->where(function ($q) {
                        $q->where('crms.muted', 0)->orWhere('crms.muted', null);
                    });
            })->leftJoin('creator_notes as cn', function ($join) use ($userId) {
                $join->on('cn.creator_id', '=', 'crms.creator_id')
                    ->where('cn.user_id', $userId);
            });

        if (isset($params['type']) && $params['type'] == 'archived') {
            $creators = $creators->where('archived', 1);
        } elseif (isset($params['type']) && $params['type'] == 'favourites') {
            $creators = $creators->where(function ($q) {
                $q->where('favourite', true);
            });
        } elseif (isset($params['type']) && $params['type'] == 'list' && !empty($params['list'])) {
            $creators = $creators->join('creator_user_list', function ($join) use ($params) {
                $join->on('crms.creator_id', '=', 'creator_user_list.creator_id')
                    ->where('user_list_id', $params['list']);
            });
        } else {
            $creators = $creators->where('archived', 0);
        }

        if (isset($params['id'])) {
            $creators = $creators->where('creators.id', $params['id'])->limit(1);
        }

        if (isset($params['username'])) {
            $creators = $creators->where('creators.username', $params['username'])->limit(1);
        }

        $order = 'DESC';
        $orderBy = null;
        if (!empty($params['order'])) {
            $order = $params['order'];
        }
        if (!empty($params['sort'])) {
            $orderBy = $params['sort'];
        }

        if (!empty($orderBy)) {
            if (in_array($orderBy, ['first_name', 'last_name'])) {
                $creators->addSelect(DB::raw(("lower(JSON_UNQUOTE(JSON_EXTRACT(meta, '$[*].".$orderBy."'))) as order_".$orderBy)));
                $creators = $creators->orderByRaw("lower($orderBy) $order");
            } else {
                $creators = $creators->orderByRaw("lower($orderBy) $order");
            }
        } else {
            $creators = $creators->orderByDesc('crms.id');
        }

        if (! isset($params['export'])) {
            $creators = $creators->paginate(50);
        } else {
            $creators = $creators->get();
        }

        $creatorAccessor = new self();
        $ids = $creators->pluck('id')->toArray();
//         fetch all rating for available creators once, so we don't do multiple queries
        $avgRatings = Crm::selectRaw('AVG(rating) average_rating, creator_id')
            ->whereIn('creator_id', $ids)
            ->groupBy('creator_id')
            ->get()->keyBy('creator_id');

        $lists = UserList::getLists($userId)->pluck('id')->toArray();
        $creatorListIds = DB::table('creator_user_list as cul')
            ->select('ul.id', 'ul.name', 'ul.emoji', 'cul.creator_id')
            ->whereIn('creator_id', $ids)
            ->whereIn('user_list_id', $lists)
            ->join('user_lists as ul', 'ul.id', '=', 'cul.user_list_id')->get();
        $creatorUserLists = [];
        foreach ($creatorListIds as $creatorUserList) {
            $creatorUserLists[$creatorUserList->creator_id][] = [
                'id' => $creatorUserList->id,
                'name' => $creatorUserList->name,
                'creator_id' => $creatorUserList->creator_id
            ];
        }

        foreach ($creators as &$creator) {
            $creator->lists = $creatorUserLists[$creator->id] ?? [];
            $creator->current_list = $params['list'] ?? null;

            $creator->verified = $creatorAccessor->getVerifiedAttribute($creator);
            $creator->category = $creatorAccessor->getCategoryAttribute($creator);
            $creator->name = $creatorAccessor->getName($creator);
            $creator->biography = $creatorAccessor->getBiographyAttribute($creator);

            $creator->instagram_meta = $creatorAccessor->getInstagramMetaAttribute($creator->instagram_meta);
            $creator->instagram_media = $creatorAccessor->getInstagramMediaAttribute($creator->instagram_media);

            $creator->twitter_meta = $creatorAccessor->getTwitterMetaAttribute($creator->twitter_meta);
            $creator->twitch_meta = $creatorAccessor->getTwitchMetaAttribute($creator->twitch_meta);

            $creator->social_links = $creatorAccessor->getSocialLinksAttribute($creator->social_links);
            $creator->emails = $creatorAccessor->getEmailsAttribute($creator->emails);
            $creator->tags = $creatorAccessor->getTagsAttribute($creator->tags);

            $creator->instagram_handler = $creatorAccessor->getInstagramHandlerAttribute($creator->instagram_handler);
            $creator->twitter_handler = $creatorAccessor->getTwitterHandlerAttribute($creator->twitter_handler);
            $creator->twitch_handler = $creatorAccessor->getTwitchHandlerAttribute($creator->twitch_handler);

            $creator->profile_pic_url = $creatorAccessor->getProfilePicUrlAttribute($creator);

            // crm
            $creator->crm_record_by_user = (object) [];
            $creator->crm_record_by_user->user_id = $user->id;
            $creator->crm_record_by_user->team_id = $user->currentTeam->id;
            $creator->crm_record_by_user->creator_id = $creator->id;
            $creator->crm_record_by_user->last_contacted = $creator->last_contacted;
            $creator->crm_record_by_user->offer = $creator->offer;
            $creator->crm_record_by_user->archived = $creator->archived;
            $creator->crm_record_by_user->rating = $creator->rating;
            $creator->crm_record_by_user->favourite = $creator->favourite;
            $creator->crm_record_by_user->muted = $creator->muted;
            $creator->crm_record_by_user->selected = $creator->selected;
            $creator->crm_record_by_user->rejected = $creator->rejected;
            $creator->crm_record_by_user->created_at = $creator->created_at;
            $creator->crm_record_by_user->updated_at = $creator->updated_at;

            $crm = new Crm();
            $creator->crm_record_by_user->stage = $creator->stage;
            $creator->crm_record_by_user->stage_name = $crm->stageName($creator->stage);
            $creator->crm_record_by_user->meta = $crm->getMetaAttribute($creator->meta);
            $creator->meta = $creatorAccessor->getMeta($creator);
            unset($creator->crm_record_by_user->meta);
            unset($creator->creator_id);
            unset($creator->last_contacted);
            unset($creator->offer);
            unset($creator->archived);
            unset($creator->instagram_removed);
            unset($creator->rating);
            unset($creator->stage);
            unset($creator->favourite);
            unset($creator->muted);

            // have suggested offer and make instagram offer == suggester offer in case instagram
            // offer is null or 0, so we can use same model on frontend
            // same goes for ratings
            // on frontend one can check if instagram_suggested_offer or instagram_average_rating is present then style different
            // these properties would only show up if user specific values are not set

            foreach (self::NETWORKS as $network) {
                if (! empty($creator->crm_record_by_user->offer) && empty($creator->{$network.'_meta'})) {
                    $creator->crm_record_by_user->{$network.'_suggested_offer'} = round(($creator->{$network.'_meta'}->engaged_follows ?? 0) * 0.5, 0);
                }
            }
            if (empty($creator->crm_record_by_user->rating) && isset($avgRatings[$creator->id])) {
                $creator->crm_record_by_user->rating = round($avgRatings[$creator->id]->average_rating);
            }
        }

        return $creators;
    }

    public static function updateCrmCreator($request, $id)
    {
        $dataToUpdateForCrm = [];
        $dataToUpdateForCreator = [];
        foreach ($request->except(['_method', '_token', 'id', 'network']) as $k => $v) {
            if ($k == 'crm_record_by_user') {
                foreach ($v as $key => $value) {
                    $isColExist = Schema::hasColumn('crms', $key);
                    if ($isColExist) {
                        $dataToUpdateForCrm[$key] = $value;
                    }
                }
            } else {
                $dataToUpdateForCreator[$k] = $v;
            }
        }
        $creator = self::where('id', $id)->first();
        foreach ($dataToUpdateForCreator as $k => $v) {
            $creator->{$k} = $v;
        }
        // update interactions for crm
        $user = User::with('currentTeam')->where('id', Auth::id())->first();
        Crm::updateOrCreate(['creator_id' => $id, 'user_id' => $user->id, 'team_id' => $user->currentTeam->id], array_merge(['creator_id' => $id, 'user_id' => $user->id, 'team_id' => $user->currentTeam->id], $dataToUpdateForCrm));
        $creator->save();
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();
        $notMutedRecord = [];
        $mutedRecord = [];
        $notRejectedRecord = [];
        $notSelectedRecord = [];
        $selectedRecord = [];
        $rejectedRecord = [];
        foreach ($this->crmRecords as $crm) {
            if (! $crm->selected) {
                $notSelectedRecord[] = $crm->user_id;
            } else {
                $selectedRecord[] = $crm->user_id;
            }
            if (! $crm->rejected) {
                $notRejectedRecord[] = $crm->user_id;
            } else {
                $rejectedRecord[] = $crm->user_id;
            }
            if (! $crm->muted) {
                $notMutedRecord[] = $crm->user_id;
            } else {
                $mutedRecord[] = $crm->user_id;
            }
        }

        $allUsers = User::all()->pluck('id')->toArray();

        $selectedTo = array_intersect($selectedRecord, $notMutedRecord);
        $rejectedTo = array_intersect($rejectedRecord, $notMutedRecord);

        $selectedRejectedMutedTo = array_unique(array_merge($selectedRecord, $rejectedRecord, $mutedRecord));

        $allTo = array_diff($allUsers, $selectedRejectedMutedTo);

        $array['emailCount'] = count($this->emails ?? []);
        $array['all_to'] = $allTo;
        $array['selected_to'] = $selectedTo;
        $array['rejected_to'] = $rejectedTo;
        $array['crms'] = $this->crmRecords;
        $array['unique'] = 10000000000000000000; // it will fail only if user changes the tab this much times :p

        return $array;
    }

    public static function getTags($tags, $creator = null)
    {
        if ($creator) {
            if (! $tags) {
                return $creator->tags;
            }
            $tags = explode(',', $tags);

            return array_values(array_map('trim', array_unique(array_merge($tags, $creator->tags ?? []))));
        }
        if (! $tags) {
            return '[]';
        }
        $tags = explode(',', $tags);

        return array_unique(array_values(array_map('trim', $tags)));
    }

    public static function getEmails($user, $newEmails = [], $oldEmails = [])
    {
        $emails = [];
        if (count($newEmails)) {
            $emails = $newEmails;
        }
        if (! empty($user->business_email)) {
            $emails[] = $user->business_email;
        }
        $emailString = $user->biography ?? $user->description;
        if ($bioEmail = self::getEmailFromString($emailString)) {
            $emails[] = $bioEmail;
        }

        return array_values(array_map('trim', array_unique(array_merge($emails, $oldEmails))));
    }

    public static function addToListAndCrm($creator, $listId = null, $userId = null, $teamId = null)
    {
        if ($listId) {
            $creator->userLists()->syncWithoutDetaching($listId);
        }
        $team = Team::where('id', $teamId)->first();
        $user = User::where('id', $userId)->first();
        if ($team && $user) {
            $changes = $creator->crms()->syncWithoutDetaching([
                $userId => [
                    'team_id' => $team->id
                ]
            ]);
            if (count($changes['attached'])) {
                if (! $user->is_admin) {
                    $team->credits = ($team->credits - 1);
                    $team->save();
                }
            }
        }
        CreatorImported::dispatch($creator->id, $userId, $teamId, $listId);
    }

    public static function getCrmCounts()
    {
        $user = User::with('currentTeam')->where('id', Auth::id())->first();
        $counts = DB::table('crms')->selectRaw('team_id, count(*) AS total,
        sum(case when favourite = true then 1 else 0 end) AS favourites,
        sum(case when archived = true then 1 else 0 end) AS archived')
            ->where('team_id', $user->currentTeam->id)
            ->groupBy('team_id')->first();
        unset($counts->team_id);
        return (array) $counts;
    }
}
