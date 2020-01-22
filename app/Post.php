<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'post_title', 'post_body', 'post_image', 
    ];

    public function comments()
    {
        return $this->hasMany('App\Comment', 'post_id');
    }
    
}

