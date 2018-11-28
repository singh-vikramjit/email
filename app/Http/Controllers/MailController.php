<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\Mail\TestMail;

use Session;
use Artisan;
use App\User;

class MailController extends Controller
{
    
	/**
	* Send mail to user with queue.
	*
	* @return mixed
	*/

    public function mail_queue(Request $request)
    {   
        $email = $request->email ?? env('MAIL_TO');

        Mail::to($email)->queue( new TestMail() );

        $flash['status'] = 'success';
        $flash['message'] = 'Email Sent';

        if (Mail::failures()) {
	        $flash['status'] = 'danger';
        	$flash['message'] = 'Something went wrong!';
	    }
	    
	    return redirect('/')->with($flash);

    }

	/**
	* Send mail to user with custom solution.
	*
	* @return mixed
	*/

    public function custom_solution(Request $request)
    {   

        $email = $request->email ?? env('MAIL_TO');

        $flash['status'] = 'success';
        $flash['message'] = 'Email Sent';
	    
	    return redirect('/')->with($flash);

    }

	/**
	* Send mail to user with command.
	*
	* @return mixed
	*/

    public function mail_command(Request $request)
    {   

        $email[] = $request->email ?? env('MAIL_TO');

        $exitCode = Artisan::call('email:send', [
	        'email' => $email ]);

        $flash['status'] = 'success';
        $flash['message'] = 'Email Sent';
	    
	    return redirect('/')->with($flash);

    }

}