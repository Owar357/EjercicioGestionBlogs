<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';
    
    public function blogTags()
    {
        return $this->hasMany(BlogTag::class);
    }

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'blogs_tags', 'tag_id', 'blog_id');
    }
   
}
