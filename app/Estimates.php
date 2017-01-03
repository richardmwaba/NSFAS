<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estimates extends Model
{
    public function activities() {
        return $this->belongsTo('App\Activities');
    }
}
