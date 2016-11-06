<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imprest extends Model
{
    //
    public $fillable = ['applicantId', 'departmentId', 'amountRequested', 'budgetLine', 'purpose', 'authorisedByHead', 'authorisedByDean',
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

        return $this->hasOne('App\Expenditure', 'purpose', 'purpose');
    }

    public function budget()
    {

        return $this->hasOne('App\Budget', 'id', 'budgetLine');
    }
}
