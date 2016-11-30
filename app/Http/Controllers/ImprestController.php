<?php

namespace App\Http\Controllers;

use App\Account;
use App\Expenditure;
use App\Income;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;
use App\Http\Requests;
use App\Imprest;
use App\Budget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Mail;
use Auth;

class ImprestController extends Controller
{

// Printing REports

    public function getImprestPdf(/*$id*/){
        // query to get Imprest
        // $imprests = User::with('imprest','budgets', 'accounts','actual')->groupBy('id');
        // $payment = $payment->findOrFail($id);

        $pdf = PDF::loadView('pdf.imprest' // ['imprests'=>$imprests]
        );
        return $pdf->stream('imprest.pdf');
    }

    public function getProjectPdf(/*$id*/){
        // query to get projects Data
        // $projects = User::with('imprest','budgets', 'accounts','actual')->groupBy('id');
        // $projects = $payment->findOrFail($id);

        $pdf = PDF::loadView('pdf.projects'// ['projects'=>$projects]
        );
        return $pdf->stream('projects.pdf');
    }

    public function getDepartmentIdFromLoggedInUSer()
    {
        $user = Auth::user();
        $id = $user->departments_id;
        return $id;
    }

    //form for creating a new imprest
    public function newForm()
    {
        //check if this user has no unretired imprest
        if ($this->hasActiveImprest()) {

            //this user has an active imprest
            session()->flash('flash_message', 'You still have an active imprest. Please have it retired and then try again');
            return Redirect::action('ImprestController@showAll');

            //else the user has no active imprests
        } else {
            $budgets = Budget::where('departments_id', $this->getDepartmentIdFromLoggedInUSer())->get();

            return view('imprests.new')->with('budgets', $budgets);
        }
    }


    //form for editing an in-progress imprest
    public function editForm($id)
    {

        $imprest = Imprest::findOrFail($id);

        //choose what to update based on current user
        $ac = Auth::user()->access_level_id;
        $actual = Expenditure::where('purpose', $imprest->purpose)->sum('amountPaid');
        $accounts = Account::all();

        switch ($ac) {
            case 'HD':
                $budgets = Budget::where('departments_id', Auth::user()->departments_id)->get();
                break;

            case 'OT':
                $budgets = Budget::where('departments_id', Auth::user()->departments_id)->get();
                break;

            default:
                $budgets = Budget::all();
                break;
        }
        //return the view
        return view('imprests.edit')->with(['imprest' => $imprest,
            'budgets' => $budgets,
            'accounts' => $accounts,
            'actual' => $actual]);
    }


    //create a new imprest
    public function create(Requests\newImprest $request)
    {
        //check if this user is the head or other
        if (Auth::user()->access_level_id == 'OT') {

            //create a new record
            Imprest::create(['applicantId' => Auth::user()->manNumber,
                'departmentId' => $request->department,
                'amountRequested' => $request->amountRequested,
                'purpose' => $request->purpose,
                'budgetLine' => $request->budgetLine]);

            //function to notify this user's head
            $this->notifyHead();

        } else {
            //check if the head has aproved the budget and save the state as well as the comment if any
            if ($request->authorisedByHead == 1) {

                //create a record
                Imprest::create(['headManNumber' => Auth::user()->manNumber,
                    'applicantId' => Auth::user()->manNumber,
                    'departmentId' => $request->department,
                    'authorisedByHead' => $request->authorisedByHead,
                    'commentFromHead' => $request->commentFromHead,
                    'amountRequested' => $request->amountRequested,
                    'purpose' => $request->purpose,
                    'budgetLine' => $request->budgetLine]);

                //method to notify the dean
                $this->notifyDean();

               

                //don't change the default authoriseState
            } else {

                //create a record
                Imprest::create(['applicantId' => Auth::user()->manNumber,
                    'departments_id' => $request->department,
                    'commentFromHead' => $request->commentFromHead,
                    'amountRequested' => $request->amountRequested,
                    'purpose' => $request->purpose,
                    'budgetLine' => $request->budgetLine]);

            }

        }

        return Redirect::action('ImprestController@showAll');

    }

