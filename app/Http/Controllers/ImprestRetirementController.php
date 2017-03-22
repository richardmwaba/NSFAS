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
use Mail;

class ImprestRetirementController extends Controller
{

    //choose what form to display. Edit or new retirement
    function newOrEditForm($id)
    {
        //if();
    }


    //display the imprest retirement form
    function retirement($id)
    {
        //
        $imprest = Imprest::findOrFail($id);
        $access_level_id = Auth::user()->access_level_id;

        //choose page to render based on current user access
        if ($access_level_id == 'OT') {

            return $this->otherUser($imprest, $id);

            //if this user is the head
        } else if ($access_level_id == 'HD') {
            return $this->head($imprest, $id);

            //user is either the dean or bursar or higher
        } else {

            return $this->bursarOrDean($id, $imprest);

        }
    }

    public function otherUser($imprest, $id)
    {
        //show new retirement form
        if ($this->userHasStartedRetirementProcess($imprest)) {
            return $this->showHeadOrOtherEditForm($id, $imprest);

        } else {
            return $this->showNewRetirementForm($id, $imprest);
        }
    }

    public function bursarOrDean($id, $imprest)
    {

        //retrieve an incomplete retirement process for this imprest if it exists
        $retirement = imprestRetirement::where('imprestId', $id)->first();

        //if the $retirement is null. return to previous page with a flash message else return the desired page
        if ($retirement == []) {
            //owner has not started retirement process yet
            return $this->noRetirementYet();

        } else {
            //return th imprest retiremnt edit form
            return $this->editForm($retirement, $imprest);

        }

    }

    public function head($imprest, $id)
    {

        //check if this imprest has an ongoing retirement process or not
        if ($imprest->retirement == null) {

            //was this imprest created by the head?
            //If not, show flash message that he can not create a retirement for it
            if ($imprest->owner != Auth::user()) {

                //owner has not started retirement process yet
                return $this->noRetirementYet();

            } else {
                //show new retirement form
                return $this->showNewRetirementForm($id, $imprest);
            }

        } else {

            if ($imprest->owner != Auth::user()) {

                //show retirement form for editing
                return $this->editForm($imprest->retirement, $imprest);

            } else {
                //show edit for head retirement form
                return $this->showHeadOrOtherEditForm($id, $imprest);
            }
        }

    }


    public function showNewRetirementForm($id, $imprest)
    {

        return view('imprests.Retirement.retirementForm')
            ->with(['imprest' => $imprest, 'id' => $id]);

    }

    public function showHeadOrOtherEditForm($id, $imprest)
    {
        return view('imprests.Retirement.headOrOtherEditForm')->with(['retirement' => $imprest->retirement, 'id' => $id]);
    }

    //
    public function editForm($retirement, $imprest)
    {

        //compute the total cost imprest retirement items
        $total = $retirement->item1Amount +
            $retirement->item2Amount +
            $retirement->item3Amount +
            $retirement->otherAmount +
            $retirement->subAmount;

        return view('imprests.Retirement.edit')
            ->with(['imprest' => $imprest, 'total'
            => $total, 'retirement'
            => $retirement]);

    }

    //method to handle what happens when a user tries to acces a retirement that has not been stated
    public function noRetirementYet()
    {

        session()->flash('flash_message', 'Sorry! The owner of this imprest has not started the retirement process yet.');
        Session::flash('alert-class', 'alert-danger');
        return Redirect::action('ImprestController@showAll');
    }

    public function userHasStartedRetirementProcess($imprest)
    {
        if ($imprest->retirement == null) {
            return false;
        } else {
            return true;
        }
    }


    //returns a confirmation page before saving the retirement
    public function confirm(Request $request)
    {

        $v = Validator::make($request->all(), [
            'chequeNumber' => 'sometimes',
            'item1' => 'required',
        ]);

        //conditionally validate the amount fields
        $v->sometimes('departureDate', 'required', function ($input) {
            return $input->dateOfReturn != null;
        });
        $v->sometimes('arrivedAt', 'required', function ($input) {
            return $input->dateOfReturn != null;
        });
        $v->sometimes('departureDate', 'required', function ($input) {
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
            return view('imprests.Retirement.confirm')
                ->with(['retirement'
                => $request, 'imprest'
                => $imprest, 'total'
                => $total]);
        }

    }


    //save a new retirement record
    function create(Request $request)
    {


        $imprestRetirement = imprestRetirement::firstOrNew(['imprestId' => $request->imprestId]);
        $imprestRetirement->chequeNo = $request->chequeNo;
        $imprestRetirement->date = Carbon::now();
        $imprestRetirement->dateOfReturn = $request->dateOfReturn;
        $imprestRetirement->departedFrom = $request->departedFrom;
        $imprestRetirement->departureDate = $request->departureDate;
        $imprestRetirement->arrivedAt = $request->arrivedAt;
        $imprestRetirement->noOfNoNights = $request->noOfNights;
        $imprestRetirement->ratePerNight = $request->ratePerNight;
        $imprestRetirement->subAmount = $request->subAmount;
        $imprestRetirement->fuelAmount = $request->fuelAmount;
        $imprestRetirement->item1 = $request->item1;
        $imprestRetirement->item1Amount = $request->item1Amount;
        $imprestRetirement->item2 = $request->item2;
        $imprestRetirement->item2Amount = $request->item2Amount;
        $imprestRetirement->item3 = $request->item3;
        $imprestRetirement->item3Amount = $request->item3Amount;
        $imprestRetirement->other = $request->other;
        $imprestRetirement->otherAmount = $request->otherAmount;
        $imprestRetirement->receiptNumber = $request->receiptNo;
        $imprestRetirement->amountRecoverable = $request->recoverableAmount;
        $imprestRetirement->save();

        //notify the head or the dean
        /*if(Auth::user()->access_level_id=='HD')
        if (ImprestController::is_connected()) {
            Mail::send('Mails.addUser', ['imprest' => $imprest], function ($m) use ($user) {

                $m->to($user->email, 'Me')->subject('Your account has been created');
            });
        } */

        session()->flash('flash_message', 'Saved!');
        Session::flash('alert-class', 'alert-success');
        return Redirect::action('ImprestController@showAll');
    }


    //process changes to the retirement process
    public function edit(Request $request, $id)
    {

        $retirement = imprestRetirement::findOrFail($id);
        $imprest = Imprest::where('imprestId', $retirement->imprestId)->first();

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

                //set the imprest as retired
                if ($request->approval == 1) {
                    $imprest->isRetired = 1;
                    $imprest->save();
                    $message = 'Your imprest has now been retired.';

                    //notify the owner
                    if (ImprestController::is_connected()) {
                        Mail::send('Mails.retired', ['imprest' => $imprest, 'message' => $message], function ($m) use ($imprest) {
                            $m->to($imprest->owner->email, 'Me')->subject('Your imprest has been retired');
                        });
                    }
                }else {

                    //notify the user
                    $message = 'Your imprest retirement has been rejected.';
                    if (ImprestController::is_connected()) {
                        Mail::send('Mails.retired', ['imprest' => $imprest, 'message' => $message], function ($m) use ($imprest) {
                            $m->to($imprest->owner->email, 'Me')->subject('Imprest retirement has been rejected');
                        });
                    }
                }

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
                Session::flash('alert-class', 'alert-danger');
                return Redirect::action('ImprestController@showAll');
                break;
        }

        session()->flash('flash_message', 'Saved!');
        Session::flash('alert-class', 'alert-success');
        return Redirect::action('ImprestController@showAll');
    }


}
