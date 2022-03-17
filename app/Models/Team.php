<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mpociot\Teamwork\TeamworkTeam;
use Spark\Billable;

class Team extends TeamworkTeam
{

    use Billable;

    protected $casts = [
        'trial_ends_at' => 'datetime',
    ];
}
