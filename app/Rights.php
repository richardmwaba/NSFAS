<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rights extends Model
{
    public function roles(){
        return $this->belongsToMany('App\Roles', 'roles_rights');
    }
}
