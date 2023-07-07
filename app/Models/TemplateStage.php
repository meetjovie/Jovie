<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateStage extends Model
{
    use HasFactory, HasUuids;


    protected $fillable = [
        'template_id',
        'user_id',
        'team_id',
        'name',
        'color',
        'order'
    ];

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
