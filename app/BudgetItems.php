<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BudgetItems extends Model
{
    public function budget()
    {
        return $this->belongsTo('App\Budget');
    }

    public function item()
    {
        return $this->belongsTo('App\Budget', 'budget_id');
    }

    public function imprests()
    {
        return $this->hasMany('App\Imprests');
    }

    public function activities()
    {
        return $this->belongsTo('App\Activities');
    }

    public function projects(){
        return $this->hasOne('App\Projects', 'budget_id', 'budget_id');
    }

}
