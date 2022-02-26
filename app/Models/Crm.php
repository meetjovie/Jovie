<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crm extends Model
{
    use HasFactory;

    public function getInstagramStageAttribute($value)
    {
        return self::stages()[$value];
    }

    public static function stages()
    {
        return [
            0 => 'Onboarding',
            1 => 'Interested',
            2 => 'Negotiating',
            3 => 'In Progress',
            4 => 'Complete',
        ];
    }

    protected $appends = [
        'instagram_average_rating'
    ];

    public function getInstagramAverageRatingAttribute()
    {
        return Crm::where('creator_id', $this->creator_id)->avg('instagram_rating');
    }

    public function getInstagramRatingAttribute($value)
    {
        if (!$value) {
            return $this->instagram_average_rating;
        }
        return $value;
    }
}
