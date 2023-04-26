<?php

namespace App\Models;

use App\Models\Scopes\TeamScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'team_id',
        'key',
        'value',
    ];

    const SETTING_KEYS = [
        'auto_enrich',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new TeamScope());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public static function setSetting($key, $value)
    {
        $user = auth()->user();
        return self::updateOrCreate(
            [
                'key' => $key
            ],
            [
                'user_id' => $user->id,
                'team_id' => $user->currentTeam->id,
                'value' => $value
            ],
        );
    }
}
