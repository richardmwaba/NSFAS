<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
   public function accounts(){
       return $this->belongsTo('App\Accounts');
   }

   public  function projects(){
       return $this->belongsTo('App\Projects');
   }
}
