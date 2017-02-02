<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    public function calculatedTotal(){
        return $this->hasOne('App\CalculatedTotal');
    }

    public function project(){
        return $this->hasOne('App\Projects');
    }

    public function expenditure(){
        return $this->hasMany('App\Expenditure');
    }

    public function income(){
        return $this->hasMany('App\Income');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function budget(){
        return $this->hasOne('App\Budget');
    }

    public function school(){
        return $this->belongsTo('App\School');
    }
}
