<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     *  Redirect page to profile page
     * 
     *  @return Response
     */
    public function profile(){
        return view('profile');
    }
}
