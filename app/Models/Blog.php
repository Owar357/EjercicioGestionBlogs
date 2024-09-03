<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }


    public function blogTag()
    {
        return $this->hasMany(BlogTag::class);
    }
   

    // public function blogTags()
    // {
    //     return $this->belongsTo(BlogTag::class);
    // }
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blogs_tags', 'blog_id', 'tag_id');
    }
    
}
