<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imprest extends Model
{
    //
    public $fillable = ['applicant_id', 'amount_requested', 'purpose'];
}
