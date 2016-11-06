<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class HodController extends Controller
{
    //
    public function imprestForm(){

        return view('imprests.imprests');
    }
}
