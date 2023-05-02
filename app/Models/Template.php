<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'team_id',
        'name',
        'description',
        'icon',
    ];

    const DEFAULT_TEMPLATE_NAME = 'Default';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function templateSettings()
    {
        return $this->hasMany(TemplateSetting::class);
    }

    public function templateStages()
    {
        return $this->hasMany(TemplateStage::class);
    }

    public function templateFields()
    {
        return $this->hasMany(TemplateField::class);
    }

}
