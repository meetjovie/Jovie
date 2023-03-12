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
     * Interact the user's last contacted.
     *
     * @return Attribute
     */
    protected function emails(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value ?? '[]'),
            set: fn ($value) => json_encode($value),
        );
    }

    public function twitter(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? 'https://twitter.com/'.$value : null,
        );
    }

    public function twitch(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? 'https://twitch.tv/'.$value : null,
        );
    }

    public function linkedin(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? 'https://www.linkedin.com/in/'.$value : null,
        );
    }

    public function tiktok(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? 'https://www.tiktok.com/'.$value : null,
        );
    }

    public function instagram(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? 'https://instagram.com/'.$value : null,
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
