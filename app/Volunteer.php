<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $guarded = [];
  
    public function user()
    { 
        return $this->morphOne('App\User', 'profile');
    }

    public function posts()
    {
    	return $this->belongsToMany('App\Post');
    }
}
