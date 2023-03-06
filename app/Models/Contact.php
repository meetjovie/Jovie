<?php

namespace App\Models;

use App\Models\Scopes\TeamScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'team_id',
        'first_name',
        'last_name',
        'company',
        'title',
        'phone',
        'emails',
        'phone',
        'website',
        'city',
        'country',
        'gender',
        'last_contacted',
        'offer',
        'archived',
        'rating',
        'stage',
        'favourite',
        'muted',
        'source',
        'description',
        'description_updated_by',
        'instagram',
        'instagram_data',
        'twitter',
        'twitter_data',
        'linkedin',
        'linkedin_data',
        'tiktok',
        'tiktok_data',
        'twitch',
        'twitch_data',
        'youtube',
        'youtube_data',
        'snapchat',
        'snapchat_data',
        'onlyfans',
        'onlyfans_data',
        'wiki',
        'wiki_data',
        'last_enriched_at',
    ];

    protected $appends = ['stage_name'];

    protected $casts = [
        'instagram_data' => AsArrayObject::class,
        'twitter_data' => AsArrayObject::class,
        'linkedin_data' => AsArrayObject::class,
        'tiktok_data' => AsArrayObject::class,
        'twitch_data' => AsArrayObject::class,
        'youtube_data' => AsArrayObject::class,
        'snapchat_data' => AsArrayObject::class,
        'onlyfans_data' => AsArrayObject::class,
        'wiki_data' => AsArrayObject::class,
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new TeamScope());
    }

    /**
     * Determine the stage of contact.
     */
    protected function stageName($value): Attribute
    {
        return new Attribute(
            get: fn () => $this->stages()[$value],
        );
    }

    public static function stages()
    {
        return [
            0 => 'Lead',
            1 => 'Interested',
            2 => 'Negotiating',
            3 => 'In Progress',
            4 => 'Complete',
            5 => 'Not Interested',
        ];
    }

    /**
     * Interact the user's last contacted.
     *
     * @return Attribute
     */
    protected function lastContacted(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => Carbon::make($value)->toDateString(),
        );
    }
}
