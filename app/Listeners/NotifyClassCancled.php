<?php

namespace App\Listeners;

use App\Events\ClassCancled;
use App\Jobs\NotifyClassCancleJob;
use App\Mail\ClassCancleMail;
use App\Notifications\ClassCancleNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

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
        $members = $event->scheduledClass->members()->get();
        $className =$event->scheduledClass->classType->name;
        $classDateTime =$event->scheduledClass->date_time->format('d-m-Y h:i A');

        $details = compact('className', 'classDateTime');
        // $members->each(function ($member, $index) use ($details) {
        //     //Send A mail
        //     Mail::to($member->email)
        //         ->later(
        //             now()->addSeconds($index * 10),
        //             new ClassCancleMail($details)
        //         );
        //     Log::info($member->email);
        //     // $member
        // });
        // $members->each(function ($member, $index) use ($details) {
        //     //Send A mail
        //     Mail::to($member->email)
        //         ->later(
        //             now()->addSeconds($index * 10),
        //             new ClassCancleMail($details)
        //         );
        //     Log::info($member->email);
        //     // $member
        // });
        NotifyClassCancleJob::dispatch($members,$details);
        // Log::info($scheduledClass);
    }
}
