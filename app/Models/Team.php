<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;
use Mpociot\Teamwork\TeamworkTeam;

class Team extends TeamworkTeam
{
    use Billable;
}
