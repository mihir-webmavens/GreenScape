<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Mail\EventReminder;
use App\Models\CareTracker;
use App\Models\PlantCollection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEventEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-event-email';

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
        $events = CareTracker::with('users')->whereDate('start',     $today)->get();
       
        // $careTracker = CareTracker::whereHas('plantCollections', function ($query) {
        //     $query->where('user_id', auth()->id());
        // })->with('users')->get();

       
   
        foreach($events as $event){
          foreach($event->users as $user){
            Mail::to($user->email)->send(new EventReminder($event,$user->name));
        }
    }
    }
}
