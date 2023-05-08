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

    protected $fillable = [
        'user_id',
        'team_id',
        'field_id',
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

        return $fieldAttributes->get();
    }

    public static function updateSortOrder($userId, $newIndex = 0, $oldIndex = 0, $fieldId = null)
    {
        $customFieldIds = CustomField::query()->pluck('id')->toArray();
        $defaultIds = array_column(FieldAttribute::DEFAULT_FIELDS, 'id');

        $fieldIds = array_merge($customFieldIds, $defaultIds);
        $fieldIdsToUpdate = array_map('strval', array_diff($fieldIds, [$fieldId]));

        DB::beginTransaction();
        if (!is_null($fieldId)) {
            if ($newIndex > $oldIndex) {

                FieldAttribute::where('order', '<=', $newIndex)
                    ->whereIn('field_id', $fieldIdsToUpdate)
                    ->where('user_id', $userId)
                    ->update(['order' => (DB::raw('`order` - 1'))]);

                FieldAttribute::where('field_id', $fieldId)
                    ->where('user_id', $userId)
                    ->update(['order' => $newIndex]);

            } elseif ($newIndex < $oldIndex) { // newIndex < $oldIndex
                FieldAttribute::where('order', '>=', $newIndex)
                    ->whereIn('field_id', $fieldIdsToUpdate)
                    ->where('user_id', $userId)
                    ->update(['order' => (DB::raw('`order` + 1'))]);

                FieldAttribute::where('field_id', $fieldId)
                    ->where('user_id', $userId)
                    ->update(['order' => $newIndex]);
            }
        }
        $listOrders = FieldAttribute::whereIn('field_id', $fieldIds)
            ->orderBy('order')
            ->where('user_id', $userId);
        $listOrders = $listOrders->get();
        foreach ($listOrders as $k => $list) {
            $list->order = $k;
            $list->save();
        }
        DB::commit();
        return true;
    }

    public static function toggleFieldHide($user, $fieldId, $hide)
    {
        $fieldAttribute = FieldAttribute::where('field_id', $fieldId)
            ->where('user_id', $user->id);
        $fieldAttribute = $fieldAttribute->first();
        if ($fieldAttribute) {
            $fieldAttribute->hide = $hide;
            return $fieldAttribute->save();
        }
        return false;
    }
}
