<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objectives extends Model
{
    public function department(){
        return $this->belongsTo('App\Departments');
    }

    public function strategicDirection(){
        return $this->belongsTo('App\StrategicDirections');
    }

    public function activity(){
        return $this->hasMany('App\Activities');
    }
}
