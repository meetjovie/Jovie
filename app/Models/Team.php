<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mpociot\Teamwork\TeamworkTeam;

class Team extends TeamworkTeam
{
    protected $with = ['users'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'team_user', 'team_id', 'team_id')->withTimestamps();
    }
}
