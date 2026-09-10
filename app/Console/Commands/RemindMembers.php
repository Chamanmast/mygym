<?php

namespace App\Console\Commands;

use App\Events\ReminderMember;
use App\Jobs\ReminderMemberNotificationJob;
use App\Models\User;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class RemindMembers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:remind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind members to book a call';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::where('role', 'user')
            ->whereDoesntHave('bookings', function ($query) {
                $query->where('date_time', '>', now());
            })->select('id','name', 'email')->orderBy('id')->get();

         foreach ($users as $user) {
        ReminderMemberNotificationJob::dispatch($user);
    }
        //$this->table(['Id','Name','Email'],$users->toArray());
        $this->info("Reminder jobs dispatched: {$users->count()}");
    }
}
