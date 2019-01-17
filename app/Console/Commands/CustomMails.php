<?php

namespace App\Console\Commands;

use Mail;
use App\CustomMail;
use Illuminate\Console\Command;

class CustomMails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:release';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send custom mail if any pending';

    /**
     * Create a new command instance.
     *
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
        // check that if any email send_at date is equal to current date and send_at time less then equal to now() time

        $sendingData = CustomMail::whereStatus(0)
                        ->whereDate('send_at', '=' , now())
                        ->whereTime('send_at', '<=', now())
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
}
