<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $logged_in_user = Auth::user();
         $access_level_id = $logged_in_user->access_level_id;

         if ($access_level_id =='SA'){
             return view('admin.index');
         }elseif ($access_level_id =='AC'){
             return view('acc.index');
         }elseif ($access_level_id == 'HD'){
             return view('hod.index');
         }elseif ($access_level_id == 'DS'){
             return view('dos.index');
         }elseif ($access_level_id =='HU'){
             return view('hou.index');
         }else {

         }
    }
}
