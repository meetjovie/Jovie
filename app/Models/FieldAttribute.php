<?php

namespace App\Models;

use App\Models\Scopes\TeamScope;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    const DEFAULT_HEADERS = [
        [
            'id' => 1,
            'name' => 'First',
            'key' => 'first_name',
            'meta' => true,
            'icon' => 'Bars3BottomLeftIcon',
            'sortable' => false,
            'visible' => false,
            'breakpoint' => '2xl',
            'width' => '40',
            'type' => 'text',
        ],
        [
            'id' => 2,
            'name' => 'Last',
            'key' => 'last_name',
            'meta' => true,
            'icon' => 'Bars3BottomLeftIcon',
            'visible' => false,
            'sortable' => false,
            'breakpoint' => '2xl',
            'width' => '40',
            'type' => 'text',
        ],
        [
            'id' => 3,
            'name' => 'Title',
            'key' => 'platform_title',
            'meta' => true,
            'icon' => 'UserIcon',
            'visible' => false,
            'breakpoint' => '2xl',
            'type' => 'text',
        ],
        [
            'id' => 4,
            'name' => 'Company',
            'key' => 'platform_employer',
            'meta' => true,
            'icon' => 'BriefcaseIcon',
            'visible' => false,
            'sortable' => false,
            'breakpoint' => '2xl',
            'width' => 40,
            'type' => 'text',
        ],

        [
            'id' => 5,
            'name' => 'Email',
            'key' => 'emails',
            'meta' => true,
            'icon' => 'AtSymbolIcon',
            'visible' => true,
            'breakpoint' => 'lg',
            'width' => 40,
            'type' => 'email',
        ],

        [
            'id' => 6,
            'name' => 'Social Links',
            'key' => 'networks',
            'meta' => true,
            'icon' => 'LinkIcon',
            'visible' => true,
            'width' => '40',
            'type' => 'socialLinks',
        ],
        [
            'id' => 7,
            'name' => 'Offer',
            'key' => 'crm_record_by_user.offer',
            'icon' => 'CurrencyDollarIcon',
            'sortable' => false,
            'visible' => false,
            'breakpoint' => 'lg',
            'width' => '40',
            'type' => 'currency',
        ],
        [
            'id' => 8,
            'name' => 'Stage',
            'key' => 'crm_record_by_user.stage',
            'icon' => 'ArrowDownCircleIcon',
            'width' => '40',
            'sortable' => true,
            'visible' => true,
            'breakpoint' => 'md',
            'type' => 'select',
        ],
        [
            'id' => 9,
            'name' => 'Last Contact',
            'key' => 'crm_record_by_user.last_contacted',
            'icon' => 'CalendarDaysIcon',
            'sortable' => false,
            'visible' => false,
            'breakpoint' => '2xl',
            'width' => '40',
            'type' => 'date',
        ],
        [
            'id' => 10,
            'name' => 'Rating',
            'key' => 'crm_record_by_user.rating',
            'icon' => 'StarIcon',
            'sortable' => true,
            'visible' => true,
            'breakpoint' => '2xl',
            'width' => '40',
            'type' => 'rating',
        ],
        [
            'id' => 11,
            'name' => 'Lists',
            'key' => 'crm_record_by_user.lists',
            'icon' => 'ListBulletIcon',
            'sortable' => true,
            'visible' => true,
            'breakpoint' => '2xl',
            'width' => '40',
            'type' => 'multi_select',
        ],
    ];

    const FULL_NAME_HEADER = [
        'name' => 'Name',
        'key' => 'full_name',
        'meta' => true,
        'icon' => 'Bars3BottomLeftIcon',
        'sortable' => true,
        'visible' => true,
        'type' => 'text',
    ];

    protected $fillable = [
        'user_id',
        'team_id',
        'field_id',
        'user_list_id',
        'type',
        'order',
        'hide',
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

    public function scopeUnHidden($query)
    {
        return $query->where('hide', 0);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function customField()
    {
        return $this->belongsTo(CustomField::class);
    }

    public static function updateSortOrder($userId, $newIndex = 0, $oldIndex = 0, $fieldId = null, $listId = null) // listId suggests that its for headers
    {
        $customFieldIds = CustomField::query()->pluck('id')->toArray();

        if (is_null($listId)) {
            $defaultIds = array_column(FieldAttribute::DEFAULT_FIELDS, 'id');
        } else {
            $defaultIds = array_column(FieldAttribute::DEFAULT_HEADERS, 'id');
        }

        $fieldIds = array_merge($customFieldIds, $defaultIds);
        $fieldIdsToUpdate = array_map('strval', array_diff($fieldIds, [$fieldId]));

        DB::beginTransaction();
        if (!is_null($fieldId)) {
            if ($newIndex > $oldIndex) {
                // update user list set order = order-1 where order <= newIndex and id != listID
                $fieldAttribute = FieldAttribute::where('order', '<=', $newIndex)
                    ->whereIn('field_id', $fieldIdsToUpdate)
                    ->where('user_id', $userId);
                if (is_null($listId)) {
                    $fieldAttribute = $fieldAttribute->whereNull('user_list_id');
                } else {
                    $fieldAttribute = $fieldAttribute->where('user_list_id', $listId);
                }
                $fieldAttribute->update(['order' => (DB::raw('`order` - 1'))]);
                // update userlist set order = newOrder where id = listId
                $fieldAttribute = FieldAttribute::where('field_id', $fieldId)
                    ->where('user_id', $userId);
                if (is_null($listId)) {
                    $fieldAttribute = $fieldAttribute->whereNull('user_list_id');
                } else {
                    $fieldAttribute = $fieldAttribute->where('user_list_id', $listId);
                }
                $fieldAttribute->update(['order' => $newIndex]);
            } elseif ($newIndex < $oldIndex) { // newIndex < $oldIndex
                // update user list set order = order+1 where order >= newIndex and id != listID
                $fieldAttribute = FieldAttribute::where('order', '>=', $newIndex)
                    ->whereIn('field_id', $fieldIdsToUpdate)
                    ->where('user_id', $userId);
                if (is_null($listId)) {
                    $fieldAttribute = $fieldAttribute->whereNull('user_list_id');
                } else {
                    $fieldAttribute = $fieldAttribute->where('user_list_id', $listId);
                }
                $fieldAttribute->update(['order' => (DB::raw('`order` + 1'))]);
                // update userlist set order = newOrder where id = listId
                $fieldAttribute = FieldAttribute::where('field_id', $fieldId)
                    ->where('user_id', $userId);
                if (is_null($listId)) {
                    $fieldAttribute = $fieldAttribute->whereNull('user_list_id');
                } else {
                    $fieldAttribute = $fieldAttribute->where('user_list_id', $listId);
                }
                $fieldAttribute->update(['order' => $newIndex]);
            }
        }
        $listOrders = FieldAttribute::where('user_id', $userId)->whereIn('field_id', $fieldIds)->orderBy('order');
        if (is_null($listId)) {
            $listOrders = $listOrders->whereNull('user_list_id');
        } else {
            $listOrders = $listOrders->where('user_list_id', $listId);
        }
        $listOrders = $listOrders->get();
        foreach ($listOrders as $k => $list) {
            $list->order = $k;
            $list->save();
        }
        DB::commit();
        return true;
    }
}
