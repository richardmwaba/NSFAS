<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estimates extends Model
{
    public function activity()
    {
        return $this->belongsTo('App\Activities');
    }
}
