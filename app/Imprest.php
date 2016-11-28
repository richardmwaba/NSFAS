<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imprest extends Model
{
    //
    public $fillable = ['applicantId', 'headManNumber', 'deanManNumber', 'bursarManNumber','departmentId', 'amountRequested', 'budgetLine', 'purpose', 'authorisedByHead', 'authorisedByDean',
        'dateOutstandingImprest', 'bursarRecommendation', 'authorisedAmount', 'commentFromDean', 'commentFromHead',
        'commentFromBursar', 'authorisedOn', 'seenByDean', 'cashAvailable'];
    protected $primaryKey = 'imprestId';

    public function owner()
    {

        return $this->belongsTo('App\User', 'applicantId', 'manNumber');
    }

    public function item()
    {

        return $this->hasOne('App\BudgetItems', 'id', 'purpose');
    }

    public function expenditure()
    {

        return $this->hasMany('App\Expenditure', 'purpose', 'purpose');
    }

    public function budget()
    {

        return $this->hasOne('App\Budget', 'id', 'budgetLine');
    }

    public function head(){

        return $this->hasOne('App\User','manNumber', 'headManNumber');
    }

    public function dean(){

        return $this->hasOne('App\User','manNumber', 'deanManNumber');
    }

    public function bursar(){

        return $this->hasOne('App\User','manNumber', 'bursarManNumber');
    }

    public function retirement(){

        return $this->hasOne('App\imprestRetirement','imprestId', 'imprestId');
    }
}
