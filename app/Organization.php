<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $with = ['user'];

    public function user()
    { 
        return $this->morphOne('App\User', 'profile');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
