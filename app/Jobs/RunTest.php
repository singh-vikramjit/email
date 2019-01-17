<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\CustomMail;

class RunTest implements ShouldQueue
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
    public function handle()
    {
        $start = microtime(true);
        for ($i = 0; $i < 5000; $i++) {
            
            CustomMail::create([
                'data' => 'abc_'.$i,
                'subject' => 'abc_'.$i,
                'email' => 'abc_'.$i.'@uds.com',
                'send_at' => now(),
                'status' => 0
            ]);
        }

        \Log::info('Time needed: ' . (microtime(true) - $start) . '.');
    }
}
