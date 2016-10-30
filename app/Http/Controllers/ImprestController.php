<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Imprest;
use Illuminate\Support\Facades\Auth;

class ImprestController extends Controller
{

    //
    public function imprestForm(){

        $imprests = Imprest::all();
        return view('imprest.imprest')->with('imprests', $imprests);
    }



        public function update(Request $request){

        Imprest::create(['applicant_id' => Auth::user()->manNumber, 'amount_requested'=>$request->amount, 'purpose'=>$request->purpose]);
        //$imprest->create(['applicant_id' => $request->manNumber, 'amount_requested'=>$request->amount, 'purpose'=>$request->amount]);
        //$imprest->save();

            return $request;
    }
}