    //this function checks if the current user has no active imprests before th
    //ey can create another one. Returns true if they do
    public function hasActiveImprest()
    {

        //logic to check if user has un retired imprests
        $imprests = Imprest::where('applicantId', Auth::user()->manNumber)->where('isRetired', 0)->get();

        if ($imprests->isEmpty()) {

            return false;

        } else {

            return true;
        }

        //return false;

    }

    public function notifyHead()
    {
        $imprests = Auth::user()->imprests;

        //loop through the eloquent results until the newly created imprest
        // is found using the isRetired attribute
        foreach ($imprests as $imprest) {

            if ($imprest->isRetired == 0) {

                //when found, look for this user's head and send him/her a mail
                if ($this->is_connected()) {
                    $head = User::where('access_level_id', 'HD')
                        ->where('departments_id', Auth::user()->departments_id)
                        ->first();

                    Mail::send('Mails.newImprest', ['imprest' => $imprest], function ($m) use ($head) {

                        $m->to($head->email, 'Me')->subject('Imprest authorisation required');
                    });
                }

                break;

            }


        }

    }

    public function notifyDean()
    {
        $imprests = Auth::user()->imprests;

        //loop through the eloquent results until the newly created imprest is found using the isRetired attribute
        foreach ($imprests as $imprest) {

            if ($imprest->isRetired == 0 and $imprest->authorisedByHead == 1) {

                //when found, look for this user's head and send him/her a mail
                if ($this->is_connected()) {
                    $dean = User::where('access_level_id', 'DN')->first();

                    Mail::send('Mails.newImprest', ['imprest' => $imprest], function ($m) use ($dean) {

                        $m->to($dean->email, 'Me')->subject('Imprest authorisation required');
                    });
                }

                break;

            }


        }

    }

    //public function sendMail($model, $user, $emailHeading,){


    public function update(Request $request)
    {

        $imprest = Imprest::findOrFail($request->id);

        $ac = Auth::user()->access_level_id;

        //choose what to update based on current user
        switch ($ac) {

            case 'HD':
                //validate
                $this->validate($request, ['approvedByHead' => 'required']);

                //update the records
                $imprest->fill(['commentFromHead' => $request->commentFromHead,
                    'authorisedByHead' => $request->approvedByHead,
                    'headManNumber' => Auth::user()->manNumber,
                    'authorisedByHeadOn' => Carbon::now()]);
                $imprest->save();

                //method to notify the dean if imprest has been aproved
                if ($request->authorisedByHead == 1) {
                    $this->notifyDean();
                }
                break;

            case 'OT':
                //perform validation
                $this->validate($request,
                    [
                        'amountRequested' => 'required|numeric',
                        'purpose' => 'required',
                        'budgetLine' => 'required',
                    ]);

                //fill the fields in the database
                $imprest->fill(['amountRequested' => $request->amountRequested,
                    'purpose' => $request->purpose,
                    'budgetLine' => $request->budgetLine]);
                $imprest->save();
                break;

            case 'AC':

                //perfom validation
                $this->validate($request, ['bursarRecommendation' => 'required']);

                //function to process updates from the accountants
                $this->accounts($imprest, $request);
                break;

            //code to process what happens when the dean modifys an imprest
            case 'DN':

                //perfom validation
                $this->validate($request, ['authorisedByDean' => 'required']);

                //fill in these fields first
                $imprest->fill(['authorisedAmount' => $request->authorisedAmount,
                    'deanManNumber' => Auth::user()->manNumber,
                    'authorisedByDean' => $request->authorisedByDean,
                    'authorisedByDeanOn' => Carbon::now(),
                    'commentFromDean' => $request->commentFromDean]);
                $imprest->save();


                //set authorised on date if the dean has authorised this imprest and notify the accountants
                if ($request->authorisedByDean == 1) {

                    //send mail to accountants
                    If ($this->is_connected()) {
                        $user = User::where('access_level_id', 'AC')->get();
                        foreach ($user as $user) {
                            Mail::send('Mails.authorised', ['imprest' => $imprest], function ($m) use ($user) {

                                $m->to($user->email, 'Me')->subject('Imprest has been authorised');
                            });
                        }

                        //notify the applicant if cash is ready
                        if ($imprest->cashAvailable == 1) {
                            Mail::send('Mails.ready', ['imprest' => $imprest], function ($m) use ($imprest) {

                                $m->to($imprest->owner->email, 'Me')->subject('Money ready for collection');
                            });

                        }
                    }
                }

                break;

        }

        session()->flash('flash_message', 'saved!');

        return Redirect::action('ImprestController@showAll');

    }


