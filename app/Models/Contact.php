<?php

namespace App\Models;

use App\Events\ContactImported;
use App\Models\Scopes\TeamScope;
use App\Traits\CustomFieldsTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Contact extends Model
{
    use HasFactory;
    use CustomFieldsTrait;

    protected $fillable = [
        'user_id',
        'team_id',
        'first_name',
        'last_name',
        'nickname',
        'suffix',
        'company',
        'department',
        'title',
        'category',
        'biography',
        'phone',
        'emails',
        'phone',
        'website',
        'location',
        'city',
        'country',
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
    ];

    protected $appends = ['stage_name'];

    protected $casts = [
        'instagram_data' => AsArrayObject::class,
        'twitter_data' => AsArrayObject::class,
        'linkedin_data' => AsArrayObject::class,
        'tiktok_data' => AsArrayObject::class,
        'twitch_data' => AsArrayObject::class,
        'youtube_data' => AsArrayObject::class,
        'snapchat_data' => AsArrayObject::class,
        'onlyfans_data' => AsArrayObject::class,
        'wiki_data' => AsArrayObject::class,
    ];

    public static function saveContact($data, $listId = null)
    {
        $contactData = array_intersect_key($data, array_flip((new Contact())->getFillable()));
        $contact = Contact::query()->create($contactData);
        if ($listId) {
            Contact::addContactsToList($contact->id, $listId, $data['team_id']);
        }
        return $contact;
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new TeamScope());
    }

    public function userLists(): BelongsToMany
    {
        return $this->belongsToMany(UserList::class)->withTimestamps();
    }

    /**
     * Determine the stage of contact.
     */
    protected function stageName(): Attribute
    {
        return new Attribute(
            get: fn () => $this->stages()[$this->stage ?? 0],
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
            get: fn ($value) => $value,
            set: fn ($value) => Carbon::make($value)->toDateString(),
        );
    }

    /**
     * Interact the emails.
     *
     * @return Attribute
     */
    public function emails(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value ?? '[]'),
            set: fn ($value) => $this->setEmails($value),
        );
    }

    public function setEmails($value)
    {
        return is_array($value) ? json_encode($value) : json_encode(explode(',', $value));
    }

    public function twitter(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? 'https://twitter.com/'.$value : null,
            set: fn ($value) => $this->setTwitter($value),
        );
    }

    public function twitch(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? 'https://twitch.tv/'.$value : null,
            set: fn ($value) => $this->setTwitch($value),
        );
    }

    public function linkedin(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? 'https://www.linkedin.com/in/'.$value : null,
            set: fn ($value) => $this->setLinkedin($value),
        );
    }

    public function tiktok(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? 'https://www.tiktok.com/'.$value : null,
            set: fn ($value) => $this->setTiktok($value),
        );
    }

    public function instagram(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? 'https://instagram.com/'.$value : null,
            set: fn ($value) => $this->setInstagram($value),
        );
    }

    public function youtube(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->getYoutubeLink($value),
            set: fn ($value) => $this->setYoutube($value),
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
            return 'https://youtube.com/c/'.$value->channel_name;
        } elseif (isset($value->channel_id)) {
            return 'https://youtube.com/channel/'.$value->channel_id;
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
        $oldYoutube = $this->youtube;
        if (! count((array) $value)) {
            return $oldYoutube;
        }
        // Regex for verifying a youtube URL - channel id
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:youtube\.com\/)?(?:channel)\/([A-Za-z0-9-_\.]+)/';
        // Verify valid youtube URL
        if (preg_match($regex, $value, $matches)) {
            $oldYoutube->channel_id = $matches[1];
            return json_encode($oldYoutube);
        }
        // Regex for verifying a youtube URL - channel name
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

    public static function getContacts($params)
    {
        $contacts = Contact::query()->with('userLists')
            ->select('contacts.*')
            ->addSelect('description_updated.first_name as description_updated_by');
        $contacts = $contacts->leftJoin('users as description_updated', function ($join) {
            $join->on('description_updated.id', '=', 'description_updated_by');
        });
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
        } else {
            $contacts = $contacts->where('archived', 0);
        }

        if (isset($params['id'])) {
            $contacts = $contacts->where('contacts.id', $params['id'])->limit(1);
        }

        $contacts = $contacts->orderByDesc('contacts.id');

        $contacts = $contacts->paginate(5);

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
        $counts = Contact::query()->selectRaw('team_id, count(*) AS total,
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

    public static function updateContact($data, $id)
    {
        $contactData = array_intersect_key($data, array_flip((new Contact())->getFillable()));
        if (isset($contactData['description'])) {
            $contactData['description_updated_by'] = Auth::id();
        }
        Contact::query()->where('id', $id)->update($contactData);
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

    public static function addContactsToList(array|int $contactIds, $listId, $teamId)
    {
        if (!is_array($contactIds)) {
            $contactIds = [$contactIds];
        }

        $list = UserList::query()->where('id', $listId)->first();
        $list->contacts()->syncWithoutDetaching($contactIds);

        foreach ($contactIds as $contactId) {
            ContactImported::dispatch($contactId, $teamId, $listId);
        }
    }
}
