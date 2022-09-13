<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Crm extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'creator_id',
        'user_id',
        'team_id',
        'selected',
        'rejected',
        'rating',
        'stage',
        'favourite',
        'archived',
        'meta'
    ];

    public function toSearchableArray()
    {
        $array = $this->toArray();

        return $array;
    }

    public function getStageAttribute($value)
    {
        $value = $value ?? 0;

        return self::stages()[$value];
    }

    public static function stages()
    {
        return [
            0 => 'Lead',
            1 => 'Interested',
            2 => 'Negotiating',
            3 => 'In Progress',
            4 => 'Complete',
        ];
    }
}
