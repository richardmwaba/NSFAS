<?php

namespace App\Http\Controllers;

use App\Imprest;
use App\imprestRetirement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\ImprestController;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ImprestRetirementController extends Controller
{
    //display the imprest retirement form
    function retirementForm($id){

        $imprest = Imprest::findOrFail($id);
        $accessLevelId = Auth::user()->accessLevelId;

        //choose page to render based on current user access
        if($accessLevelId=='HD' or $accessLevelId=='OT') {

            return view('imprests.Retirement.retirementForm')
                   ->with('imprest', $imprest);
        }else{

            //retrieve an incomplete retirement process that belongs to this user
            $retirement = imprestRetirement::where('imprestId', $id)->where('deanOrHeadApproval',null)->orWhere('deanOrHeadApproval','rejected')->first();
            $total =      $retirement->item1Amount +
                          $retirement->item2Amount +
                          $retirement->item3Amount +
                          $retirement->otherAmount +
                          $retirement->subAmount;

            return view('imprests.Retirement.edit')->with(['imprest'=> $imprest, 'total'=>$total, 'retirement'=>$retirement]);
        }
    }


    //save a new retirement record
    function create(Request $request){



        imprestRetirement::create( ['chequeNo' => $request->chequeNo,'imprestId'=>$request->imprestId,'date'=>Carbon::now(),
            'dateOfReturn'=>$request->dateOfReturn,'departedFrom'=>$request->departedFrom,'departureDate'=>$request->departureDate,
            'arrivedAt'=>$request->arrivedAt,'noOfNoNights'=>$request->noOfNights,'ratePerNight'=>$request->ratePerNight,
            'subAmount'=>$request->subAmount,'fuelAmount'=>$request->fuelAmount,'item1'=>$request->item1,
            'item1Amount'=>$request->item1Amount,'item2'=>$request->item2,'item2Amount'=>$request->item2Amount,
            'item3'=>$request->item3,'item3Amount'=>$request->item3Amount,'other'=>$request->other,
            'otherAmount'=>$request->otherAmount,'receiptNumber'=>$request->receiptNo,
            'amountRecoverable'=>$request->recoverableAmount]);

        return Redirect::action('ImprestController@showAll');
    }


    //process changes to the retirement process
    public function edit(Request $request, $id){

        $retirement = imprestRetirement::findOrFail($id);
        $imprest = Imprest::where('imprestId', $retirement->imprestId)-get();

        //choose what to save based on current user access level
        $accessLevelId = Auth::user()->accessLevelId;
        switch ($accessLevelId){
            case 'HD':
                $retirement->deanOrHeadApproval = $request->approval;
                $retirement->dateOfDeanOrHeadApproval = Carbon::now();
                $retirement->deanOrHeadcomment = $request->comment;
                $retirement->deanOrHeadManNumber = Auth::user()->manNumber;
                $retirement->save();
                break;

            case 'AC':
                $retirement->bursarApproval = $request->approval;
                $retirement->dateOfBursarApproval = Carbon::now();
                $retirement->bursarComment = $request->comment;
                $retirement->bursarManNumber = Auth::user()->manNumber;
                $retirement->save();

                //notify head or dean
                break;

            case 'DN':
                $retirement->deanOrHeadApproval = $request->approval;
                $retirement->dateOfDeanOrHeadApproval = Carbon::now();
                $retirement->deanOrHeadcomment = $request->comment;
                $retirement->deanOrHeadManNumber = Auth::user()->manNumber;
                $retirement->save();

                //set the imprest as retired
                $imprest->isRetired = 1;
                $imprest->save();

                //notify the user
                if(ImprestController::isConnected()) {
                    Mail::send('Mails.retired', ['imprest' => $imprest], function ($m) use ($imprest) {
                        $m->to($imprest->owner->email, 'Me')->subject('Your imprest has been retired');
                    });
                }

                break;

            default:
                session()->flash('flash_message', 'Invalid operation');
                return Redirect::action('ImprestController@showAll');
                break;
        }

        session()->flash('flash_message', 'Saved!');
        return Redirect::action('ImprestController@showAll');
    }


}
