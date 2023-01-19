<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CustomField extends Model
{
    use HasFactory, HasUuids;

    const CUSTOM_FIELD_TYPES = [
        [
            'id' => 'text',
            'name' => 'Text',
            'type' => 'Text',
            'icon' => 'CalenderDaysIcon',
        ],
        [
            'id' => 'number',
            'name' => 'Number',
            'type' => 'Number',
        ],
        [
            'id' => 'currency',
            'name' => 'Currency',
            'type' => 'Currency',
        ],
        [
            'id' => 'date',
            'name' => 'Date',
            'type' => 'Date',
            'icon' => 'CalenderDaysIcon',
        ],
        [
            'id' => 'url',
            'name' => 'URL',
            'type' => 'URL',
            'icon' => 'LinkIcon',
        ],

        [
            'id' => 'checkbox',
            'name' => 'Checkbox',
            'type' => 'Checkbox',
            'icon' => 'CheckIcon',
        ],
        [
            'id' => 'select',
            'name' => 'Single Select',
            'type' => 'Single Select',
        ],
        [
            'id' => 'multi_select',
            'name' => 'Multi Select',
            'type' => 'Multi Select',
            'icon' => 'ListBulletIcon',
        ],
    ];

    protected $fillable = [
        'user_id',
        'team_id',
        'name',
        'code',
        'description',
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

    public function customFieldOptions()
    {
        return $this->hasMany(CustomFieldOption::class);
    }

    public function customFieldValues()
    {
        $this->hasMany(CustomFieldValue::class);
    }
}
