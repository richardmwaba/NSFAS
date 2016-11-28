<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BudgetItems extends Model
{
<<<<<<< HEAD
    //
    public function item()
    {
        return $this->belongsTo('App\Budget', 'budget_id');
    }

    public function imprests()
    {

        return $this->hasMany('App\Imprests');
    }

    public function budget()
    {

        return $this->belongsTo('App\Budget', 'budget_id', 'id');
    }
=======
  public function budget(){
      return $this->belongsTo('App\Budget');
  }
>>>>>>> 09ca028c1b12c5b2f598c2f3ad5b91b05716ce05
}
