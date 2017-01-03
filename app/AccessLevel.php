<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessLevel extends Model
{
    public $primaryKey = 'level_id';

    public function user(){
        return $this->hasMany('App\Users');
    }
}
