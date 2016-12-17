<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
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
            'nationality' => 'required'
        ]);

        $user->fill(['firstName' => $request->firstName, 'lastName' => $request->lastName,
            'otherName' => $request->otherName, 'nationality' => $request->nationality,
            'address' => $request->address, 'phoneNumber' => $request->phoneNumber, 'NRC' => $request->nrcNumber,
        ]);

        if($request->has('email')){
            $user->email = $request->email;
        }


        $user->save();
        session()->flash('flash_message', 'Profile updated');
        Return Redirect::action('HomeController@index');

    }
}
