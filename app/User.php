<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    public $primaryKey = 'manNumber';
    protected $fillable = [
        'access_level_id','manNumber','firstName','lastName','otherName', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function access_level(){
        return $this->belongsTo('App\AccessLevel');
    }

    public function role(){
        return $this->belongsToMany('App\Role','users_roles');
    }


    public function department(){
        return $this->belongsTo('App\Departments');
    }
}
