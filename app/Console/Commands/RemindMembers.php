<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

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
        $this->table(['Id','Name','Email'],$users->toArray());
    }
}
