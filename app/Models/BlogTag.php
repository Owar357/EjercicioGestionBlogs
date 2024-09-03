<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{

    protected $table = 'blogs_tags'; 
    use HasFactory;

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
    
   
}
