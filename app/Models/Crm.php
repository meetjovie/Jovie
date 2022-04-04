<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crm extends Model
{
    use HasFactory;

    protected $fillable = [
        'creator_id',
        'user_id',
        'selected',
        'rejected',
    ];

    public function getStageAttribute($value)
    {
        $value = $value ?? 0;
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
}
