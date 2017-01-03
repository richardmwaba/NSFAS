<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{

    public function activities(){
        return $this->hasMany('App\Activities');
    }
    public function objectives(){
        return $this->hasMany('App\Objectives');
    }

    public function school(){
        return $this->belongsTo('App\School');
    }

    public function user(){
        return $this->hasMany('App\User');
    }

    public function budgets()
    {
        return $this->hasMany('App\Budget', 'departmentId');
    }

    public function imprests()
    {
        return $this->hasMany('App\Imprest', 'departmentId', 'id');
    }

    public function budget(){
        return $this->hasOne('App\Departments');
    }
    public function staff(){
            return $this->hasMany('App\Staff');
        }
    public function projects(){
            return $this->hasMany('App\Projects');
        }

}
