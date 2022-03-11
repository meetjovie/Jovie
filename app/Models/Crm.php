<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crm extends Model
{
    use HasFactory;

    public function getStageAttribute($value)
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
}
