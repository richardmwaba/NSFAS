<?php

namespace App\Http\Controllers;

use App\Accounts;
use App\Budget;
use App\BudgetItems;
use App\CalculatedTotal;
use App\Departments;
use App\Expenditure;
use App\Income;
use App\Projects;
use App\School;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

use Auth;
use Validator;
use Mail;
use PDF;

class AccountantController extends Controller
{
    protected  $message = " ";
    protected $totalBudget = 0;
    protected   $departmentNumber = 0;

    public function getAccountantSchool(){
        $account = Auth::user();
        $id = $account->schools_id;
        return $id;
    }

    public function viewSchoolAccountsPDF(){
        $accounts = Accounts::all();
        $this->accountTotalIncomeCalculator($accounts);
        $this->accountTotalExpenditureCalculator($accounts);

        $id = $this->getAccountantSchool();
        $record = School::find($id);
        $schoolName = $record->schoolName;

        $pdf = PDF::loadView('reports.viewSchoolAccountsPDF',
            ['accounts'=>$accounts, 'schoolName' => $schoolName]);

        return $pdf->stream('reports.viewSchoolAccountsPDF');
    }

    public function viewAccounts(){
        $accounts = Accounts::all();
        $this->accountTotalIncomeCalculator($accounts);
        $this->accountTotalExpenditureCalculator($accounts);
        return view('acc.viewAccounts')->with('accounts', $accounts);
    }

    public function accountTotalExpenditureCalculator($accounts){
        foreach ($accounts as $record){
            $totalExpenditure = Expenditure::where('accounts_id', $record->id)->sum('amountPaid');
            $row = CalculatedTotal::where('accounts_id', $record->id)->first();
            $account_record = Accounts::where('id', $record->id)->first();
            if(isset($row)){
                $row->expenditureAcquired = $totalExpenditure;
                $row->accounts()->associate($account_record);
                $row->save();
            }else{
                $entry = new CalculatedTotal();
                $entry->expenditureAcquired  = $totalExpenditure;
                $entry->accounts()->associate($account_record);
                $entry->save();
            }
        }
    }

    public function accountTotalIncomeCalculator($accounts){
        foreach ( $accounts as $record){
            $totalIncome = Income::where('accounts_id', $record->id)->sum('amountReceived');
            $row = CalculatedTotal::where('accounts_id', $record->id)->first();
            $account = Accounts::where('id', $record->id)->first();

            if (isset($row)) {
                $row->incomeAcquired = $totalIncome;
                $row->accounts()->associate($account);
                $row->save();
            }else{
                $total = new CalculatedTotal();
                $total->incomeAcquired = $totalIncome;
                $total->accounts()->associate($account);
                $total->save();
            }
        }
    }

    public function addAccountIncome(){
        $records = Accounts::where('school_id', $this->getAccountantSchool())
            ->orderBy('created_at', 'desc')
            ->get();

        $this->accountTotalIncomeCalculator($records);
        if ($records){
            return view('acc.addAccountIncome')
                ->with('records' , $records);
        }

        return view('acc.addAccountIncome');
    }

    public function saveAccountIncome(Request $request, $id){

        global $message;
        global $departmentNumber;

        //validate
        $this->validate($request, [
            'amountReceived' => 'required|max:255',
            'receivedFrom' => 'required|max:255',
            'receiptNumber' => 'required|max:255',
            'dateReceived' => 'required|max:255'
        ]);

        $account = Accounts::where('id', $id)->first();
        $school = School::where('id', $this->getAccountantSchool())->first();
        $departments = Departments::where('schools_id', $this->getAccountantSchool())->count();
        $records = Departments::where('schools_id', $this->getAccountantSchool())->get();
        foreach ($records as $record){
            $info = Budget::where('budgetName', 'The department of '.$record->departmentName. " Budget" )
                ->where('departments_id', $record->id)
                ->first();

            if (isset($info)){
                $departmentNumber += 1;
            }
        }

        if ($departments == $departmentNumber){

            if ($account->accountName == 'The school of '.$school->schoolName .' main account'){

                $income = new Income();
                $income->amountReceived = $request['amountReceived'];
                $income->giver = $request['receivedFrom'];
                $income->receiptNumber = $request['receiptNumber'];
                $income->dateReceived = $request['dateReceived'];
                $income->accounts()->associate($account);
                $income->save();


                $departmentIncome = $request['amountReceived'] / $departments;
                $departments_all = Departments::where('schools_id', $this->getAccountantSchool())->get();
                foreach ($departments_all as $department){

                    $budget = Budget::where('departments_id', $department->id)->first();
                    $account = Accounts::where('id',$budget->accounts_id)->first();
                    $budget->departmentIncome = $departmentIncome;
                    $budget->schoolIncome =  $request['amountReceived'];
                    $budget->accounts()->associate($account);
                    $budget->save();

                    $incomes = new Income();
                    $incomes->amountReceived = $departmentIncome;
                    $incomes->giver = 'The school of '.$school->schoolName .' main account';
                    $incomes->receiptNumber = $request['receiptNumber'];
                    $incomes->dateReceived = $request['dateReceived'];
                    $incomes->accounts()->associate($account);
                    $incomes->save();
                }
                $message="income added successfully";

            }else{

                $income = new Income();
                $income->amountReceived = $request['amountReceived'];
                $income->giver = $request['receivedFrom'];
                $income->receiptNumber = $request['receiptNumber'];
                $income->dateReceived = $request['dateReceived'];
                $income->accounts()->associate($account);
                $income->save();

                $message="income added successfully";
            }

        }else{
            $message = "Error occurred! Please make sure that you create Departments and units accounts before adding incomes to 
                the school's main account!";
        }

        Session::flash('flash_message', $message);
        Return Redirect::action('AccountantController@addAccountIncome');
    }

