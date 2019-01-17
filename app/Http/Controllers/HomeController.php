<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

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
        return view('home');
    } 

    public function testMethod()
    {

        $start = microtime(true);
        for ($i = 0; $i < 9000; $i++) {
            
            User::create([
                'name' => 'abc_'.$i,
                'username' => 'abc_'.$i,
                'email' => 'abc_'.$i.'@uds.com',
                'password' => Hash::make('123456'),
            ]);

        }
        echo 'Time needed: ' . (microtime(true) - $start) . '.';

        dd('here');
    }
}
