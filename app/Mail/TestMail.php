<?php

namespace App\Mail;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $request =null)
    {
       $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $sbuject    = $this->request['subject'] ?? "Test mail!";
        $view       = $this->request['view'] ?? 'email.mailExample';

        return $this->view($view)
                    ->subject($sbuject);
    }
}
