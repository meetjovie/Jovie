<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;
use Mpociot\Teamwork\Traits\UserHasTeams;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UserHasTeams;

    const UPLOAD_PATH = 'public/jovie/user/profiles/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'profile_pic_url'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['default_image', 'full_name'];

    public static function currentLoggedInUser()
    {
        $user = User::with('teams', 'teams.users', 'teams.invites', 'currentTeam', 'ownedTeams')
            ->where('id', Auth::id())->first();
        $user->currentTeam->current_subscription = $user->currentTeam->currentSubscription();
        $user->isCurrentTeamOwner = $user->currentTeam->owner_id == $user->id;
        $user->currentTeam->subscribed = false;
        if ($user->currentTeam->current_subscription) {
            $user->currentTeam->subscribed = $user->currentTeam->subscribed($user->currentTeam->current_subscription->name);
        }
        return $user;
    }

    public function ownedTeams()
    {
        return $this->hasMany(Team::class, 'owner_id', 'id')->with('users');
    }

    public function creatorProfile()
    {
        return $this->hasOne(Creator::class);
    }

    public function crms()
    {
        return $this->belongsToMany(Creator::class, 'crms')->withPivot(['offer', 'stage', 'last_contacted', 'muted'])->withTimestamps();
    }

    public function routeNotificationForSlack($notification)
    {
        return env('SLACK_NOTIFICATION_WEBHOOK');
    }

    public function getProfilePicUrlAttribute($value)
    {
        return $value ?? asset('img/noimage.webp');
    }

    public function getDefaultImageAttribute()
    {
        return asset('img/noimage.webp');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function pendingImports()
    {
        return $this->hasMany(Import::class)->orderByDesc('created_at')
            ->where('dispatched', '!=', 1)
            ->where(function ($q) {
                $q->where('instagram_scrapped', '!=', 1);
            })
            ->limit(2);
    }
}
