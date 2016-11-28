<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class imprestRetirement extends Model
{
    //
    public $table = 'imprestRetirements';
    public $fillable = ['chequeNo','deanOrHeadManNumber','deanOrHeadcomment', 'bursarManNumber','bursarComment', 'imprestId','date','dateOfReturn','departedFrom','departureDate','arrivedAt','noOfNoNights','ratePerNight',
        'subAmount','fuelAmount','item1','item1Amount','item2','item2Amount','item3','item3Amount','other','otherAmount','receiptNumber',
        'amountRecoverable','otherAmount','bursarApproval','dateOfBursarApproval','internalAuditApproval','dateOfInternalAuditApproval',
        'deanOrHeadApproval','dateOfDeanOrHeadApproval'];


    public function imprest(){

        return $this->belongsTo('App\Imprest', 'imprestId','imprestId');
    }

    public function owner(){

        return $this->belongsTo('App\User', 'manNumber','applicantId');
    }
}
