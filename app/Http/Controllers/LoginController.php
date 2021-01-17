<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     *  Handles authentication attempt
     * 
     *  @param \Illuminate\Http\Request $request
     *  @return Response 
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //User credentials
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            //Authentication successful
            return redirect()->intended("dashboard");
        }else{
            //Authentication failed..
            return back()->with('error', 'Whoops! invalid username or password.');
        }
    }

    /**
     *  Destroy user session
     * 
     *  @return Response
     */
    public function logout(Request $request){
        $request->session()->flush();
        Auth::logout();
        //redirect to login page
        return redirect()->intended('login');
    }
}
