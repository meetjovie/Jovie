<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreatorNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'creator_id',
        'note',
    ];

    public function creator()
    {
        return $this->belongsTo(Creator::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
