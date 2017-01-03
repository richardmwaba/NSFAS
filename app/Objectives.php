<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objectives extends Model
{
    public function department(){
        return $this->belongsTo('App\Departments');
    }

    public function strategic_directions(){
        return $this->belongsTo('App\StrategicDirections');
    }

    public function activities(){
        return $this->hasMany('App\Activities');
    }
}
