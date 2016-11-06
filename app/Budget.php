<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    //
    public function department()
    {
        return $this->belongsTo('App\Departments', 'depertmentID');
    }

    public function items()
    {

        return $this->hasMany('App\BudgetItems', 'budget_id');
    }
}
