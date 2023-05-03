<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateSetting extends Model
{
    use HasFactory, HasUuids;


    protected $fillable = [
        'template_id',
        'name',
        'user_id',
        'team_id',
        'key',
        'value',
        'icon',
        'type',
        'visible',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}
