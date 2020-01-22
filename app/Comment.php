<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $guarded = ['id'];
    
    public function post ()
    {
        return $this->belongsTo('App\Post');
    }
}