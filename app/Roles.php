<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
//    public $primaryKey = 'id';


    public function rights(){
        return $this->belongsToMany('App\Rights', 'roles_rights');
    }

    public function user(){
        return $this->belongsToMany('App\Users','users_roles');
    }
}
