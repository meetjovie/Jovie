<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Crm extends Model
{
    use HasFactory, Searchable, HasUuids;

    protected $fillable = [
        'creator_id',
        'user_id',
        'team_id',
        'last_contacted',
        'selected',
        'rejected',
        'rating',
        'stage',
        'favourite',
        'archived',
        'meta',
        'offer',
        'source'
    ];

//    protected $appends = ['stage_name'];

    public function toSearchableArray()
    {
        $array = $this->toArray();

        return $array;
    }

    public function stageName($value = null): string
    {
        return $this->stages()[$value];
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

    public function setMetaAttribute($value)
    {
        $this->attributes['meta'] = json_encode($value);
    }

    public function getMetaAttribute($value)
    {
        return json_decode($value ?? '[]');
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
            set: fn ($value) => Carbon::make($value)->toDateTimeString(),
        );
    }
}
