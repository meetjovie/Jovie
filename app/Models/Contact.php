<?php

namespace App\Models;

use App\Events\ContactImported;
use App\Jobs\EnrichContacts;
use App\Jobs\EnrichList;
use App\Jobs\InstagramImport;
use App\Jobs\TiktokImport;
use App\Jobs\TwitchImport;
use App\Jobs\TwitterImport;
use App\Models\Scopes\ContactsLimitScope;
use App\Models\Scopes\TeamScope;
use App\Traits\CustomFieldsTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use OwenIt\Auditing\Contracts\Auditable;

class Contact extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    use CustomFieldsTrait;

    protected $fillable = [
        'user_id',
        'team_id',
        'full_name',
        'first_name',
        'last_name',
        'nickname',
        'suffix',
        'company',
        'department',
        'title',
        'category',
        'biography',
        'phones',
        'emails',
        'website',
        'address',
        'gender',
        'dob',
        'profile_pic_url',
        'last_contacted',
        'offer',
        'archived',
        'rating',
        'stage',
        'favourite',
        'muted',
        'source',
        'description',
        'description_updated_by',
        'instagram',
        'instagram_data',
        'twitter',
        'twitter_data',
        'linkedin',
        'linkedin_data',
        'tiktok',
        'tiktok_data',
        'twitch',
        'twitch_data',
        'youtube',
        'youtube_data',
        'snapchat',
        'snapchat_data',
        'onlyfans',
        'onlyfans_data',
        'wiki',
        'wiki_data',
        'last_enriched_at',
        'enriched_viewed',
        'enriching',
    ];

    protected $appends = ['stage_name', 'social_links_with_followers', 'overview_media'];

    const OVERRIDEABLE = [
        'phones',
        'emails',
        'instagram',
        'instagram_data',
        'twitter',
        'twitter_data',
        'linkedin',
        'linkedin_data',
        'tiktok',
        'tiktok_data',
        'twitch',
        'twitch_data',
        'youtube',
        'youtube_data',
        'snapchat',
        'snapchat_data',
        'onlyfans',
        'onlyfans_data',
        'wiki',
        'wiki_data',
        'last_enriched_at',
        'enriching',
    ];

    /**
     * Attributes to include in the Audit.
     *
     * @var array
     */
    protected $auditInclude = [
        'full_name',
        'first_name',
        'last_name',
        'nickname',
        'suffix',
        'company',
        'department',
        'title',
        'category',
        'biography',
        'phones',
        'emails',
        'website',
        'address',
        'gender',
        'dob',
        'profile_pic_url',
        'last_contacted',
        'offer',
        'archived',
        'rating',
        'stage',
        'favourite',
        'muted',
        'source',
        'description',
        'instagram',
        'twitter',
        'linkedin',
        'tiktok',
        'twitch',
        'youtube',
        'snapchat',
        'onlyfans',
        'wiki',
        'last_enriched_at',
    ];

    use \OwenIt\Auditing\Auditable;

    // ...

    /**
     * {@inheritdoc}
     */
    public function transformAudit(array $data): array
    {
        if (Arr::has($data, 'new_values.emails')) {
            $data['old_values']['emails'] = implode(',', $this->getOriginal('emails'));
            $data['new_values']['emails'] = implode(',', $this->getAttribute('emails'));
        }

        if (Arr::has($data, 'new_values.phones')) {
            $data['old_values']['phones'] = implode(',', $this->getOriginal('phones'));
            $data['new_values']['phones'] = implode(',', $this->getAttribute('phones'));
        }

        if (Arr::has($data, 'new_values.stage')) {
            $data['old_values']['stage'] = $this->stages()[$this->getOriginal('stage')];
            $data['new_values']['stage'] = $this->stages()[$this->getAttribute('stage')];;
        }

        return $data;
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new TeamScope());
        static::addGlobalScope(new ContactsLimitScope());
    }

    public function userLists(): BelongsToMany
    {
        return $this->belongsToMany(UserList::class)->withTimestamps();
    }

    /**
     * Get the available social links and followers of contact.
     */
    public function socialLinksWithFollowers(): Attribute
    {
        return new Attribute(
            get: fn() => $this->getSocialLinksWithFollowers(),
        );
    }

    public function getSocialLinksWithFollowers()
    {
        $socialLinks = collect();
        foreach (Creator::NETWORKS as $NETWORK) {
            $socialLinks->push([
                'url' => $this->{$NETWORK},
                'network' => $NETWORK,
                'followers' => $this->{$NETWORK.'_data'}->{$NETWORK.'_followers'} ?? null
            ]);
        }
        return $socialLinks;
    }

    /**
     * Determine the oveview media of contact.
     */
    protected function overviewMedia(): Attribute
    {
        return new Attribute(
            get: fn() => $this->getOverviewMedia(),
        );
    }

    public function getOverviewMedia()
    {
        $media = [];
        foreach (Creator::NETWORKS as $network) {
            if (! empty($this->{$network.'_data'}) && !empty($this->{$network.'_data'}->{$network.'_media'})) {
                $nMedia = array_map(function ($value) use ($network) {
                    $value->network = $network;

                    return $value;
                }, (array) $this->{$network.'_data'}->{$network.'_media'});
                $media = array_merge($media, $nMedia);
            }
        }

        return collect($media)->sortByDesc('datetime')->take(3);
    }

    /**
     * Determine the stage of contact.
     */
    protected function stageName(): Attribute
    {
        return new Attribute(
            get: fn() => $this->stages()[$this->stage ?? 0],
        );
    }

    public static function stages()
    {
        return [
            0 => 'Lead',
            1 => 'Interested',
            2 => 'Negotiating',
            3 => 'In Progress',
            4 => 'Complete',
            5 => 'Not Interested',
        ];
    }

    /**
     * Interact the user's last contacted.
     *
     * @return Attribute
     */
    protected function lastContacted(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value,
            set: fn($value) => Carbon::make($value)->toDateString(),
        );
    }

    public function emails(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value ?? '[]'),
            set: fn($value) => $this->setEmails($value),
        );
    }

    public function setEmails($value)
    {
        $existingEmails = $this->emails;
        $newEmails = array_values(array_map('trim', array_filter(is_array($value) ? $value : explode(',', $value))));
        return json_encode(array_values(array_unique(array_merge($existingEmails, $newEmails))));
    }

    public function phones(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value ?? '[]'),
            set: fn($value) => $this->setPhones($value),
        );
    }

    public function setPhones($value)
    {
        $existingPhones = $this->phones;
        $newPhones = array_values(array_map('trim', array_filter(is_array($value) ? $value : explode(',', $value))));
        return json_encode(array_values(array_unique(array_merge($existingPhones, $newPhones))));
    }

    public function address(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->getAddress($value),
            set: fn($value) => json_encode($value),
        );
    }

    public function getAddress($value)
    {
        $value = json_decode($value ?? '[]');
        $attributes = ['streetAddress', 'extendedAddress', 'poBox', 'locality', 'region', 'postalCode', 'country'];
        foreach ($attributes as $attribute) {
            $value = is_array($value) ? (object)$value : $value;
            if (!isset($value->{$attribute})) {
                $value->{$attribute} = null;
            }
        }
        return $value;
    }

    public function twitter(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? 'https://twitter.com/' . $value : null,
            set: fn($value) => $this->setTwitter($value),
        );
    }

    public function twitch(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? 'https://twitch.tv/' . $value : null,
            set: fn($value) => $this->setTwitch($value),
        );
    }

    public function linkedin(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? 'https://www.linkedin.com/in/' . $value : null,
            set: fn($value) => $this->setLinkedin($value),
        );
    }

    public function tiktok(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? 'https://www.tiktok.com/' . $value : null,
            set: fn($value) => $this->setTiktok($value),
        );
    }

    public function instagram(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? 'https://instagram.com/' . $value : null,
            set: fn($value) => $this->setInstagram($value),
        );
    }

    public function youtube(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->getYoutubeLink($value),
            set: fn($value) => $this->setYoutube($value),
        );
    }

    public function getYoutubeLink($value)
    {
        if (is_null($value)) {
            null;
        }
        if (is_string($value)) {
            $value = json_decode($value);
        }

        if (isset($value->channel_name)) {
            return 'https://youtube.com/c/' . $value->channel_name;
        } elseif (isset($value->channel_id)) {
            return 'https://youtube.com/channel/' . $value->channel_id;
        }
        return null;
    }

    public function setInstagram($value)
    {
        // Regex for verifying an instagram URL
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:instagram\.com|instagr\.am)\/([A-Za-z0-9-_\.]+)/im';

        // Verify valid Instagram URL
        if (preg_match($regex, $value, $matches)) {
            return $matches[1];
        }
        return $value;
    }

    public function setTiktok($value)
    {
        // Regex for verifying an tiktok URL
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:tiktok\.com)\/([\@|A-Za-z0-9-_\.]+)/';

        // Verify valid tiktok URL
        if (preg_match($regex, $value, $matches)) {
            return $matches[1];
        }
        return $value;
    }

    public function setLinkedin($value)
    {
        // Regex for verifying an linkedin URL
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:linkedin\.com\/)?(?:in)\/([A-Za-z0-9-_\.]+)/';

        // Verify valid linkedin URL
        if (preg_match($regex, $value, $matches)) {
            return $matches[1];
        }
        return $value;
    }

    public function setTwitter($value)
    {
        // Regex for verifying a twitter URL
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:twitter\.com)\/([A-Za-z0-9-_\.]+)/';

        // Verify valid twitter URL
        if (preg_match($regex, $value, $matches)) {
            return $matches[1];
        }
        return $value;
    }

    public function setTwitch($value)
    {
        // Regex for verifying a twitch URL
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:twitch\.tv|twitch\.com)\/([A-Za-z0-9-_\.]+)/';

        // Verify valid twitch URL
        if (preg_match($regex, $value, $matches)) {
            return $matches[1];
        }
        return $value;
    }

    public function setYoutube($value)
    {
        $oldYoutube = $this->youtube ?? null;
        if (!count((array)$value)) {
            return !empty($oldYoutube) ? json_encode($oldYoutube) : null;
        }
        // Regex for verifying a youtube URL - channel id
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:youtube\.com\/)?(?:channel)\/([A-Za-z0-9-_\.]+)/';
        // Verify valid youtube URL
        if (preg_match($regex, $value, $matches)) {
            $oldYoutube->channel_id = $matches[1];
            return json_encode($oldYoutube);
        } // Regex for verifying a youtube URL - channel name
        elseif (preg_match('/(?:(?:http|https):\/\/)?(?:www\.)?(?:youtube\.com\/)?(?:c)\/([A-Za-z0-9-_\.]+)/', $value, $matches)) {
            $oldYoutube->channel_name = $matches[1];
            return json_encode($oldYoutube);
        } elseif (preg_match('/(?:(?:http|https):\/\/)?(?:www\.)?(?:youtube\.com\/)?(?:user)\/([A-Za-z0-9-_\.]+)/', $value, $matches)) {
            $oldYoutube->channel_name = $matches[1];
            return json_encode($oldYoutube);
        } elseif (in_array(substr($value, 0, 2), ['UC', 'HC'])) {
            $oldYoutube->channel_id = $value;
            return json_encode($oldYoutube);
        } else {
            $oldYoutube->channel_name = $value;
            return json_encode($oldYoutube);
        }
    }

    public function twitterData(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value ?? '[]'),
            set: fn($value) => json_encode($value),
        );
    }

    public function twitchData(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value ?? '[]'),
            set: fn($value) => json_encode($value),
        );
    }

    public function linkedinData(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value ?? '[]'),
            set: fn($value) => json_encode($value),
        );
    }

    public function tiktokData(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value ?? '[]'),
            set: fn($value) => json_encode($value),
        );
    }

    public function instagramData(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value ?? '[]'),
            set: fn($value) => json_encode($value),
        );
    }

    public function youtubeData(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value ?? '[]'),
            set: fn($value) => json_encode($value),
        );
    }

    public static function getContacts($params)
    {
        $contacts = Contact::query()->with('userLists')
            ->select('contacts.*')
            ->addSelect('description_updated.first_name as description_updated_by');
        $contacts = $contacts->leftJoin('users as description_updated', function ($join) {
            $join->on('description_updated.id', '=', 'description_updated_by');
        });

        $contacts = $contacts->where('archived', 0);
        if (isset($params['type']) && $params['type'] == 'archived') {
            $contacts = $contacts->where('archived', 1);
        } elseif (isset($params['type']) && $params['type'] == 'favourites') {
            $contacts = $contacts->where(function ($q) {
                $q->where('favourite', true);
            });
        } elseif (isset($params['type']) && $params['type'] == 'list' && !empty($params['list'])) {
            $listId = $params['list'];
            $contacts = $contacts->whereHas('userLists', function ($query) use ($listId) {
                $query->where('user_lists.id', $listId);
            });
        }

        if (isset($params['id'])) {
            $contacts = $contacts->where('contacts.id', $params['id'])->limit(1);
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
            $orderBy = "contacts.".$orderBy;
            $contacts = $contacts->orderByRaw("lower($orderBy) $order");
        } else {
            $contacts = $contacts->orderByDesc('contacts.id');
        }

        $contacts = $contacts->paginate(10);

        foreach ($contacts as &$contact) {
            // custom fields
            $cc = new Contact();
            $customFields = $cc->getFieldsByTeam($params['team_id']);
            foreach ($customFields as $customField) {
                $contact->{$customField->code} = $cc->getInputValues($customField, $contact->id);
            }
        }

        return $contacts;
    }

    public static function getCrmCounts()
    {
        $counts = Contact::query()->selectRaw('team_id, sum(case when archived = false then 1 else 0 end) AS total,
        sum(case when favourite = true then 1 else 0 end) AS favourites,
        sum(case when archived = true then 1 else 0 end) AS archived')->groupBy('team_id')->first();

        if ($counts) {
            $counts = $counts->makeHidden(['stage_name']);
            unset($counts->team_id);
        } else {
            $counts = [
                'archived' => 0,
                'favourite' => 0,
                'total' => 0,
            ];
        }
        return $counts;
    }

    public static function getFillableData($data)
    {
        return array_intersect_key($data, array_flip((new Contact())->getFillable()));
    }

    public static function getOverrideableDataForContactDuringEnrich($data)
    {
        return array_intersect_key($data, array_flip(self::OVERRIDEABLE));
    }

    public static function saveContact($data, $listId = null)
    {
        if (!isset($data['user_id']) || !isset($data['team_id'])) {
            return false;
        }

        $contactData = self::getFillableData($data);

        if (isset($data['override']) && $data['override']) {
            $existingContacts = self::getExistingContactsBySocialHandle($data, $data['team_id']);
            if ($existingContacts) {
                return self::updateMultipleExistingContactsWithSocial($data, $existingContacts, $listId);
            }
        }

        $contact = new Contact();
        foreach ($contactData as $key => $value) {
            $contact->{$key} = $value;
        }
        $contact->save();
        if ($listId) {
            Contact::addContactsToList($contact->id, $listId, $data['team_id']);
        } else { // if list is there then import event is dispatched from within it for multiple contacts. else it is dispatched as single without list
            ContactImported::dispatch($contact->id, $data['team_id'], $listId);
        }

        return collect([$contact]);
    }

    public static function updateMultipleExistingContactsWithSocial($data, $contacts, $listId = null, $areContacts = false)
    {
        $contactData = self::getFillableData($data);
        foreach ($contacts as &$contact) {
            $overrideableData = null;
            $overrideAll = $data['override'] ?? false;
            if ($contact->last_enriched_at && !$overrideAll) {
                $overrideableData = self::getOverrideableDataForContactDuringEnrich($contactData);
            }
            foreach ($overrideableData ?? $contactData as $key => $value) {
                $contact->{$key} = $value;
            }
            $contact->save();
            if (!$areContacts) {
                if ($listId) {
                    Contact::addContactsToList($contact->id, $listId, $data['team_id'], true);
                } else { // if list is there then import event is dispatched from within it for multiple contacts. else it is dispatched as single without list
                    ContactImported::dispatch($contact->id, $data['team_id'], $listId, true);
                }
            }
        }
        return $contacts;
    }

    public static function getExistingContactsBySocialHandle(array $contactData, $teamId)
    {
        $contacts = new Contact();
        $socials = [];
        foreach (Creator::NETWORKS as $NETWORK) {
            $methodName = 'set' . ucfirst($NETWORK); // get social handle without url
            $socials[$NETWORK] = $contacts->{$methodName}($contactData[$NETWORK] ?? null);
            if (!$socials[$NETWORK]) {
                unset($socials[$NETWORK]);
            }
        }

        $contacts = [];

        $contacts = Contact::query()->where('team_id', $teamId);
        $matched = false;
        if (!empty($socials)) {
            $matched = true;
            $contacts->where(function ($query) use ($socials) {
                foreach ($socials as $network => $value) {
                    $query->orWhere($network, $value);
                }
            });
        }

        if (isset($contactData['phones'])) {
            $matched = true;
            $contacts = $contacts->whereJsonContains('phones', $contactData['phones']);
        }

        if (isset($contactData['emails'])) {
            $matched = true;
            $contacts = $contacts->whereJsonContains('emails', $contactData['emails']);
        }

        if ($matched) {
            $contacts = $contacts->get();
        } else {
            $contacts = [];
        }

        return count($contacts) ? $contacts : false;
    }

    public static function getExistingContactsByIds($ids, $teamId)
    {
        if (!is_array($ids)) {
            $ids = [$ids];
        }
        $contacts = Contact::query()->where('team_id', $teamId)->whereIn('id', $ids)->get();
        return count($contacts) ? $contacts : false;
    }

    public static function updateContact($data, $id)
    {
        $contactData = self::getFillableData($data);
        if (isset($contactData['description'])) {
            $contactData['description_updated_by'] = Auth::id();
        }
        $contact = Contact::query()->where('id', $id)->first();
        foreach ($contactData as $key => $value) {
            $contact->{$key} = $value;
        }
        $contact->save();
        $contact = Contact::query()->where('id', $id)->first();
        $cc = new Contact();
        $customFields = $cc->getFieldsByTeam(Auth::user()->currentTeam->id);
        foreach ($customFields as $customField) {
            if (array_key_exists($customField->code, $data)) {
                $value = $data[$customField->code];
                CustomFieldValue::query()->updateOrCreate([
                    'custom_field_id' => $customField->id,
                    'model_id' => $contact->id,
                    'model_type' => Contact::class,
                ], [
                    'value' => $value,
                ]);
            }
        }
        return $contact;
    }

    public static function updateArchivedStatus($contactIds, $archived)
    {
        foreach ($contactIds as $contactId) {
            $contact = Contact::where('id', $contactId)->first();
            $contact->archived = $archived;
            $contact->save();
        }
    }

    public static function addContactsToList(array|int $contactIds, $listId, $teamId, $updatingExisting = false)
    {
        if (!is_array($contactIds)) {
            $contactIds = [$contactIds];
        }

        $list = UserList::query()->where('id', $listId)->first();
        $list->contacts()->syncWithoutDetaching($contactIds);

        foreach ($contactIds as $contactId) {
            ContactImported::dispatch($contactId, $teamId, $listId, $updatingExisting);
        }
    }

    public static function saveContactFromSocial(Creator $creator, $listId = null, $userId = null, $teamId = null, $source = null, $override = false, $contactId = null)
    {
        if (is_null($userId) || is_null($teamId)) {
            return false;
        }

        $user = User::query()->where('id', $userId)->first();
        $team = Team::query()->where('id', $teamId)->first();

        if (is_null($user) || is_null($team)) {
            return false;
        }

        $data = [];
        foreach (Creator::NETWORKS as $NETWORK) {
            foreach ($creator->getAttributes() as $key => $attribute) {
                if (str_starts_with($key, $NETWORK . '_')) {
                    if ($key == ($NETWORK . '_handler')) {
                        $data[$NETWORK] = $creator->{$key};
                    }
                    $data[$NETWORK . '_data'][$key] = $creator->{$key};
                }
            }
            if (empty($data[$NETWORK]) || (is_object($data[$NETWORK]) && !count(get_object_vars($data[$NETWORK])))) {
                unset($data[$NETWORK]);
                unset($data[$NETWORK . '_data']);
            }
        }

        $data['full_name'] = $creator->getName($creator);
        $data['first_name'] = $creator->getFirstName($creator);
        $data['last_name'] = $creator->getLastName($creator);
        $data['category'] = $creator->getCategoryAttribute();
        $data['biography'] = $creator->getBiographyAttribute();
        $data['emails'] = $creator->emails;
        $data['gender'] = $creator->gender;
        $data['phones'] = $creator->phone;
        $data['website'] = $creator->website;
        $data['profile_pic_url'] = $creator->getProfilePicUrlAttribute();
        $data['source'] = $source;
        $data['override'] = $override;

        $data['user_id'] = $userId;
        $data['team_id'] = $teamId;

        $data['last_enriched_at'] = Carbon::now()->toDateTimeString();
        $data['enriched_viewed'] = false;

        $areContacts = false;
        if ($contactId) {
            $existingContacts = self::getExistingContactsByIds($contactId, $data['team_id']);
            $areContacts = true;
        } else {
            $existingContacts = self::getExistingContactsBySocialHandle($data, $data['team_id']);
        }

        if ($existingContacts) {
            $contacts = self::updateMultipleExistingContactsWithSocial($data, $existingContacts, $listId, $areContacts);
        } else {
            $contacts = self::saveContact($data, $listId);
        }

        return $contacts->pluck('id')->toArray();
    }

    public static function getAllContactsCount()
    {
        return Contact::query()->withoutGlobalScope(ContactsLimitScope::class)->count();
    }

    public static function getEnrichableContacts($contacts, $onlyCount = false)
    {
        if (!is_array($contacts)) {
            $contacts = [$contacts];
        }

        $columns = ['id', 'team_id', 'first_name', 'last_name'];
        foreach (Creator::NETWORKS as $NETWORK) {
            $columns[$NETWORK] = $NETWORK;
        }

        $contacts = Contact::query()->whereIn('id', $contacts)->where(function ($query) {
            foreach (Creator::NETWORKS as $NETWORK) {
                $query->orWhereNotNull($NETWORK);
            }
        })->select($columns);

        if ($onlyCount) {
            return $contacts->count();
        }

        return $contacts->get();
    }

    public static function getEnrichableContactsFromLists($listIds, $onlyCount = false)
    {
        if (!is_array($listIds)) {
            $listIds = [$listIds];
        }

        $contactIds = Contact::query()->whereHas('userLists', function ($query) use ($listIds) {
            $query->whereIn('user_lists.id', $listIds);
        })->pluck('contacts.id')->toArray();

        return self::getEnrichableContacts($contactIds, $onlyCount);
    }

    public static function enrichContacts($contacts, $params)
    {
        if (!is_array($contacts)) {
            $contacts = [$contacts];
        }

        EnrichContacts::dispatch($contacts, $params);

        return $contacts;
    }

    public static function enrichLists($listIds, $params)
    {
        if (!is_array($listIds)) {
            $listIds = [$listIds];
        }

        $listId = $listIds[0]; // todo: setup for mulitple list enrich
        EnrichList::dispatch($listId, $params);

        return $listIds;
    }
}
