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
use Validator;

class ImprestRetirementController extends Controller
{

    //choose what form to display. Edit or new retirement
    function  newOrEditForm($id){
        //if();
    }


    //display the imprest retirement form
    function retirementForm($id)
    {

        $imprest = Imprest::findOrFail($id);
        $access_level_id = Auth::user()->access_level_id;

        //choose page to render based on current user access
        if ($access_level_id == 'HD' or $access_level_id == 'OT') {

            return view('imprests.Retirement.retirementForm')
                ->with(['imprest' => $imprest, 'id' => $id]);
        } else {

            //retrieve an incomplete retirement process that belongs to this user
            $retirement = imprestRetirement::where('imprestId', $id)->where('deanOrHeadApproval', null)->orWhere('deanOrHeadApproval', 'rejected')->first();

            //if the $retirement is null. return to previous page with a flash message else return the desired page
            if ($retirement == []) {

                session()->flash('flash_message', 'Sorry! The owner of this imprest has not started the retirement process yet.');
                return Redirect::action('ImprestController@showAll');

            } else {
                $total = $retirement->item1Amount +
                    $retirement->item2Amount +
                    $retirement->item3Amount +
                    $retirement->otherAmount +
                    $retirement->subAmount;

                return view('imprests.Retirement.edit')->with(['imprest' => $imprest, 'total' => $total, 'retirement' => $retirement]);
            }
        }
    }


    //returns a confirmation page before saving the retirement
    public function confirm(Request $request)
    {

        $v = Validator::make($request->all(), [
            'chequeNumber' => 'required',
            'item1' => 'required',
        ]);

        //conditionally validate the amount fields
        $v->sometimes('departureDate', 'required', function ($input) {
            return $input->dateOfReturn != null;
        });
        $v->sometimes('arrivedAt', 'required', function ($input) {
            return $input->dateOfReturn != null;
        });
        $v->sometimes('departedFrom', 'required', function ($input) {
            return $input->dateOfReturn != null;
        });
        $v->sometimes('noOfNights', 'required', function ($input) {
            return $input->dateOfReturn != null;
        });
        $v->sometimes('ratePerNight', 'required', function ($input) {
            return $input->dateOfReturn != null;
        });
        $v->sometimes('subAmount', 'required', function ($input) {
            return $input->dateOfReturn != null;
        });
        $v->sometimes('item1Amount', 'required', function ($input) {
            return $input->item1 != null;
        });
        $v->sometimes('item2Amount', 'required', function ($input) {
            return $input->item2 != null;
        });
        $v->sometimes('item3Amount', 'required', function ($input) {
            return $input->item3 != null;
        });
        $v->sometimes('otherAmount', 'required', function ($input) {
            return $input->other != null;
        });
        $v->sometimes('departedFrom', 'required', function ($input) {
            return $input->subAmount != null;
        });
        $v->sometimes('cashBalanceDate', 'required', function ($input) {
            return $input->receiptNo != null;
        });
        $v->sometimes('cashBalanceAmount', 'required', function ($input) {
            return $input->receiptNo != null;
        });
        $v->sometimes('recoverableAmount', 'required', function ($input) {
            return $input->receiptNo != null;
        });

        if ($v->fails()) {
            return redirect('/imprests/retirement/form/' . $request->imprestId)
                ->withErrors($v)
                ->withInput();
        } else {

            $imprest = Imprest::findOrFail($request->imprestId);
            $total = $request->item1Amount +
                $request->item2Amount +
                $request->item3Amount +
                $request->otherAmount +
                $request->subAmount;
            return view('imprests.Retirement.confirm')->with(['retirement' => $request, 'imprest' => $imprest, 'total' => $total]);
        }

    }


    //save a new retirement record
    function create(Request $request)
    {


        imprestRetirement::create(['chequeNo' => $request->chequeNo,
            'imprestId' => $request->imprestId,
            'date' => Carbon::now(),
            'dateOfReturn' => $request->dateOfReturn,
            'departedFrom' => $request->departedFrom,
            'departureDate' => $request->departureDate,
            'arrivedAt' => $request->arrivedAt,
            'noOfNoNights' => $request->noOfNights,
            'ratePerNight' => $request->ratePerNight,
            'subAmount' => $request->subAmount,
            'fuelAmount' => $request->fuelAmount,
            'item1' => $request->item1,
            'item1Amount' => $request->item1Amount,
            'item2' => $request->item2,
            'item2Amount' => $request->item2Amount,
            'item3' => $request->item3,
            'item3Amount' => $request->item3Amount,
            'other' => $request->other,
            'otherAmount' => $request->otherAmount,
            'receiptNumber' => $request->receiptNo,
            'amountRecoverable' => $request->recoverableAmount]);

        //notify the head or the dean
        /*if(Auth::user()->access_level_id=='HD')
        if (ImprestController::is_connected()) {
            Mail::send('Mails.addUser', ['imprest' => $imprest], function ($m) use ($user) {

                $m->to($user->email, 'Me')->subject('Your account has been created');
            });
        } */

        session()->flash('flash_message', 'Saved!');
        return Redirect::action('ImprestController@showAll');
    }


    //process changes to the retirement process
    public function edit(Request $request, $id)
    {

        $retirement = imprestRetirement::findOrFail($id);
        $imprest = Imprest::where('imprestId', $retirement->imprestId)->get();

        //choose what to save based on current user access level
        $access_level_id = Auth::user()->access_level_id;
        switch ($access_level_id) {
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
                if (ImprestController::isConnected()) {
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
