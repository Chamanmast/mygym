<?php

namespace App\Listeners;

use App\Events\ClassCancled;
use App\Mail\ClassCancleMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotifyClassCancled
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ClassCancled $event): void
    {
        $members = $event->scheduledClass->members();
        $className =$event->scheduledClass->classType->name;
        $classDateTime =$event->scheduledClass->date_time->format('d-m-Y h:i A');

        $details = compact('className', 'classDateTime');
        $members->each(function ($member, $index) use ($details) {
            //Send A mail
            Mail::to($member->email)
                ->later(
                    now()->addSeconds($index * 10),
                    new ClassCancleMail($details)
                );
            Log::info($member->email);
            // $member
        });

        // Log::info($scheduledClass);
    }
}
