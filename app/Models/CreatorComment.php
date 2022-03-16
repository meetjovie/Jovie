<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreatorComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'creator_id',
        'user_id',
        'comment',
        'deleted_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
