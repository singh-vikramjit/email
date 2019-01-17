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

    public $request = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(?array $data )
    {
        $this->request = $data ?? [];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    //Request $request
    public function handle()
    {  
        $data = $this->request;
        $email = $data['email'] ?? env('MAIL_TO');

        Mail::to($email)
        ->send( new TestMail($data) );

        if (!Mail::failures()) {
            return true; 
        }
        return false;
    }
}
