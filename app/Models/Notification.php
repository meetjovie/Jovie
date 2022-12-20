<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory, HasUuids;

    const BATCH_IMPORT = 1;

    const SINGLE_IMPORT = 2;

    const OUT_OF_CREDITS = 3;

    const SINGLE_IMPORT_FAILED = 4;

    const BATCH_IMPORT_FAILED = 5;

    const IMPORT_QUEUED = 6;

    protected $appends = ['is_error'];

    protected $fillable = [
        'user_id',
        'team_id',
        'type',
        'message',
        'meta',
    ];

    public static function createNotification(string $message, int $type, $userId, $teamId)
    {
        self::create([
            'message' => $message,
            'type' => $type,
            'user_id' => $userId,
            'team_id' => $teamId,
        ]);
        \App\Events\Notification::dispatch($teamId);
    }

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
