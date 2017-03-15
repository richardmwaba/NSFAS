<?php

namespace App\Http\Controllers;

use App\Accounts;
use App\Activities;
use App\Budget;
use App\BudgetItems;
use App\CalculatedTotal;
use App\Departments;
use App\Estimates;
use App\Expenditure;
use App\Income;
use App\Objectives;
use App\Projects;
use App\StrategicDirections;
use App\User;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

use Auth;
use Validator;
use Mail;
use Hash;
use PDF;


class HODController extends Controller
{

    protected $totalCost;
    protected $msg = " ";


    public function departmentBudgetProposalPDF(){
        $dpName = null;

        $dp = Departments::find($this->getDepartmentIdFromLoggedInUSer());
        if ($dp){ $dpName = $dp->departmentName; }
        $records = Activities::where('department_id', $dp->id)->get();
        $totalBudget = 0;
        foreach ( $records as $record){
            $total = Estimates::where('activities_id', $record->id)->sum('cost');
            $totalBudget = $totalBudget +$total;
        }

        $pdf = PDF::loadView('reports.departmentBudgetProposalPDF',
            ['records'=>$records,'dpName'=>$dpName,
                'totalBudget' =>$totalBudget,]);

        return $pdf->stream('reports.departmentBudgetProposalPDF');
    }


    /**
     * @return mixed
     */
    public  function departmentFinalActualBudget(){
        $dpName = null;

        $dp = Departments::find($this->getDepartmentIdFromLoggedInUSer());
        if ($dp){ $dpName = $dp->departmentName; }
        $records = Activities::where('department_id', $dp->id)->where('belongsToActualBudget', 1)->get();
        $totalBudget = 0;
        foreach ( $records as $record){
            $total = Estimates::where('activities_id', $record->id)->sum('cost');
            $totalBudget = $totalBudget +$total;
        }

        $pdf = PDF::loadView('reports.departmentFinalActualBudget',
            ['records'=>$records,'dpName'=>$dpName,
            'totalBudget' =>$totalBudget,]);

        return $pdf->stream('reports.departmentFinalActualBudget');
    }

    /**
     * @param $id
     * @return mixed
     */
    public  function getProjectPdf($id){

        $project = Projects::where('id', $id)->first();
        $budget = Budget::where('projects_id',$project->id)->first();
        $budgetItems = BudgetItems::where('budget_id',$budget->id)->get();

        $account = Accounts::where('projects_id', $project->id)->first();
        $totalIn = Income::where('accounts_id', $account->id)->sum('amountReceived');
        $totalEx = Expenditure::where('accounts_id', $account->id)->sum('amountPaid');

        $pdf = PDF::loadView('reports.projectsPDF', ['project'=>$project,'budgetItems'=>$budgetItems,
            'totalIn' =>$totalIn, 'totalEx'=>$totalEx]);

        return $pdf->stream('reports.projectsPDF');
    }

    public function redirectBack(){
        Return Redirect::back();
    }

    public function viewActualBudgetInfo(){

        $dpName = null;
        $dp = Departments::find($this->getDepartmentIdFromLoggedInUSer());
        if ($dp){ $dpName = $dp->departmentName; }
        $records = Activities::where('department_id', $dp->id)->where('belongsToActualBudget', 1)->get();
        $totalBudget = 0;
        foreach ( $records as $record){
            $total = Estimates::where('activities_id', $record->id)->sum('cost');
            $totalBudget = $totalBudget +$total;
        }

        if ($records){
            return view('hod.viewActualBudgetInfo')
                ->with('records' , $records)
                ->with('dpName' , $dpName)
                ->with('totalBudget' , $totalBudget);
        }
        return view('hod.viewActualBudgetInfo');
    }

    public function moreInfo($id){
       $activity = Activities::where('id', $id)->first();
        return view('moreActivityInfo')->with('activity', $activity);
    }

    protected function actualBudgetTotalIncomeCalculator($activities){
        global  $totalCost;

        foreach ( $activities as $record){
            $totalIncome = Estimates::where('activities_id', $record->id)->sum('cost');
            $totalCost  += $totalIncome;
        }

        return $totalCost;
    }


