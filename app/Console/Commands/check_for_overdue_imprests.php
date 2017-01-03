<?php

namespace App\Console\Commands;

use App\Imprest;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Http\Controllers\ImprestController;
use Mail;

class check_for_overdue_imprests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:overdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks for imprests that have been active for more than 48 hours';

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
     * @return mixed
     */
    public function handle()
    {
        //query to get imprests that were created more than 48 hours ago
        $imprests = Imprest::where('created_at', '<', Carbon::now()->subHours(48))->where('isRetired', '=', 0)->get();

        //notify the owners of these imprests and set an over due attribute to use for penalising
        if($imprests!=[]) {
            foreach ($imprests as $imprest) {
                $imprest->overDue = 1;
                $imprest->save();

                //send the mail
                if (imprestController::is_connected()) {

                    Mail::send('Mails.overDue', ['imprest' => $imprest], function ($m) use ($imprest) {

                        $m->to($imprest->owner->email, 'Me')->subject('Imprest is now overdue');
                    });
                }

            }
        }
    }
}
