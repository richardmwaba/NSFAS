<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
   public function accounts(){
       return $this->belongsTo('App\Accounts');
   }
}
