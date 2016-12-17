<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    public function objectives() {
        return $this->belongsTo('App\Objectives');
    }

    public function estimates(){
        return $this->hasOne('App\Estimates');
    }
    public function budgetItem(){
        return $this->hasOne('App\BudgetItems');
    }
}