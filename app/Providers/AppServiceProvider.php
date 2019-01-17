<?php

namespace App\Providers;

use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Log;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Queue::before(function (JobProcessing $event) {
            $event->connectionName;
            $event->job;
            $event->job->payload();
            Log::info("Job is going to start");

        });

        Queue::after(function (JobProcessed $event) {
            $event->connectionName;
            $event->job;
            $event->job->payload();
            Log::info("Job is Processed");
        });

         Queue::failing(function (JobFailed $event) {
            $event->connectionName;
            $event->job;
            $event->exception;

            Log::error("Job is failed");
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('staging')) {
            $this->app->register(\Jenssegers\Rollbar\RollbarServiceProvider::class);
        }
    }
}
