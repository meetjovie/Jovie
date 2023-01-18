<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CustomField extends Model
{
    use HasUuids;

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
        'code',
        'type',
        'icon',
        'hide',
    ];

    /**
     * Get the field code.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function code(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ('custom_'.Str::slug($this->name, '_')),
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
