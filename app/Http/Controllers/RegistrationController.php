<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    /**
     *  Handles user registration
     * 
     *  @param  Illuminate\Http\Request $request
     *  @return Response
     */
    public function register(Request $request)
    {
        // validate form fields
        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'email' => 'required|email'
        ]);
  
        $input = $request->all();

        // if validation is success then create an input array
        $inputArray = array(
            'name' => trim($request->name),
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password)
        );

        // register the user
        $user = User::create($inputArray);

        // if registration is a success then return with success message.
        if(!is_null($user)){
            return back()->with('success', 'You have registered successfully.');
        }

        // else return with error message
        else{
            return back()->with('error', 'Whoops! some error encountered. Please try again.');
        }

    }
}
