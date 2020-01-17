<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id', 'name', 'designation', 'comment', 'profile_pic',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
