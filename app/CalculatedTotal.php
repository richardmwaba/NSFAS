<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalculatedTotal extends Model
{
   public function projectTotals(){
       return $this->belongsTo('App\Projects');
   }
}