    public function saveAsFinal($id){
        global  $msg;

        $department = Departments::where('id', $this->getDepartmentIdFromLoggedInUSer())->first();
        $budget = Budget::where('budgetName', 'The department of '.$department->departmentName. " Budget")
            ->where('departments_id', $this->getDepartmentIdFromLoggedInUSer())->first();

        if (isset($budget)){
            $activity = Activities::where('id', $id)->first();
            $activity->belongsToActualBudget = 1;
            $departmentIncome = $budget->departmentIncome;
            $activities = Activities::where('department_id', $this->getDepartmentIdFromLoggedInUSer())
                ->where('belongsToActualBudget', 1)->get();

            $sum = $this->actualBudgetTotalIncomeCalculator($activities) + $activity->estimate->cost;
            if ($sum <= $departmentIncome){
                $remainingAmount = $departmentIncome - $sum;

                $budget_item = new BudgetItems();
                $budget_item->budgetLine ='The department of '.$department->departmentName. " Budget";
                $budget_item->description = $activity->estimate->itemDescription;
                $budget_item->quantity = $activity->estimate->quantity;
                $budget_item->pricePerUnit =  $activity->estimate->pricePerUnit;
                $budget_item->cost =  $activity->estimate->cost;

                $budget_item->activities()->associate($activity);
                $budget_item->budget()->associate($budget);
                if ($budget_item->save()){
                    $activity->save();
                }else{
                    $msg = " An Error 421! Please Contact the system administrator!";
                }
                $this->actualBudgetTotalIncomeCalculator($activities);
                $msg = "successfully added!Now you are remaining with K".$remainingAmount.'.00 to add to the final actual budget! 
                please keep this in mind when saving next activity!';
            }else{
                //display an error message
                $excessAmount =$sum - $departmentIncome;
                $msg = 'Sorry, you have exceeded by K'.$excessAmount.'.00 
                !please make sure that your total final actual budget does not exceed K' . $departmentIncome. '.00 as allocated 
                to your department by your School';
            }

        }else{
           $msg = 'The account for your department is not yet created! please info the accountant about this problem';
        }

        Session::flash('flash_message', $msg);
        Return Redirect::back();
    }

    public function modify($id){
        $activity = Activities::where('id', $id)->first();
        $estimate = Estimates::where('activities_id', $activity->id)->first();
        return view('hod.modifyBudget')->with('estimate', $estimate);
    }

    public function modifySave(Request $request, $id){

        $this->validate($request, [
           'itemDescription' => 'required',
           'quantity' => 'required',
           'pricePerUnit' => 'required',
           'cost' => 'required'
        ]);

        $estimate = Estimates::where('id', $id)->first();
        $estimate->itemDescription = $request['itemDescription'];
        $estimate->quantity = $request['quantity'];
        $estimate->pricePerUnit = $request['pricePerUnit'];
        $estimate->cost = $request['cost'];
        $estimate->update();

        Return Redirect::action('HodController@actualBudget');
    }

    public function actualBudget(){

        $department = Departments::where('id', $this->getDepartmentIdFromLoggedInUSer())->first();
        $budget = Budget::where('budgetName', 'The department of '.$department->departmentName. " Budget")
            ->where('departments_id', $this->getDepartmentIdFromLoggedInUSer())->first();

        $departmentIncome = $budget->departmentIncome;
        $activities = Activities::where('department_id', $this->getDepartmentIdFromLoggedInUSer())
            ->where('belongsToActualBudget', 1)->get();

        $sum = $this->actualBudgetTotalIncomeCalculator($activities);
        if ($sum <= $departmentIncome){
            $totalBudget = $departmentIncome - $sum;
        }else{
            $totalBudget = $sum - $departmentIncome;
        }

        $dpName = null;
        $dp = Departments::find($this->getDepartmentIdFromLoggedInUSer());
        if ($dp){ $dpName = $dp->departmentName; }

        $records = Activities::where('department_id', $dp->id)->where('belongsToActualBudget', 0)->get();
//        $totalBudget = 0;
//        foreach ( $records as $record){
//            $total = Estimates::where('activities_id', $record->id)->sum('cost');
//            $totalBudget = $totalBudget +$total;
//        }
        if ($records){
            return view('hod.actualBudget')
                ->with('records' , $records)
                ->with('dpName' , $dpName)
                ->with('departmentIncome' , $departmentIncome)
                ->with('totalBudget' , $totalBudget);
        }
        return view('hod.actualBudget');
    }

