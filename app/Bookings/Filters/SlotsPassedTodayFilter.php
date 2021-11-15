<?php

namespace App\Bookings\Filters;

use App\Bookings\Filter;
use App\Bookings\TimeSlotGenerator;
use Carbon\CarbonPeriod;

class SlotsPassedTodayFilter implements Filter
{
    public function apply(TimeSlotGenerator $timeSlotGenerator, CarbonPeriod $interval)
    {
        $interval->addFilter(function ($slot) use ($timeSlotGenerator){
           if ($timeSlotGenerator->schedule->date->isToday()) {
               if ($slot->lt(now())) {
                   return false;
               }
           }
           return true;
        });
    }
}
