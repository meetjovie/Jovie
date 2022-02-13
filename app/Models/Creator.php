<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creator extends Model
{
    use HasFactory;

    const CREATORS_MEDIA_PATH = 'public/creators_media/timeline_media/';
    const CREATORS_PROFILE_PATH = 'public/creators_media/profiles/';

    public function getInstagramMediaAttribute($value)
    {
        return json_decode($value ?? '[]');
    }

    public function getInstagramMetaAttribute($value)
    {
        return json_decode($value ?? '[]');
    }

    public function getSocialLinksAttribute($value)
    {
        return json_decode($value ?? '[]');
    }

    public function getTagsAttribute($value)
    {
        return json_decode($value ?? '[]');
    }

    public function getEmailsAttribute($value)
    {
        return json_decode($value ?? '[]');
    }

    public function brands()
    {
        return $this->belongsToMany(Creator::class, 'brand_creator',
            'creator_id',
            'brand_id',
            'id',
            'id')->withTimestamps();
    }
}
