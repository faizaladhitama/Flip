<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Disbursement as DisbursementModel;
use App\Disbursement;
use App\Integration\SlightlyBig;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $disbursements = DisbursementModel::where('status', 'pending')->get();

            foreach ($disbursements as $disbursementModel) {
                $slightlyBig = new SlightlyBig();
                $disbursement = $slightlyBig->getDisbursement($disbursementModel->disbursement_id);

                print_r($disbursement);
                
                $disbursementModel->disbursement_id = $disbursement->id;
                $disbursementModel->amount = $disbursement->amount;
                $disbursementModel->status = $disbursement->status;
                $disbursementModel->disbursement_timestamp = $disbursement->timestamp;
                $disbursementModel->bank_code = $disbursement->bank_code;
                $disbursementModel->account_number = $disbursement->account_number;
                $disbursementModel->beneficiary_name = $disbursement->beneficiary_name;
                $disbursementModel->remark = $disbursement->remark;
                $disbursementModel->receipt = $disbursement->receipt;

                if($disbursement->time_served != '0000-00-00 00:00:00'){
                    $disbursementModel->time_served = $disbursement->time_served;
                }

                $disbursementModel->fee = $disbursement->fee;

                $disbursementModel->save();
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
