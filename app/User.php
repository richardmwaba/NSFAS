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
        'accessLevelId','manNumber','firstName','lastName','otherName', 'email', 'password',
    ];

    public $incrementing = false;

    protected $primaryKey = 'manNumber';

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

    public function department(){
        return $this->belongsTo('App\Departments', 'departmentId', 'id');
    }

    public function access(){

        return $this->hasOne('App\AccessLevel');
    }

    public function imprests()
    {

        return $this->hasMany('App\Imprest', 'applicantId', 'manNumber');
    }

}
