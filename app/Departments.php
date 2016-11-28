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

    public function budgets()
    {
        return $this->hasMany('App\Budget', 'departmentId');
    }

    public function imprests()
    {
        return $this->hasMany('App\Imprest', 'departmentId', 'id');
    }
}
