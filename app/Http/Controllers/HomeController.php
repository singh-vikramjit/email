<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomMail;

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
        for ($i = 0; $i < 5000; $i++) {
            
            CustomMail::create([
                'data' => 'abc_'.$i,
                'subject' => 'abc_'.$i,
                'email' => 'abc_'.$i.'@uds.com',
                'send_at' => now(),
            ]);

        echo 'Time needed: ' . (microtime(true) - $start) . '.';

        dd('here');
    }
}
