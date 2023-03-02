<?php

namespace App\Models;

use App\Models\Scopes\TeamScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreatorComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'creator_id',
        'user_id',
        'team_id',
        'comment',
        'deleted_by',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new TeamScope());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
