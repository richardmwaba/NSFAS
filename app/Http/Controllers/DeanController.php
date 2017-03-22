<?php

namespace App\Http\Controllers;


use App\Activities;
use App\Departments;
use App\Estimates;
use App\School;
use App\StrategicDirections;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;


use Auth;

use Validator;
use Mail;
use PDF;


class DeanController extends Controller
{

    protected $totalBudget = 0;

    protected function costCalculator($records){
        global $totalBudget;
        foreach ( $records as $record){
            $total = Estimates::where('activities_id', $record->id)->sum('cost');
            $totalBudget += $total;
        }
    }

    public function proposedBudgetReport(){
        global $totalBudget;
        $schoolName = null;

        $school = School::find($this->getLoginDeanSchool());
        if ($school){ $schoolName= $school->schoolName; }
        $records = Activities::where('school_id', $school->id)->get();
        $this->costCalculator($records);

        $pdf = PDF::loadView('reports.proposedBudgetReport',
            ['records'=>$records,'schoolName'=>$schoolName,
                'totalBudget' =>$totalBudget,]);

        return $pdf->stream('reports.proposedBudgetReport');
    }

    public function actualBudgetReport(){
        global $totalBudget;
        $schoolName = null;

        $school = School::find($this->getLoginDeanSchool());
        if ($school){ $schoolName= $school->schoolName; }
        $records = Activities::where('school_id', $school->id)->where('belongsToActualBudget', 1)->get();
        $this->costCalculator($records);

        $pdf = PDF::loadView('reports.schoolActualBudget',
            ['records'=>$records,'schoolName'=>$schoolName,
                'totalBudget' =>$totalBudget,]);

        return $pdf->stream('reports.schoolActualBudget');
    }

     public  function  viewAll(){
         global $totalBudget;
         $records = Activities::where('school_id', $this->getLoginDeanSchool())->get();
         $this->costCalculator($records);
         return view('dean.viewBudgetInfo')->with('records', $records)->with('totalBudget', $totalBudget);
     }

     public function viewActualBudget(){
         global $totalBudget;
         $records = Activities::where('belongsToActualBudget', 1)->where('school_id', $this->getLoginDeanSchool())->get();
         $this->costCalculator($records);
         return view('dean.viewActualBudget')->with('records', $records)->with('totalBudget', $totalBudget);
     }

    /**
     * @return mixed school id for the login dean
     */
    public  function getLoginDeanSchool(){
        $dean = Auth::user();
        return $dean->schools_id;
    }

    public function getDepartmentIdFromLoggedInUSer()
    {
        $user = Auth::user();
        $id = $user->departments_id;
        return $id;
    }

    public function departmentActualBudget($id=null){

        $dpName = null;
        $departments = Departments::where('schools_id', $this->getLoginDeanSchool())->get();
        $dp = Departments::find($id);
        if ($dp){ $dpName = $dp->departmentName; }
        $records = Activities::where('department_id', $id)
            ->where('belongsToActualBudget', 1)->get();
        global $totalBudget;
        $this->costCalculator($records);

        if ($records){
            return view('dean.departmentsActualBudget')
                ->with('departments',$departments)
                ->with('records' , $records)
                ->with('dpName' , $dpName)
                ->with('totalBudget' , $totalBudget);
        }
        return view('dean.departmentsActualBudget')->with('departments',$departments);
    }

    public function departmentBudget($id = null){

        $dpName = null;
        $departments = Departments::where('schools_id', $this->getLoginDeanSchool())->get();
        $dp = Departments::find($id);
        if ($dp){ $dpName = $dp->departmentName; }
        $records = Activities::where('department_id', $id)->get();
        global $totalBudget;
        $this->costCalculator($records);

        if ($records and $dp){
            return view('dean.dBProposal')
                ->with('departments',$departments)
                ->with('records' , $records)
                ->with('dpName' , $dpName)
                ->with('totalBudget' , $totalBudget);
        }
        return view('dean.dBProposal')->with('departments',$departments);
    }

    public function add_Str_Dir()
    {
       $str_dir = StrategicDirections::where('school_id', $this->getLoginDeanSchool())->get();
        if (isset($str_dir)){
            return view('dean.add_Str_Dir')->with('str_dir', $str_dir);
        }
       return view('dean.add_Str_Dir');
    }

    /**
     * Get a validator for an incoming profile editing request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function add_Str_DirValidation(array $data)
    {
        return Validator::make($data, [
            'academicYear' => 'required|max:40',
            'strategy' => 'required|max:255',
        ]);
    }

    public function addStrategicDirections(Request $request){
        $validator = $this->add_Str_DirValidation($request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $school = School::where('id', $this->getLoginDeanSchool())->first();

        $str_dir = new StrategicDirections();
        $str_dir->academicYear = $request['academicYear'];
        $str_dir->strategy = $request['strategy'];

        $school->strategic_directions()->save($str_dir);

        Session::flash('flash_message', 'Strategy successfully added to the system!');
        Session::flash('alert-class', 'alert-success');
        Return Redirect::action('DeanController@add_Str_Dir');
    }
}
