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

    protected $casts = [
        'value' => 'boolean',
    ];

    const SETTINGS = [
        'auto_enrich_import' => [
            'default' => false,
            'type' => 'radio',
            'description' => 'Automatically enrich contacts when imported. This will use enrichment credits from your plan.'
        ],
        'auto_enrich_update' => [
            'default' => false,
            'type' => 'radio',
            'description' => 'Automatically enrich contacts when updated. This will use enrichment credits from your plan.'
        ],
        'calender_event_note'=> [
            'default' => 'Added to Calender event in Jovie',
            'type' => 'text',
            'description' => 'Set a default note to be added to new calender events created by Jovie.'
        ],
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

    public static function getAllTeamSettings(){
        $settingKeys = array_keys(TeamSetting::SETTINGS);
        $teamSettings = TeamSetting::whereIn('key', $settingKeys)
            ->pluck('value','key')->toArray();
        $defaultSettings = TeamSetting::SETTINGS;

        $teamKeys = array_keys($teamSettings);

        foreach ($settingKeys as $settingKey) {
            if (in_array($settingKey, $teamKeys)) {
                $defaultSettings[$settingKey]['value'] = isset($teamSettings[$settingKey]) ? $teamSettings[$settingKey] : TeamSetting::SETTINGS[$settingKey]['default'];
            }
        }
        return $defaultSettings;
    }

    public static function getSetting($key)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : null;
    }

    public static function setSetting($key, $value)
    {
        $user = auth()->user();

        return self::updateOrCreate(
            [
                'key' => $key,
                'team_id' => $user->currentTeam->id
            ],
            [
                'user_id' => $user->id,
                'value' => $value
            ],
        );
    }
}
