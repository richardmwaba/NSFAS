<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    public function project(){
        return $this->belongsTo('App\Projects');
    }
    public function budgetItems(){
        return $this->hasMany('App\BudgetItems');
    }

    public function departments(){
        return $this->hasOne('App\Departments');
    }
}
