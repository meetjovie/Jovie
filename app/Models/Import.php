<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_list_id',
        'tags',
        'first_name',
        'last_name',
        'city',
        'country',
        'instagram',
        'youtube',
        'twitter',
        'twitch',
        'onlyFans',
        'tiktok',
        'linkedin',
        'snapchat',
        'wikiId',
        'social_handlers',
        'phone',
        'gender',
    ];
}
