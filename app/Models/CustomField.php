<?php

namespace App\Models;

use App\Models\Scopes\TeamScope;
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
            'icon' => 'Bars3BottomLeftIcon',
            'description' => 'A single line of text'
        ],
        [
            'id' => 'number',
            'name' => 'Number',
            'type' => 'Number',
            'icon' => 'HashtagIcon',
            'description' => 'A number'
        ],
        [
            'id' => 'phone',
            'name' => 'Phone',
            'type' => 'Phone',
            'icon' => 'PhoneIcon',
            'description' => 'A phone number'
        ],
        [
            'id' => 'currency',
            'name' => 'Currency',
            'type' => 'Currency',
            'icon' => 'CurrencyDollarIcon',
            'description' => 'A currency value'
        ],
        [
            'id' => 'date',
            'name' => 'Date',
            'type' => 'Date',
            'icon' => 'CalendarDaysIcon',
            'description' => 'Enter a date (e.g. 11/12/2013) or pick one from a calendar.'
        ],
        [
            'id' => 'url',
            'name' => 'URL',
            'type' => 'URL',
            'icon' => 'LinkIcon',
            'description' => 'A valid URL (e.g. jov.ie or https://jov.ie/tim).'
        ],
        [
            'id' => 'checkbox',
            'name' => 'Checkbox',
            'type' => 'Checkbox',
            'icon' => 'CheckIcon',
            'description' => 'A single checkbox that can be checked or unchecked.'
        ],
        [
            'id' => 'select',
            'name' => 'Single Select',
            'type' => 'Single Select',
            'icon' => 'ListBulletIcon',
            'description' => 'Single select allows you to select a single option from predefined options in a dropdown.'
        ],
        [
            'id' => 'multi_select',
            'name' => 'Multi Select',
            'type' => 'Multi Select',
            'icon' => 'ListBulletIcon',
            'description' => 'Multiple select allows you to select one or more predefined options listed below.'
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
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
//    protected static function booted()
//    {
//        static::addGlobalScope(new TeamScope());
//    }

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
        return $this->hasMany(CustomFieldOption::class)->orderBy('order');
    }

    public function customFieldValues()
    {
        return $this->hasMany(CustomFieldValue::class);
    }

    public function fieldAttributes()
    {
        return $this->hasMany(FieldAttribute::class, 'field_id');
    }
}
