<?php

namespace App\Console\Commands;

use App\Mail\PlantWateringReminder;
use App\Models\CareTracker;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendPlantWateringReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-plant-watering-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today()->toDateString();
        $plants = CareTracker::with('user')->whereDate('next_watering',$today)->get();
        log::info($plants);
        foreach($plants as $plant){
            Mail::to($plant->user->email)->send(new PlantWateringReminder($plant));
        }
    }
}
