<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Projects;

class Projects extends Model
{
    public function budget(){
        return $this->hasOne('App\Budget', 'id', 'budget_id');
    }

    public function accounts(){
        return $this->hasOne('App\Accounts');
    }

    public function expenditures(){
        return $this->hasMany('App\Expenditure');
    }

    public function departments(){
        return $this->belongsTo('App\Departments');
    }

    public function totalAmount(){
        return $this->hasOne('App\CalculatedTotal', 'projects_id', 'id');
    }

    public function budgetItem(){
        return $this->hasMany('App\Projects', 'budget_id', 'budget_id');
    }
}
