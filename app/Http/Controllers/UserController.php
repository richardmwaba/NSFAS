<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{


    public function postSaveAccount(Request $request){

        $user =Auth::user();
        $file = $request->file('image');
        $fileName = $user->firstName. '-'.$user->id.'001'.'.jpg';
        if ($file){
            Storage::disk('local')->put($fileName, File::get($file));
        }

        Return Redirect::action('UserController@my_profile');

//        return redirect()->route('my_profile');
    }

    public  function getUserImage($filename){
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }

    //
    public function my_profile()
    {

        $user = Auth::User();
        return view('profile.my_profile')->with('user', $user);

    }

    public function edit_profile()
    {
        $user = Auth::user();
        return view('profile.edit_profile')->with('user', $user);


    }

    //stores profile changes to database
    public function store(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'email' => 'sometimes|email|max:255|unique:users',
        ]);

        $user->fill(['firstName' => $request->firstName, 'lastName' => $request->lastName,
            'otherName' => $request->otherName, 'phoneNumber' => $request->phoneNumber,
        ]);

        if($request->has('email')){
            $user->email = $request->email;
        }


        $user->save();
        session()->flash('flash_message', 'Profile updated');
        Session::flash('alert-class', 'alert-success');
        Return Redirect::action('HomeController@index');

    }
}
