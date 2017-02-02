<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    public function department(){
        return $this->hasMany('App\Departments');
    }

    public function strategic_directions(){
        return $this->hasMany('App\StrategicDirections');
    }

    public function accounts(){
        return $this->hasMany('App\Account');
    }
}
