<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    const BATCH_IMPORT = 1;
    const SINGLE_IMPORT = 2;
    const OUT_OF_CREDITS = 3;
    const SINGLE_IMPORT_FAILED = 4;
    const BATCH_IMPORT_FAILED = 5;

    protected $appends = ['is_error'];

    protected $fillable = [
        'user_id',
        'type',
        'message',
        'meta',
    ];

    public function getIsErrorAttribute()
    {
        $type = $this->attributes['type'];

        // error notifications
        if (in_array($type, [self::BATCH_IMPORT_FAILED, self::SINGLE_IMPORT_FAILED, self::OUT_OF_CREDITS])) {
            return true;
        }
        return false;
    }

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
