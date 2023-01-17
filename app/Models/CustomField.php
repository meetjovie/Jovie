<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
    use HasFactory;

    const CUSTOM_FIELD_TYPES = [
        [
            'id' => 'text',
            'type' => 'Text',
        ],
        [
            'id' => 'number',
            'type' => 'Number',
        ],
        [
            'id' => 'currency',
            'type' => 'Currency',
        ],
        [
            'id' => 'date',
            'type' => 'Date',
        ],
        [
            'id' => 'url',
            'type' => 'URL',
        ],

        [
            'id' => 'checkbox',
            'type' => 'Checkbox',
        ],
        [
            'id' => 'select',
            'type' => 'Single Select',
        ],
        [
            'id' => 'multi_select',
            'type' => 'Multi Select',
        ],
    ];

    protected $fillable = [
        'user_id',
        'team_id',
        'name',
        'type',
        'icon',
        'hide',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
