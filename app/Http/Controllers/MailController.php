<?php

namespace App\Http\Controllers;

use Mail;
use View;
use Artisan;
use Session;
use App\User;
use App\CustomMail;
use App\Mail\TestMail;
use App\Jobs\DispatchMail;
use Illuminate\Http\Request;

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

        /*
        # we can also send the mail to specific time with Queue 
        # for this we can use "later" method
        #    
        #   $when = now()->addMinutes(30); // or specific date/time
        #
        #   Mail::to(‘example@example.com’)->later( $when  , new TestMail() );
        */

        $flash['status'] = 'success';
        $flash['message'] = 'Email Sent !';

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

        $when = now()->addMinutes(rand(10,999));

        $mailTemplate  = View::make('email.mailExample');
        $data = base64_encode($mailTemplate->render());

        $insertArray = [];
        $insertArray['email'] = $email;
        $insertArray['send_at'] = $when;
        $insertArray['data'] = $data;
        $insertArray['subject'] = 'Test Subject';
        $insertArray['status'] = 0;

        $res = CustomMail::create($insertArray);

        $flash['status'] = 'success';
        $flash['message'] = 'You will receive the mail on '.$when;
		
		if(!$res){
			$flash['status'] = 'danger';
        	$flash['message'] = 'Something went wrong!';
		}

	    return redirect('/')->with($flash);
    }

    public function send_custom_mail(){

    	$sendingData = CustomMail::whereStatus(0)
    					->whereDate('created_at', '<=' , now())
    					->get()->toArray();

    	if(count($sendingData)){

    		$ids = [];

    		foreach ($sendingData as $key => $value) {
    			
    			$html = base64_decode($value['data']);

				Mail::send(array(), array(), function ($message) use ($html,$value) {
				  $message->to($value['email'])
				    ->subject($value['subject'])
				    ->setBody($html, 'text/html');
				});

				 if (!Mail::failures()) {
			        $ids[] = $value['id']; 
			    }
    		}

    		// update the status of sent mails
    		if(count($ids)){
    			CustomMail::whereIn('id', $ids)->update(['status' => 1]);
    		}
    	}
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

    /**
	* Send mail to user with command.
	*
	* @return mixed
	*/

    public function mail_dispatch(Request $request)
    {   
    	$data = [];
        $data['email'] 		= $request->email ?? env('MAIL_TO');
        $data['subject'] 	= 'Test dispatch!';
          
    	if( dispatch(new DispatchMail($data)) ) {
    		$flash['status'] = 'success';
        	$flash['message'] = 'Email Dispatched';
    	}else{
        	$flash['status'] = 'danger';
        	$flash['message'] = 'Email not Sent';
    	}
	    
	    return redirect('/')->with($flash);
    }
}