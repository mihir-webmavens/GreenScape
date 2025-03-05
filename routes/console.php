<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule::command('app:send-plant-watering-reminder')->dailyAt('08:00');
// Schedule::command('app:send-plant-watering-reminder')->everyFiveSeconds();
Schedule::command('app:send-plant-watering-reminder')->dailyAt('18:00');

