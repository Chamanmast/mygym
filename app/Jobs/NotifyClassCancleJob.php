<?php

namespace App\Jobs;

use App\Notifications\ClassCancleNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class NotifyClassCancleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Object $members,public Array $details)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
         Notification::send($this->members,new ClassCancleNotification($this->details));
    }
}