    public function addAccIncome($id){

        global $totalBudget;

        $account = Accounts::where('id', $id)->first();
        $records = Accounts::where('school_id', $this->getAccountantSchool())
            ->orderBy('created_at', 'desc')
            ->get();
        $this->accountTotalIncomeCalculator($records);

        return view('acc.addAccIncome')
            ->with('totalBudget' , $totalBudget)
            ->with('account', $account)
            ->with('records', $records);
    }

    public function addDepartmentAccount($id = null){

        $departments = Departments::where('schools_id', $this->getAccountantSchool())->get();
        $records = Accounts::where('school_id', $this->getAccountantSchool())
            ->orderBy('created_at', 'desc')
            ->get();

        $this->accountTotalIncomeCalculator($records);

        if ($records){
            return view('acc.addDepartmentAccount')
                ->with('departments',$departments)
                ->with('records' , $records);
        }
        return view('acc.addDepartmentAccount')->with('departments',$departments);
    }

    public function saveAddedDepartmentAccount(Request $request){

        global $message;
        //validate
        $this->validate($request,[
            'departmentName' => 'required',
        ]);

        $departments = Departments::where('id', $request['departmentName'])->first();
        $budgetName = Budget::where('budgetName', 'The department of '.$departments->departmentName. " Budget" )->first();
        if (isset($budgetName)){
              $message = "Sorry but department of ". $departments->departmentName." has an account created already!";
        }else{
            $user = Auth::user();
            $school = School::where('id', $this->getAccountantSchool())->first();

            $account = new Accounts();
            $account->accountName = 'The department of '.$departments->departmentName. " main account";

            $account->user()->associate($user);
            $account->school()->associate($school);
            if ($account->save()){
                $acc = Accounts::where('id', $account->id)->first();
                $budget = new Budget();
                $budget->budgetName = 'The department of '.$departments->departmentName. " Budget";
                $budget->departments()->associate($departments);
//                $budget->accounts()->associate($acc);
                $acc->budget()->save($budget);
                $budget->save();
                $message = "Account added successfully!";

            }else{
                $message = "Error!";
            }
        }

        Session::flash('flash_message', $message);
        Session::flash('alert-class', 'alert-danger');
        Return Redirect::back();
    }

    public function addSchoolAccount(){

        $records = Accounts::where('school_id', $this->getAccountantSchool())
            ->orderBy('created_at', 'desc')
            ->get();
        $this->accountTotalIncomeCalculator($records);
        if ($records){
            return view('acc.addSchoolAccount')
                ->with('records' , $records);
        }

        return view('acc.addSchoolAccount');
    }

    public function saveAddedSchoolAccount(Request $request){

        global  $message;

        //validation
        $this->validate($request,[
//            'accountName' => 'required|max:255'
        ]);

        $school = School::where('id', $this->getAccountantSchool())->first();
        $accountName = Accounts::where('accountName', 'The school of '.$school->schoolName .' main account')->first();
        if (isset($accountName)){
            $message = "Sorry!but The School of ". $school->schoolName." has an account created already!";
        }else{
            $user = Auth::user();
            $account = new Accounts();
            $account->accountName = 'The school of '.$school->schoolName .' main account';
            //$account->accountName = $request['accountName'];
            $account->user()->associate($user);
            $account->school()->associate($school);
            $account->save();
        }

        Session::flash('flash_message', $message);
        Return Redirect::back();
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
