<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StrategicDirections extends Model
{
   public function school()
   {
       return $this->belongsTo('App\School');
   }

   public function objective()
   {
       return $this->hasMany('App\Objectives');
   }
}
