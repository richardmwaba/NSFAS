<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{

    public function department(){
        return $this->belongsTo('App\Departments');
    }
    public function objectives() {
        return $this->belongsTo('App\Objectives');
    }

    public function strategic_directions(){
        return $this->belongsTo('App\StrategicDirections');
    }
    public function estimate(){
        return $this->hasOne('App\Estimates');
    }
    public function budgetItem(){
        return $this->hasOne('App\BudgetItems');
    }
}