<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    public function department(){
        return $this->hasMany('App\Departments');
    }

    public function strategicDirections(){
        return $this->hasMany('App\StrategicDirections');
    }
}
