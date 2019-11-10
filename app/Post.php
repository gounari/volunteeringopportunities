<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function organization()
    {
    	return $this->belongsTo('App\Organization');
    }

    public function volunteers()
    {
    	return $this->belongsToMany('App\Volunteer');
    }

    public function comments()
    {
    	return $this->hasMany('App\Comment');
    }

    public function applicationForm()
    {
    	return $this->hasOne('App\ApplicationForm');
    }
}
