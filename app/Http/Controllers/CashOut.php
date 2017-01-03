<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Income;
use App\Expenditure;
use App\Imprest;
use App\Account;
use Illuminate\Support\Facades\Redirect;
use PDF;

class CashOut extends Controller
{
    //
    public function cashout(Request $request){

        $total = Income::where('accounts_id', $request->account)->sum('amountReceived');
        $totalEx = Expenditure::where('accounts_id', $request->account)->sum('amountPaid');
        $balance = $total - $totalEx;
        $account = Account::findOrfail($request->account);
        $imprest = Imprest::findOrfail($request->id);

        return view('Transactions.summary')->with(['balance'=>$balance, 'accountName'=>$account->accountName,
            'imprest'=>$imprest, 'request'=>$request]);

    }

    public function confirm(Request $request){

        Expenditure::create(['amountPaid'=>$request->amount, 'beneficiary'=>$request->beneficiary, 'purpose'=>$request->purpose, 'accounts_id'=>$request->account]);

        $imprest = Imprest::findOrFail($request->imprestId);

        //compute the imprest balance
        $imprest->imprestBalance = ($imprest->authorisedAmount-$request->amount);
        $imprest->save();

        session()->flash('flash_message', 'Your transaction has been saved');
        return Redirect::action('ImprestController@showAll');
    }

    public function getsummaryPdf(Request $request){


        $pdf = PDF::loadView('reports.imprestSummaryPDF', ['request'=>$request]);

        return $pdf->stream('reports.imprestSummaryPDF');


    }
}
