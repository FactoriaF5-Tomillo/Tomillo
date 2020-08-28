<?php

namespace App\Console\Commands;

use App\Day;
use Carbon\Carbon;
use Illuminate\Console\Command;

class workedTimeWeek extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weekworked:time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will get the week worked time ';

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
     * @return int
     */
    public function handle()
    {
        //Day::where( 'user_id', '=', 3)->first()->delete();
        $days = Day::where( 'date', '>', Carbon::now()->subDays(5))->get();
        $weekworkedTime = Day::getWorkedHoursOfAStudentInACourse($days);

        return $weekworkedTime;
    }
}
