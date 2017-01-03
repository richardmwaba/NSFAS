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

use App\Http\Requests;
use Auth;
use Symfony\Component\HttpFoundation\Tests\AcceptHeaderTest;
use Validator;
use Mail;
use PDF;


class DeanController extends Controller
{

    protected $totalBudget = 0;

     public  function  viewAll(){
         global $totalBudget;
         $records = Activities::all();
         foreach ( $records as $record){
             $total = Estimates::where('activities_id', $record->id)->sum('cost');
             $totalBudget = $totalBudget +$total;
         }
         return view('dean.viewBudgetInfo')->with('records', $records)->with('totalBudget', $totalBudget);
     }

    public function getDepartmentProposalBudget(){
        $departments = Departments::all();

        $returnHTML = view('dean.dBProposal')->with('departments', $departments);
        return response()->json( array('success' => true, 'html'=>$returnHTML) );
//        return response()->json(['data'=> $departmentName ], 200);
    }

    public function getDB(Request $request, $id){

    }

    /**
     * @return mixed school id for the login dean
     */
    public  function getLoginDeanSchool(){
        $dean = Auth::user();
        return $dean->schools_id;
    }

    public function departmentBudget($id = null){

        $dpName = null;
        $departments = Departments::where('schools_id', $this->getLoginDeanSchool())->get();
        $dp = Departments::find($id);
        if ($dp){ $dpName = $dp->departmentName; }
        $records = Activities::where('department_id', $id)->get();
        global $totalBudget;
        foreach ( $records as $record){
            $total = Estimates::where('activities_id', $record->id)->sum('cost');
            $totalBudget = $totalBudget +$total;
        }

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

        $school->strategicDirections()->save($str_dir);

        Session::flash('flash_message', 'Strategy successfully added to the system!');
        Return Redirect::action('DeanController@add_Str_Dir');
    }
}
