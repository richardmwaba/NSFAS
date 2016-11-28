<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    public function school(){
        return $this->belongsTo('App\School');
    }

    public function user(){
        return $this->hasMany('App\User');
    }

    public function staff(){
        return $this->hasMany('App\Staff');
    }

    public function projects(){
        return $this->hasMany('App\Projects');
    }

    public function budget(){
        return $this->hasOne('App\Departments');
    }

}
