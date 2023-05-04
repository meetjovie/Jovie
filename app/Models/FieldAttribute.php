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
            'name' => 'Address',
            'icon' => 'MapPinIcon',
            'id' => 1,
            'model' => 'address',
            'value' => 'address',
            'isCopyable' => true,
            'placeholder' => '',
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
            'model' => 'phones',
            'value' => 'phones',
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
            /*      'action' => this.openLink('creator.meta.instagram'), */
            'model' => 'instagram',
            'method' => 'openLink',
            'method2' => 'instagramDMContact',
            'params' => 'instagram',
            'value' => 'instagram',
            'isCopyable' => true,
            'placeholder' => 'Instagram',
        ],
        [
            'name' => 'Twitter',
            'socialicon' => 'twitter',
            'id' => 6,
            'actionIcon' => 'ArrowTopRightOnSquareIcon',
            /*   'action' => this.openLink('creator.meta.twitter'), */
            'model' => 'twitter',

            'method' => 'openURL',
            'params' => 'twitter',
            'value' => 'twitter',
            'isCopyable' => true,
            'placeholder' => 'Twitter',
        ],
        [
            'name' => 'TikTok',
            'socialicon' => 'tiktok',
            'id' => 7,
            'actionIcon' => 'ArrowTopRightOnSquareIcon',
            /*   'action' => this.openLink('creator.meta.tiktok'), */
            'model' => 'tiktok',
            'value' => 'tiktok',
            'method' => 'openURL',
            'params' => 'tiktok',
            'isCopyable' => true,
            'placeholder' => 'TikTok',
        ],
        [
            'name' => 'Youtube',
            'socialicon' => 'youtube',
            'id' => 8,
            'actionIcon' => 'ArrowTopRightOnSquareIcon',
            /*      'action' => this.openLink('creator.meta.youtube'), */
            'model' => 'youtube',
            'value' => 'youtube',
            'method' => 'openURL',
            'params' => 'youtube',
            /* 'method' => 'openLink', */
            'isCopyable' => true,
            'placeholder' => 'Youtube',
        ],
        [
            'name' => 'Twitch',
            'socialicon' => 'twitch',
            'id' => 9,
            'actionIcon' => 'ArrowTopRightOnSquareIcon',
            /*   'action' => this.openLink('creator.meta.twitch'), */
            'model' => 'twitch',
            'params' => 'twitch',
            'value' => 'twitch',
            'method' => 'openURL',
            'isCopyable' => true,
            'placeholder' => 'Twitch',
        ],
        [
            'name' => 'Linkedin',
            'socialicon' => 'linkedin',
            'id' => 10,
            'actionIcon' => 'ArrowTopRightOnSquareIcon',
            /*    'action' => this.openLink('creator.meta.linkedin'), */
            'model' => 'linkedin',
            'value' => 'linkedin',
            'params' => 'linkedin',
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
            'sortable' => true,
            'hide' => true,
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
            'hide' => true,
            'sortable' => true,
            'breakpoint' => '2xl',
            'width' => '40',
            'type' => 'text',
        ],
        [
            'id' => 3,
            'name' => 'Title',
            'key' => 'title',
            'meta' => true,
            'icon' => 'UserIcon',
            'hide' => true,
            'sortable' => true,
            'breakpoint' => '2xl',
            'type' => 'text',
        ],
        [
            'id' => 4,
            'name' => 'Company',
            'key' => 'company',
            'meta' => true,
            'icon' => 'BriefcaseIcon',
            'hide' => true,
            'sortable' => true,
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
            'hide' => false,
            'sortable' => true,
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
            'hide' => false,
            'width' => '40',
            'type' => 'socialLinks',
        ],
        [
            'id' => 7,
            'name' => 'Offer',
            'key' => 'offer',
            'icon' => 'CurrencyDollarIcon',
            'sortable' => true,
            'hide' => true,
            'breakpoint' => 'lg',
            'width' => '40',
            'type' => 'currency',
        ],
        [
            'id' => 8,
            'name' => 'Stage',
            'key' => 'stage',
            'icon' => 'ArrowDownCircleIcon',
            'width' => '40',
            'sortable' => true,
            'hide' => false,
            'breakpoint' => 'md',
            'type' => 'select',
        ],
        [
            'id' => 9,
            'name' => 'Last Contact',
            'key' => 'last_contacted',
            'icon' => 'CalendarDaysIcon',
            'sortable' => true,
            'hide' => true,
            'breakpoint' => '2xl',
            'width' => '40',
            'type' => 'date',
        ],
        [
            'id' => 10,
            'name' => 'Rating',
            'key' => 'rating',
            'icon' => 'StarIcon',
            'sortable' => true,
            'hide' => false,
            'breakpoint' => '2xl',
            'width' => '40',
            'type' => 'rating',
        ],
        [
            'id' => 11,
            'name' => 'Lists',
            'key' => 'lists',
            'icon' => 'ListBulletIcon',
            'hide' => false,
            'breakpoint' => '2xl',
            'width' => '40',
            'type' => 'multi_select',
        ],
        [
            'id' => 12,
            'name' => 'Description',
            'key' => 'description',
            'icon' => 'ListBulletIcon',
            'hide' => false,
            'default' => true,
            'breakpoint' => '2xl',
            'width' => '40',
            'type' => 'text',
        ],
    ];

    const FULL_NAME_HEADER = [
        'name' => 'Name',
        'key' => 'full_name',
        'meta' => true,
        'icon' => 'Bars3BottomLeftIcon',
        'sortable' => true,
        'hide' => false,
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
        'width',
    ];

    protected $casts = [
        'width' => 'integer'
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

    public static function getFieldsAttributes($params = [])
    {
        $fieldAttributes = FieldAttribute::query()->orderBy('order');

        if (isset($params['team_id'])) {
            $fieldAttributes = $fieldAttributes->where('team_id', $params['team_id']);
        }

        if (isset($params['user_id'])) {
            $fieldAttributes = $fieldAttributes->where('user_id', $params['user_id']);
        }

        if (isset($params['user_list_id']) && $params['user_list_id'] != 0) {
            $fieldAttributes = $fieldAttributes->where('user_list_id', $params['user_list_id']);
        } else {
            $fieldAttributes = $fieldAttributes->whereNull('user_list_id');
        }

        return $fieldAttributes->get();
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
                    ->whereIn('field_id', $fieldIdsToUpdate);
                if (is_null($listId)) {
                    $fieldAttribute = $fieldAttribute->whereNull('user_list_id')
                        ->where('user_id', $userId);
                } else {
                    $fieldAttribute = $fieldAttribute->where('user_list_id', $listId);
                }
                $fieldAttribute->update(['order' => (DB::raw('`order` - 1'))]);
                // update userlist set order = newOrder where id = listId
                $fieldAttribute = FieldAttribute::where('field_id', $fieldId);
                if (is_null($listId)) {
                    $fieldAttribute = $fieldAttribute->whereNull('user_list_id')->where('user_id', $userId);
                } else {
                    $fieldAttribute = $fieldAttribute->where('user_list_id', $listId);
                }
                $fieldAttribute->update(['order' => $newIndex]);
            } elseif ($newIndex < $oldIndex) { // newIndex < $oldIndex
                // update user list set order = order+1 where order >= newIndex and id != listID
                $fieldAttribute = FieldAttribute::where('order', '>=', $newIndex)
                    ->whereIn('field_id', $fieldIdsToUpdate);
                if (is_null($listId)) {
                    $fieldAttribute = $fieldAttribute->whereNull('user_list_id')
                        ->where('user_id', $userId);
                } else {
                    $fieldAttribute = $fieldAttribute->where('user_list_id', $listId);
                }
                $fieldAttribute->update(['order' => (DB::raw('`order` + 1'))]);
                // update userlist set order = newOrder where id = listId
                $fieldAttribute = FieldAttribute::where('field_id', $fieldId);
                if (is_null($listId)) {
                    $fieldAttribute = $fieldAttribute->whereNull('user_list_id')
                        ->where('user_id', $userId);
                } else {
                    $fieldAttribute = $fieldAttribute->where('user_list_id', $listId);
                }
                $fieldAttribute->update(['order' => $newIndex]);
            }
        }
        $listOrders = FieldAttribute::whereIn('field_id', $fieldIds)->orderBy('order');
        if (is_null($listId)) {
            $listOrders = $listOrders->whereNull('user_list_id')->where('user_id', $userId);
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

    public static function toggleFieldHide($user, $fieldId, $hide, $listId = null)
    {
        $fieldAttribute = FieldAttribute::where('field_id', $fieldId);
        if (is_null($listId)) {
            $fieldAttribute = $fieldAttribute->whereNull('user_list_id')->where('user_id', $user->id);
        } else {
            $fieldAttribute = $fieldAttribute->where('user_list_id', $listId);
        }
        $fieldAttribute = $fieldAttribute->first();
        if ($fieldAttribute) {
            $fieldAttribute->hide = $hide;
            return $fieldAttribute->save();
        }
        return false;
    }

    public static function updateFieldWidth($user, $fieldId, $width, $listId = null)
    {
        $fieldAttribute = FieldAttribute::where('field_id', $fieldId);
        $fieldAttribute = $fieldAttribute->where('user_list_id', $listId);
        $fieldAttribute = $fieldAttribute->first();
        if ($fieldAttribute) {
            $fieldAttribute->width = $width;
            return $fieldAttribute->save();
        }
        return false;
    }
}
