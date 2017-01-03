<?php

namespace App\Http\Controllers;

use App\Accounts;
use App\Budget;
use App\BudgetItems;
use App\CalculatedTotal;
use App\Departments;
use App\Income;
use App\Projects;
use App\Total;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

use Auth;
use Validator;
use Mail;

class AccountantController extends Controller
{
    protected  $message = " ";

    public function getAccountantSchool(){
        $account = Auth::user();
        $id = $account->schools_id;
        return $id;
    }

    public function viewAccounts(){
        $accounts = Accounts::all();
        return view('acc.viewAccounts')->with('accounts', $accounts);
    }

    public function Info(){
        $projects = Projects::all();
        return view('acc.projectInformation')->with('projects', $projects);
    }

    public function projectIncomes(){
        $projects = Projects::all();
        return view('acc.projectIncomes')->with('projects', $projects);
    }

    public function addProjectIncome($id){
        $projects = Projects::where('id', $id)->first();
        $account  = Accounts::where('projects_id', $projects->id)->first();
        $incomes = Income::where('accounts_id', $account->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('acc.projectIncomesAdd')
            ->with('projects', $projects)
            ->with('incomes', $incomes);
    }

    public function moreBudgetInfo($id){
        $projects = Projects::where('id', $id)->first();
        $budget  = Budget::where('projects_id', $projects->id)->first();
        $budget = BudgetItems::where('budget_id', $budget->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('acc.moreBudgetInfo')
            ->with('projects', $projects)
            ->with('budget', $budget);
    }
    public function moreIncomeInfo($id){
        $projects = Projects::where('id', $id)->first();
        $account  = Accounts::where('projects_id', $projects->id)->first();
        $incomes = Income::where('accounts_id', $account->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('acc.moreIncomeInfo')
            ->with('projects', $projects)
            ->with('incomes', $incomes);
    }

    public function addProjectIncomes(Request $request, $id){

        $account = Accounts::where('projects_id', $id)->first();
        $project = Projects::where('id', $id)->first();
        if(isset($project)){
            $income = new Income();
            $income->amountReceived = $request['amountReceived'];
            $income->giver = $request['receivedFrom'];
            $income->dateReceived = $request['dateReceived'];
            $income->receiptNumber = $request['receiptNumber'];
            $account->income()->save($income);
        }
        $this->projectTotalIncomeCalculator($id);

        //send an email to use after an income is added.
//        if (ImprestController::is_connected()) {
//            Mail::send('Mails.incomeAdded', ['project' => $project], function ($m) use ($staff) {
//
//                $m->to($staff->email, 'Me')->subject('Income add by the accountant');
//            });
//        }

        Session::flash('flash_message', 'Income added successfully');
        Return Redirect::action('AccountantController@addProjectIncome', $id);
    }

    public function projectTotalIncomeCalculator($projects_id){
        $project = Projects::where('id', $projects_id)->first();
        $account = Accounts::where('projects_id', $projects_id)->first();
        $totalAmountReceived = Income::where('accounts_id',$account->id)->sum('amountReceived');
        $record = CalculatedTotal::where('projects_id', $projects_id)->first();
        if (isset($record)){
            $record->incomeAcquired  = $totalAmountReceived;
            $project->totalAmount()->save($record);
        }else{
            $total = new CalculatedTotal();
            $total->incomeAcquired = $totalAmountReceived;
            $project->totalAmount()->save($total);
        }
    }

    public function projectTotalBudgetCalculator($id){
        $project = Projects::where('id', $id)->first();
        $budget = Budget::where('projects_id', $id)->first();
        $totalBudget= BudgetItems::where('budget_id', $budget->id)->sum('cost');
        $record = CalculatedTotal::where('projects_id', $id)->first();
        if (isset($record)){
            $record->proposedBudget = $totalBudget;
            $project->totalAmount()->save($record);
        }else{
            $total = new CalculatedTotal();
            $total->proposedBudget = $totalBudget;
            $project->totalAmount()->save($total);
        }
    }

    public function budgetIncomes(){
        return view('acc.budgetIncomes');
    }

    public  function approvalProjectBudget(){
        $projects = Projects::orderBy('created_at', 'desc')->get();
        return view('acc.approvalProjectBudget')->with('projects', $projects);
    }


}
