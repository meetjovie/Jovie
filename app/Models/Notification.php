<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'message',
        'meta',
    ];

    public function getMetaAttribute($value)
    {
        if ($value) {
            return json_decode($value);
        }
    }

    public function setMetaAttribute($value)
    {
        if ($value) {
            $this->attributes['meta'] = json_encode($value);
        }
    }
}
