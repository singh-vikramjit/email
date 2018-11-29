<?php

namespace App\Jobs;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;


class DispatchMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $request)
    {   

        $data = [];
        $data['email'] = env(MAIL_TO);
        $data['subject'] = 'Test dispatch!';

        Mail::to('vikramjitsingh@ucreate.co.in')->send( new TestMail() );

        if (Mail::failures()) {
            return false;    
        }

        return true;
    }
}
