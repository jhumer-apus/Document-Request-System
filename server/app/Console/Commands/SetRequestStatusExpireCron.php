<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Request;


class SetRequestStatusExpireCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set-request-to-expire:every-minute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set request status to expire when pending request past the appointment date';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $date = now();

        $requests = Request::join('appointments','appointments.request_id','=','requests.id')
                            ->where('appointments.schedule','<',$date)
                            ->update(['status'=> 'expired']);
    }
}
