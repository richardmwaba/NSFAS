<?php

namespace App\Http\Controllers;

use App\Imprest;
use Illuminate\Http\Request;

use App\Http\Requests;

class ImprestRetirementController extends Controller
{
    //display the imprest retirement form
    function retirementForm($id){

        $imprest = Imprest::findOrFail($id);

        return view('imprests.Retirement.retirementForm')->with('imprest',$imprest);
    }
}
