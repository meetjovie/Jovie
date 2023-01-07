<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $with = ['blogCategories'];

    use HasUuids;
    protected $fillable = [
        'title', 'author', 'publish_date', 'html'
    ];

    public function blogCategories()
    {
        return $this->belongsToMany(BlogCategory::class)->using(BlogPostCategory::class);
    }
}
