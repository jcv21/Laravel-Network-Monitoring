<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class IndexController extends Controller
{
    /**
     *  Handles the index routes
     * 
     *  @return Response
     */
    public function index(){
        $data = [];
        if(Auth::check()){
            if(Session::has('username')){
                $data['username'] = Session::get('username');
            }

            return view("dashboard", compact($data));
        }else{
            return view('login');
        }
    }

    /**
     *  Run python network script
     * 
     *  @return Response
     */
    public function network_scripts(){
        $process = new Process(["python3", "/var/www/html/eyenet/public/sniffer/network.py"]);
        $process->run();

        // executes after the command finishes
        /* if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        } */

        /* return $process->getOutput(); */
    }
}
