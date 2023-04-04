<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomFieldValue extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'custom_field_id',
        'model_type',
        'model_id',
        'value',
    ];

    public function customField()
    {
        $this->belongsTo(CustomField::class);
    }

    public function scopeFor($query, $id, $type)
    {
        return $query->where('model_id', $id)->where('model_type', $type);
    }

    /**
     * Interact the user's last contacted.
     *
     * @return Attribute
     */
    protected function value(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->getValueForCustomField($value),
            set: fn ($value) => $this->setValueForCustomField($value),
        );
    }

    public function getValueForCustomField($value)
    {
        if (empty($value)) {
            return $value;
        }

        $values = json_decode($value);

        if (is_array($values) && !empty($values)) {
            $value = $values;
        }

        return $value;
    }

    public function setValueForCustomField($value)
    {
        if (is_array($value)) {
            $value = json_encode($value);
        }

        return $value;
    }
}
