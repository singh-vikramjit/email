<?php

namespace App\Console\Commands;

use Mail;
use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send {email*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail to users';

    /**
     * The drip e-mail service.
     *
     * @var DripEmailer
     */
    protected $drip;

    /**
     * Create a new command instance.
     *
     * @param  DripEmailer  $drip
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   
        $email = $this->argument('email');
        
        Mail::send('email.mailExample', [] , function($message) use ($email) {
            
            if(count($email) > 1){
                $bcc = $email;
                $message->bcc($bcc);
                $email = env('MAIL_FROM_ADDRESS');
            }

            $message->to($email);
            $message->subject('Test Description');
        });  
    }

}
