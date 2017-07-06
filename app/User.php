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
        'access_level_id', 'schools_id', 'departments_id','manNumber','firstName','lastName','otherName', 'email', 'password',
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
        return $this->belongsTo('App\AccessLevel', 'access_level_id', 'access_level_id');
    }

    public function role(){
        return $this->belongsToMany('App\Role','users_roles');
    }

    public function department(){
        return $this->belongsTo('App\Departments', 'departments_id', 'id');
    }

    public function access(){
        return $this->hasOne('App\AccessLevel');
    }

    public function imprests() {
        return $this->hasMany('App\Imprest', 'applicantId', 'manNumber');
    }

    public function accounts(){
        return $this->hasMany('App\Account');
    }

    public function school(){
        return $this->belongsTo('App\School','schools_id');
    }
}
