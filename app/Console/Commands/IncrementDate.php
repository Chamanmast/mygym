<?php

namespace App\Console\Commands;

use App\Models\ScheduledClass;
use Illuminate\Console\Command;

class IncrementDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update {--days=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increment All Schedule all Classes Date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("🚀 Start Processing");

        $classes = ScheduledClass::latest('date_time')->get();
        foreach ($classes as $class) {
            $class->date_time = $class->date_time->addDay($this->option('days'));
            $class->save();
        }

        $this->info("✅ Completed");
    }
}
