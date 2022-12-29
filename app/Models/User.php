<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use App\Notifications\SendEmailVerificationNotification;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;
use Mpociot\Teamwork\Traits\UserHasTeams;

class User extends Authenticatable implements MustVerifyEmail
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
        'profile_pic_url',
        'google_id'
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

    public static function currentLoggedInUser($userId = null)
    {
        $user = self::with('teams', 'teams.users', 'teams.invites', 'currentTeam', 'ownedTeams')
            ->where('id', $userId ?? Auth::id())->first();
        if ($user->currentSubscription) {
            $user->currentTeam->current_subscription = $user->currentTeam->currentSubscription();
            $user->isCurrentTeamOwner = $user->currentTeam->owner_id == $user->id;
            $user->currentTeam->subscribed = false;
            if ($user->currentTeam->current_subscription) {
                $user->currentTeam->subscribed = $user->currentTeam->subscribed($user->currentTeam->current_subscription->name);
            }
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
            ->where(function ($q) {
                $q->where(function ($qq) {
                    $qq->where('instagram_dispatched', '!=', 1)
                        ->orWhere(function ($qqq) {
                            $qqq->where('instagram', '!=', null)->where('instagram_scrapped', '!=', 1);
                        });
                })->orWhere(function ($qq) {
                    $qq->where('twitch_dispatched', '!=', 1)
                        ->orWhere(function ($qqq) {
                            $qqq->where(function ($qqqq) {
                                $qqqq->where('twitch', '!=', null)->orWhere('twitch_id', '!=', null);
                            })->where('twitch_scrapped', '!=', 1);
                        });
                })->orWhere(function ($qq) {
                    $qq->where('twitter_dispatched', '!=', 1)
                        ->orWhere(function ($qqq) {
                            $qqq->where('twitter', '!=', null)->where('twitter_scrapped', '!=', 1);
                        });
                });
            })
        ->limit(200000000000000000000000);
    }

    public function pendingImportsByNetwork($network)
    {
        return Import::where('user_id', $this->id)->where($network, '!=', null)->where($network.'_dispatched', '!=', 1)->where($network.'_scrapped', '!=', 1)->limit(1000)->get();
    }

    public function sendNotification($message, $type, $meta = null)
    {
        Notification::create([
            'message' => $message,
            'type' => $type,
            'meta' => $meta,
            'user_id' => $this->id,
        ]);
    }

    public function sendPasswordResetNotification($token)
    {
        $url = (config('app.url').'/reset-password?token='.$token);
        $this->notify(new ResetPasswordNotification($url));
    }

    public function getTwitterHandlerAttribute($value)
    {
        if ($value) {
            return 'https://twitter.com/'.$value;
        }

        return null;
    }

    public function setTwitterHandlerAttribute($value)
    {
        // Regex for verifying a twitter URL
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:twitter\.com)\/([A-Za-z0-9-_\.]+)/';

        // Verify valid twitter URL
        if (preg_match($regex, $value, $matches)) {
            $this->attributes['twitter_handler'] = $matches[1];

            return;
        }
        $this->attributes['twitter_handler'] = $value;
    }

    public function getTwitchHandlerAttribute($value)
    {
        if ($value) {
            return 'https://twitch.tv/'.$value;
        }

        return null;
    }

    public function getInstagramHandlerAttribute($value)
    {
        if ($value) {
            return 'https://instagram.com/'.$value;
        }

        return null;
    }

    public function setInstagramHandlerAttribute($value)
    {
        // Regex for verifying an instagram URL
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:instagram\.com|instagr\.am)\/([A-Za-z0-9-_\.]+)/im';

        // Verify valid Instagram URL
        if (preg_match($regex, $value, $matches)) {
            $this->attributes['instagram_handler'] = $matches[1];

            return;
        }
        $this->attributes['instagram_handler'] = $value;
    }

    public function getYoutubeHandlerAttribute($value)
    {
        if ($value) {
            return 'https://youtube.com/c/'.$value;
        }

        return null;
    }

    public function setYoutubeHandlerAttribute($value)
    {
        $oldYoutube = $this->youtube_handler;
        if (! count((array) $value)) {
            return $oldYoutube;
        }
        // Regex for verifying a youtube URL - channel id
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:youtube\.com\/)?(?:channel)\/([A-Za-z0-9-_\.]+)/';
        // Verify valid youtube URL
        if (preg_match($regex, $value, $matches)) {
            $oldYoutube->channel_id = $matches[1];
            $this->attributes['youtube_handler'] = json_encode($oldYoutube);
        }
        // Regex for verifying a youtube URL - channel name
        elseif (preg_match('/(?:(?:http|https):\/\/)?(?:www\.)?(?:youtube\.com\/)?(?:c)\/([A-Za-z0-9-_\.]+)/', $value, $matches)) {
            $oldYoutube->channel_name = $matches[1];
            $this->attributes['youtube_handler'] = json_encode($oldYoutube);
        } elseif (preg_match('/(?:(?:http|https):\/\/)?(?:www\.)?(?:youtube\.com\/)?(?:user)\/([A-Za-z0-9-_\.]+)/', $value, $matches)) {
            $oldYoutube->channel_name = $matches[1];
            $this->attributes['youtube'] = json_encode($oldYoutube);
        } elseif (in_array(substr($value, 0, 2), ['UC', 'HC'])) {
            $oldYoutube->channel_id = $value;
            $this->attributes['youtube_handler'] = json_encode($oldYoutube);
        } else {
            $oldYoutube->channel_name = $value;
            $this->attributes['youtube_handler'] = json_encode($oldYoutube);
        }
    }

    public function getTiktokHandlerAttribute($value)
    {
        if ($value) {
            $value = $value[0] == '@' ? $value : ('@'.$value);
            return 'https://www.tiktok.com/'.$value;
        }

        return null;
    }

    public function setTiktokHandlerAttribute($value)
    {
        // Regex for verifying an tiktok URL
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:tiktok\.com)\/([\@|A-Za-z0-9-_\.]+)/';

        // Verify valid tiktok URL
        if (preg_match($regex, $value, $matches)) {
            $this->attributes['tiktok_handler'] = $matches[1];

            return;
        }
        $this->attributes['tiktok_handler'] = $value;
    }

    public function userListAttributes()
    {
        return $this->belongsToMany(UserList::class, 'user_list_attributes')->withTimestamps();
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new SendEmailVerificationNotification());
    }

    public function validateCode($code = null)
    {
        if (is_null($code) || $this->verification_code != $code || $this->codeExpired()) {
            return false;
        }
        return true;
    }

    private function codeExpired()
    {
        return Carbon::make($this->verification_code_expires_at)->lte(Carbon::now());
    }
}
