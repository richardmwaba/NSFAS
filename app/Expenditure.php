<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
    //
    public $fillable = ['amountPaid', 'beneficiary', 'account_id', 'purpose', 'voucherNumber'];
}
