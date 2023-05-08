<?php

namespace App\Models;

use App\Models\Scopes\TeamScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HeaderAttribute extends Model
{
    use HasFactory;

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
        'header_id',
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

    public static function getHeaderAttributes($params = [])
    {
        $headerAttributes = FieldAttribute::query()->orderBy('order');

        if (isset($params['team_id'])) {
            $headerAttributes = $headerAttributes->where('team_id', $params['team_id']);
        }

        if (isset($params['user_id'])) {
            $headerAttributes = $headerAttributes->where('user_id', $params['user_id']);
        }

        if (isset($params['user_list_id']) && $params['user_list_id'] != 0) {
            $headerAttributes = $headerAttributes->where('user_list_id', $params['user_list_id']);
        }

        return $headerAttributes->get();
    }

    public static function updateSortOrder($userId, $newIndex = 0, $oldIndex = 0, $fieldId = null, $listId = null)
    {
        $customFieldIds = CustomField::query()->pluck('id')->toArray();
        $defaultIds = array_column(HeaderAttribute::DEFAULT_HEADERS, 'id');

        $fieldIds = array_merge($customFieldIds, $defaultIds);
        $fieldIdsToUpdate = array_map('strval', array_diff($fieldIds, [$fieldId]));

        DB::beginTransaction();
        if (!is_null($fieldId)) {
            if ($newIndex > $oldIndex) {

                // update user list set order = order-1 where order <= newIndex and id != listID
                $headerAttribute = HeaderAttribute::where('order', '<=', $newIndex)
                    ->whereIn('header_id', $fieldIdsToUpdate);
                if (is_null($listId)) {
                    $headerAttribute = $headerAttribute->whereNull('user_list_id')
                        ->where('user_id', $userId);
                } else {
                    $headerAttribute = $headerAttribute->where('user_list_id', $listId);
                }
                $headerAttribute->update(['order' => (DB::raw('`order` - 1'))]);
                // update userlist set order = newOrder where id = listId
                $headerAttribute = HeaderAttribute::where('header_id', $fieldId);
                if (is_null($listId)) {
                    $headerAttribute = $headerAttribute->whereNull('user_list_id')->where('user_id', $userId);
                } else {
                    $headerAttribute = $headerAttribute->where('user_list_id', $listId);
                }
                $headerAttribute->update(['order' => $newIndex]);

            } elseif ($newIndex < $oldIndex) { // newIndex < $oldIndex

                // update user list set order = order+1 where order >= newIndex and id != listID
                $headerAttribute = HeaderAttribute::where('order', '>=', $newIndex)
                    ->whereIn('header_id', $fieldIdsToUpdate);
                if (is_null($listId)) {
                    $headerAttribute = $headerAttribute->whereNull('user_list_id')
                        ->where('user_id', $userId);
                } else {
                    $headerAttribute = $headerAttribute->where('user_list_id', $listId);
                }
                $headerAttribute->update(['order' => (DB::raw('`order` + 1'))]);
                // update userlist set order = newOrder where id = listId
                $headerAttribute = HeaderAttribute::where('header_id', $fieldId);
                if (is_null($listId)) {
                    $headerAttribute = $headerAttribute->whereNull('user_list_id')
                        ->where('user_id', $userId);
                } else {
                    $headerAttribute = $headerAttribute->where('user_list_id', $listId);
                }
                $headerAttribute->update(['order' => $newIndex]);

            }
        }
        $listOrders = HeaderAttribute::whereIn('header_id', $fieldIds)->orderBy('order');
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

    public static function toggleHeaderHide($user, $fieldId, $hide, $listId = null)
    {
        $headerAttribute = FieldAttribute::where('header_id', $fieldId);
        if (is_null($listId)) {
            $headerAttribute = $headerAttribute->whereNull('user_list_id')->where('user_id', $user->id);
        } else {
            $headerAttribute = $headerAttribute->where('user_list_id', $listId);
        }
        $headerAttribute = $headerAttribute->first();
        if ($headerAttribute) {
            $headerAttribute->hide = $hide;
            return $headerAttribute->save();
        }
        return false;
    }

    public static function updateFieldWidth($user, $fieldId, $width, $listId = null)
    {
        $headerAttribute = FieldAttribute::where('header_id', $fieldId);
        if (is_null($listId)) {
            $headerAttribute = $headerAttribute->whereNull('user_list_id')->where('user_id', $user->id);
        } else {
            $headerAttribute = $headerAttribute->where('user_list_id', $listId);
        }
        $headerAttribute = $headerAttribute->first();
        if ($headerAttribute) {
            $headerAttribute->width = $width;
            return $headerAttribute->save();
        }
        return false;
    }
}
