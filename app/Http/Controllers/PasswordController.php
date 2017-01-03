<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    //
    public function change_password(Request $request)
    {
        // validate the variables ======================================================
        // if any of these variables don't exist, add an error to our $errors array
        $data = array();

        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'current_password' => 'required'

        ]);

        // return a response ===========================================================
        // if there are any errors in the errors array, return a success boolean of false
        if (!$validator->fails()) {
            if (Hash::check($request->current_password, Auth::user()->password)) {

                // if there are items in our errors array, return those errors
                $user = User::find(Auth::user()->manNumber);
                $user->password = bcrypt($request->password);
                $user->save();

                //send response to json
                $data['success'] = true;
                $data['message'] = 'Password updated!';
                session()->flash('flash_message', 'Your password been changed!');
            } else {

                //has wrong current password
                $validator->errors()->add('current_password', 'Please enter the correct password');

                // show a message of success and provide a true success variable
                $data['success'] = false;
            }

        }else{

            $data['success'] = false;
        }

        $data['errors'] = $validator->errors();

        // return all our request to an AJAX call
        return response()->json($data);

    }
}