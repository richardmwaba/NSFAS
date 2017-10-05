<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    public function project(){
        return $this->belongsTo('App\Projects', 'budget_id', 'id');
    }
    public function budgetItems(){
        return $this->hasMany('App\BudgetItems');
    }

    public function departments(){
        return $this->belongsTo('App\Departments');
    }
    public function department(){
        return $this->belongsTo('App\Departments', 'depertmentID');
    }

    public function accounts(){
        return $this->belongsTo('App\Accounts');
    }

    public function items(){
        return $this->hasMany('App\BudgetItems', 'budget_id');
    }

}