    public function budgetProposal(){

        $stBudgetPlan = StrategicDirections::where('school_id', $this->getSchoolId())->get();
        return view('hod.budgetProposal')->with('stBudgetPlan', $stBudgetPlan);
    }

    public function departmentBudgetProposal(){

        $dpName = null;
        $dp = Departments::find($this->getDepartmentIdFromLoggedInUSer());
        if ($dp){ $dpName = $dp->departmentName; }
        $records = Activities::where('department_id', $dp->id)->get();
        $totalBudget = 0;
        foreach ( $records as $record){
            $total = Estimates::where('activities_id', $record->id)->sum('cost');
            $totalBudget = $totalBudget +$total;
        }

        if(isset($records) and $dp){
            return view('hod.dBProposal')
                ->with('records' , $records)
                ->with('dpName' , $dpName)
                ->with('totalBudget' , $totalBudget);
        }

        return view('hod.dBProposal');
    }

    public function saveObjective(Request $request){

        //validate
        $this->validate($request, [
            'body'=>'required'
        ]);

        $row = StrategicDirections::where('id', $request['strategyId'])->first();
        $record = new Objectives();
        $record->objective = $request['body'];
        $record->department_id = $this->getDepartmentIdFromLoggedInUSer();
        $row->objective()->save($record);
        return response()->json(['success'=> 'Objective added successfully'], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveActivity(Request $request){

        $row = Objectives::where('id',$request['objectiveId'])->first();
        $entry = StrategicDirections::find($request['strategicId']);
        $department = Departments::find($this->getDepartmentIdFromLoggedInUSer());

        $active = new Activities();
        $active->activityName = $request['activity_name'];
        $active->school_id = $department->schools_id;
        $active->indicatorOfSuccess = $request['success_indicator'];
        $active->targetOfIndicator = $request['target_indicator'];
        $active->baselineOfIndicator = $request['baseline_indicator'];
        $active->staffResponsible	 = $request['staff_responsible'];
        $active->percentageAchieved = $request['percentage_achieved'];
        $active->sourceOfFunding = $request['source_funding'];
        $active->firstQuarter = $request['first_quarter'];
        $active->secondQuarter = $request['second_quarter'];
        $active->thirdQuarter = $request['third_quarter'];
        $active->fourthQuarter = $request['fourth_quarter'];

        $active->strategic_directions()->associate($entry);
        $active->department()->associate($department);
        $active->objectives()->associate($row);
        $active->save();

        $activity = Activities::where('id', $active->id)->first();

        $estimates = new Estimates();
        $estimates->itemDescription =  $request['item_description'];
        $estimates->quantity =  $request['quantity_value'];
        $estimates->pricePerUnit = $request['price_per_unit'];
        $estimates->cost = $request['total_cost'];
        $estimates->department_id = $this->getDepartmentIdFromLoggedInUSer();
        $activity->estimate()->save($estimates);


        return response()->json(['message'=> $activity->activityName ], 200);
    }

    public function activities(){
        $records = Objectives::where('department_id', $this->getDepartmentIdFromLoggedInUSer())->get();
        return view('hod.activities')->with('records',$records);
    }

    public function projectReport(){

        if ($this->getAccessLevelId() == 'OT'){
            $record = Projects::where('departments_id', $this->getDepartmentIdFromLoggedInUSer())
                ->where('projectCoordinator', $this->getUsersFullName())
                ->get();
        }elseif ($this->getAccessLevelId()=='HD'){
            $record = Projects::where('departments_id', $this->getDepartmentIdFromLoggedInUSer())->get();
        }else{
            $record = Projects::all();
        }

        if($record){
            return view('reports.projectReport')->with('record', $record);
        }else{
            return view('reports.projectReport');
        }


    }
    public function index()
    {
        return view('hod.addStaff');
    }

    public function staff()
    {
        $id = $this->getDepartmentIdFromLoggedInUSer();
        $staff = User::where('departments_id', $id)->get();
        if ($staff) {
            return view('hod.staff')->with('staff', $staff);
        } else {
            return view('hod.staff');
        }
    }

    public function imprestForm()
    {

        return view('imprests.imprests');
    }

    public function addStaff(Request $request)
    {
        $validator = $this->addStaffValidation($request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $password = str_random(8);

        $staff = new User();
        $staff->manNumber = $request['manNumber'];
        $staff->email = $request['email'];
        $staff->access_level_id = 'OT';
        $staff->password = bcrypt($password);
        $staff->lastName = ucfirst($request['lastName']);
        $staff->firstName = ucfirst($request['firstName']);
        $staff->otherName = ucfirst($request['otherName']);
        $staff->phoneNumber = $request['phoneNumber'];
        $staff->departments_id = $this->getDepartmentIdFromLoggedInUSer();
        $staff->save();

        // code for sending email to the added user
        if (ImprestController::is_connected()) {
            Mail::send('Mails.addUser', ['password' => $password], function ($m) use ($staff) {

                $m->to($staff->email, 'Me')->subject('Your account has been created');
            });
        }

        Session::flash('flash_message', 'Staff member added successfully. An email has been sent to the staff! ');
        Return Redirect::action('HodController@staff');
    }

    public function projectInfo()
    {
        if ($this->getAccessLevelId() == 'OT') {
            $record = Projects::where('departments_id', $this->getDepartmentIdFromLoggedInUSer())
                ->where('projectCoordinator', $this->getUsersFullName())
                ->get();
        } else {
            $record = Projects::where('departments_id', $this->getDepartmentIdFromLoggedInUSer())->get();
        }

        foreach ($record as $rec) {
            $this->projectTotalBudgetCalculator($rec->id);
            $this->projectTotalIncomeCalculator($rec->id);
        }

        if ($record) {
            return view('hod.projectInfo')->with('record', $record);
        } else {
            return view('hod.projectInfo');
        }
    }

    public function requestForMoney($id)
    {
        $projects = Projects::find($id);
        $budget = Budget::where('projects_id', $id)->first();
        $budget = BudgetItems::where('budget_id', $budget->id)->get();
        return view('hod.projectMoneyRequest')
            ->with('projects', $projects)
            ->with('budget', $budget);
    }

    public function projectMoneyRequest(Request $request, $id)
    {
        $validator = $this->projectMoneyRequestValidation($request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $account = Accounts::where('projects_id', $id)->first();
        $project = Projects::where('id', $id)->first();
        $expend = new Expenditure();
        $expend->amountPaid = $request['requestedAmount'];
        $expend->budgetLine = $request['budgetLine'];
        $expend->beneficiary = $request['beneficiary'];
        $expend->purpose = $request['purpose'];
        $expend->datePaid = $request['date'];
        $expend->accounts_id = $account->id;
        $project->expenditures()->save($expend);

        Session::flash('flash_message', 'Your request has been successfully submitted!');
        Return Redirect::action('HodController@projectExpenditures');
    }

    public function requestApproval($id)
    {

        $projects = Projects::where('id', $id)->first();
        if ($projects->expenditures->approvedByHOD == 0) {
            $projects->expenditures->approvedByHOD = 1;
            $projects->save();

            $message = " success";
        } else {
            $message = 'error';
        }
        Session::flash('flash_message', $message);
        Return Redirect::back();
    }

    public function projectExpenditures()
    {
        if ($this->getAccessLevelId() == 'OT'){
            $projects = Projects::where('departments_id', $this->getDepartmentIdFromLoggedInUSer())
                ->where('projectCoordinator', $this->getUsersFullName())
                ->get();
        }elseif ($this->getAccessLevelId()=='HD'){
            $projects = Projects::where('departments_id', $this->getDepartmentIdFromLoggedInUSer())->get();
        }else{
            $projects = Projects::all();
        }

        if ($projects) {
            return view('hod.projectExpenditures')->with('projects', $projects);
        }
    }

    public function destroy($id){
        $item = StrategicDirections::find($id);
        $item->delete();
        return back();
    }

    public function edit($id){
        $record = StrategicDirections::find($id);

        return view('dean.editStrategy')->with('record', $record);
    }

    public function addProject()
    {

        $id = $this->getDepartmentIdFromLoggedInUSer();
        $staff = User::where('departments_id', $id)->get();
        if ($this->getAccessLevelId() == 'OT') {
            $projects = Projects::where('departments_id', $this->getDepartmentIdFromLoggedInUSer())
                ->where('projectCoordinator', $this->getUsersFullName())
                ->orderBy('created_at', 'desc')
                ->take(2)
                ->get();
        } else {
            $projects = Projects::where('departments_id', $id)
                ->orderBy('created_at', 'desc')
                ->take(2)
                ->get();
        }
        if ($staff) {
            return view('hod.addProjects')->with('staff', $staff)->with('projects', $projects);
        } else {
            return view('hod.addProjects');
        }
    }

    public function saveProject(Request $request)
    {
        $validator = $this->saveProjectValidation($request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $net_project_budget = $request['netProjectBudget'];
        $departmentPercentage = $request['departmentPercentage'];
        $unzaPercentage = $request['unzaPercentage'];
        $actualProjectBudget= $request['actualProjectBudget'];

         $dPercentage = ($departmentPercentage/100) * $net_project_budget;
         $uPercentage = ($unzaPercentage/100) * $net_project_budget;

        $id = $this->getDepartmentIdFromLoggedInUSer();
        $department = Departments::where('id', $id)->first();
        $newProject = new Projects();
        $newProject->projectName = ucfirst($request['projectName']);
        $newProject->projectCoordinator = $request['projectCoordinator'];
        $newProject->description = $request['description'];
        $newProject->startDate = $request['startDate'];
        $newProject->endingDate = $request['endDate'];

        if ($department->projects()->save($newProject)){
            $projectName =  $request['projectName'];
            $record = Projects::where('projectName', $projectName)->first();
            if (isset($record)){
                $budget = new Budget();

                $budget->budgetName = $projectName;
                $budget->netProjectBudget = $request['netProjectBudget'];
                $budget->departmentAmount = $dPercentage;
                $budget->unzaAmount = $uPercentage;
                $budget->actualProjectBudget = $actualProjectBudget;
                $budget->departments_id = $record->departments_id;

                if ($record->budget()->save($budget)){
                    $account = new Accounts();
                    $account->accountName = $projectName;
                    $record->accounts()->save($account);
                }
            }else{

            }
        }else{

        }
        Session::flash('flash_message', 'The '.$projectName.' project has been added successfully. Outline your budget and await for the HOD approval!');
        Return Redirect::action('HodController@addProject');
    }

    public function projectBudget($id){
        $this->projectTotalIncomeCalculator($id);
        $this->projectTotalBudgetCalculator($id);
        $records = Projects::where('id',$id)->first();
        $total = CalculatedTotal::where('projects_id', $id)->first();
        $data = Budget::where('projects_id', $records->id)->first();
        $items = BudgetItems::where('budget_id', $data->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('hod.projectBudgeting')
            ->with('records', $records)
            ->with('items', $items)
            ->with('total', $total);
    }

    public function projectTotalIncomeCalculator($projects_id){

        $project = Projects::where('id', $projects_id)->first();
        $account = Accounts::where('projects_id', $projects_id)->first();
        $totalAmountReceived = Income::where('accounts_id',$account->id)->sum('amountReceived');
        $record = CalculatedTotal::where('projects_id', $projects_id)->first();
        if (isset($record)) {
            $record->incomeAcquired = $totalAmountReceived;
            $project->totalAmount()->save($record);
        }else{
            $total = new CalculatedTotal();
            $total->incomeAcquired = $totalAmountReceived;
            $project->totalAmount()->save($total);
        }
    }

    public function projectTotalBudgetCalculator($id)
    {
        $project = Projects::where('id', $id)->first();
        $budget = Budget::where('projects_id', $id)->first();
        $totalBudget = BudgetItems::where('budget_id', $budget->id)->sum('cost');
        $record = CalculatedTotal::where('projects_id', $id)->first();
        if (isset($record)) {
            $record->proposedBudget = $totalBudget;
            $project->totalAmount()->save($record);
        } else {
            $total = new CalculatedTotal();
            $total->proposedBudget = $totalBudget;
            $project->totalAmount()->save($total);
        }

        return $totalBudget;
    }

    public function projectBudgetApprove($id){

        $project = Projects::where('id', $id)->first();
        return view('hod.projectBudgetApproval')->with('project', $project);
    }

    public function saveProjectBudget(Request $request, $id)
    {
        $validator = $this->projectBudgetValidation($request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $record = Budget::where('projects_id',$id)->first();
        $actualProjectBudget = $record->actualProjectBudget;
        if (($this->projectTotalBudgetCalculator($id) + $request['cost']) <= $actualProjectBudget){
            if (isset($record)){

                $info = new BudgetItems();
                $info->budgetLine = $request['budgetLine'];
                $info->cost = $request['cost'];
                $info->description = $request['description'];
                $info->quantity = $request['quantity'];
                $info->pricePerUnit = $request['costPerUnit'];
                $record->budgetItems()->save($info);

                $this->projectTotalBudgetCalculator($id);

                if ($this->projectTotalBudgetCalculator($id) == $actualProjectBudget) {
                    //send an email to  the Hod so that he can approve the project's budget
                }

            }else{
                //display an error message
                Session::flash('flash_message', 'Error!');
                Return Redirect::back();
            }

        }else{
            //display an error message
            Session::flash('flash_message', 'Sorry make sure that your total budget does not exceed K' . $actualProjectBudget . '.00');
            Return Redirect::back();
        }

        Session::flash('flash_message', 'operation successfully');
        Return Redirect::action('HodController@projectBudget', $id);
    }



    public function viewAccountInfo(){
        $departments = Departments::where('id', $this->getDepartmentIdFromLoggedInUSer())->first();
        $account = Accounts::where('accountName', 'The department of '.$departments->departmentName. " main account")->first();
        if(isset($account)){
            $budget = Budget::where('accounts_id', $account->id)->first();
            return view('hod.viewAccountInfo')->with('account', $account)->with('budget', $budget)->with('departments', $departments);
        }else{
            return view('hod.viewAccountInfo')->with('departments', $departments);
        }
    }

    public function getDepartmentIdFromLoggedInUSer()
    {
        $user = Auth::user();
        $id = $user->departments_id;
        return $id;
    }

    public function getAccessLevelId(){
        $user = Auth::user();
        $access_level_id = $user->access_level_id;
        return  $access_level_id;
    }

    public function getSchoolId(){
        $user = Auth::user();
        $id = $user->schools_id;
        return $id;
    }

    public function getUsersFullName(){
        $user = Auth::user();
        $name = $user->firstName . ' ' . $user->otherName . ' ' . $user->lastName;
        return $name;
    }

    /**
     * Get a validator for an incoming profile editing request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function projectBudgetValidation(array $data)
    {
        return Validator::make($data, [
            'cost' => 'required|max:150',
            'quantity' => 'required|max:150',
            'costPerUnit' => 'required|max:150',
            'description' => 'required|max:255',
            'budgetLine' => 'required|max:255',
        ]);
    }

    /**
     * @param array $data
     * @return mixed
     */
    protected function projectMoneyRequestValidation(array $data)
    {
        return validator::make($data, [
            'date' => 'required|max:255',
            'beneficiary' => 'required|max:255',
            'purpose' => 'required|max:255',
            'requestedAmount' => 'required|max:255',
            'budgetLine' => 'required|max:255',
        ]);
    }

    /**
     * Get a validator for an incoming profile editing request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function saveProjectValidation(array $data)
    {
        return Validator::make($data, [
            'projectName' => 'required|max:255|unique:projects',
            'projectCoordinator' => 'required|max:255',
            'startDate' => 'required|max:255',
            'endDate' => 'required|max:255',
        ]);
    }

    /**
     * Get a validator for an incoming profile editing request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function addStaffValidation(array $data)
    {
        return Validator::make($data, [
            'lastName' => 'required|max:40',
            'firstName' => 'required|max:40',
            'otherName' => '|max:40',
            'manNumber' => 'required|max:40|unique:users',
            'email' => 'required|max:255|unique:users',
            'phoneNumber' => 'required|max:255|unique:users',
        ]);
    }
}