    //processs updates from accountsants
    public function accounts($imprest, $request)
    {

        if ($request->bursarRecommendation == 1 and
            $request->authorisedByDean == 1 and
            $imprest->cashAvailable == 1
        ) {

            //save the cash ready state
            $imprest->cashAvailable = 1;
            $imprest->bursarRecommendation = $request->bursarRecommendation;
            $imprest->bursarRecommendationDate = Carbon::now();
            $imprest->bursarManNumber = Auth::user()->manNumber;
            $imprest->save();

            //notify the applicant
            if ($this->is_connected()) {
                $user = $imprest->owner;
                Mail::send('Mails.recommendation', ['imprest' => $imprest], function ($m) use ($user) {

                    $m->to($user->email, 'Me')->subject('Imprest recommendation required');
                });
            }

        } elseif ($request->bursarRecommendation == 1) {

            //save the comment, and the bursar recommendation state
            $imprest->fill(['cashAvailable' => $request->cashAvailable,
                'bursarRecommendation' => $request->bursarRecommendation,
                'commentFromBursar' => $request->commentFromBursar,
                $imprest->bursarManNumber = Auth::user()->manNumber]);
            $imprest->save();

            //send mail to the dean about update
            if ($this->is_connected()) {
                $user = User::where('access_level_id', 'DN')->first();
                Mail::send('Mails.recommended', ['imprest' => $imprest], function ($m) use ($user) {

                    $m->to($user->email, 'Me')->subject('The bursar has recommended this imprest');
                });
            }
        }


    }


//function to show all the that have been seen by dean
    public function showAll()
    {
        //get all imprests that belong to this user
        if (Auth::user()->access_level_id == 'OT') {
            $imprests = Imprest::where('applicantId', Auth::user()->manNumber)->orderBy('created_at', 'desc')->get();

            //get all imprests that belong to current user department
        } elseif (Auth::user()->access_level_id == 'HD') {
            $imprests = Auth::user()->department->imprests;

            //get all imprests that have been seen and sent to accountant for recommendation
        } elseif (Auth::user()->access_level_id == 'AC') {
            $imprests = Imprest::where('seenByDean', 1)->orderBy('created_at', 'desc')->get();

            //get all imprests that have been authorised by head for the dean to see
        } else {
            $imprests = Imprest::where('authorisedByHead', 1)->orderBy('created_at', 'desc')->get();

        }

        if ($imprests != null) {
            return view('imprests.all')->with(['imprests' => $imprests]);
        } else {
            return view('imprests.create');
        }
    }


    //method to change the budget line when the accountant changes on the form
    public function newBudgetLine(Request $request)
    {

        $this->validate($request, ['newBudgetLine' => 'required']);
        $imprest = Imprest::findOrFail($request->id);
        $imprest->budgetLine = $request->newBudgetLine;
        $imprest->save();

        session()->flash('flash_message', 'The new budget line has been saved');

        return Redirect::action('ImprestController@editForm', [$imprest->imprestId]);


    }

    public function recommendation(Request $request)
    {

        //send the from to bursar fro recommendation and set a state that will tell that
        // this imprest is now waiting for recommendation from the bursar
        $imprest = Imprest::findOrFAil($request->id);
        $imprest->seenByDean = 1;
        $imprest->commentFromDean = $request->commentFromDean;
        $imprest->save();

        $user = User::where('access_level_id', 'AC')->get();

        if ($this->is_connected()) {
            foreach ($user as $user) {

                Mail::send('Mails.recommended', ['imprest' => $imprest], function ($m) use ($user) {

                    $m->to($user->email, 'Me')->subject('Imprest has been recommended');
                });

            }
        }

        session()->flash('flash_message', 'sent!');

        return Redirect::action('ImprestController@showAll');
    }

    public static function is_connected()
    {
        $connected = @fsockopen("www.gmail.com", 80);
        //website, port  (try 80 or 443)
        if ($connected) {
            $is_conn = true; //action when connected
            fclose($connected);
        } else {
            $is_conn = false; //action in connection failure
        }
        return $is_conn;

    }


}
