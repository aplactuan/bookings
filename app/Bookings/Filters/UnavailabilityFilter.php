<?php

namespace App\Bookings\Filters;

use App\Bookings\Filter;
use App\Bookings\TimeSlotGenerator;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;

class UnavailabilityFilter implements Filter
{
    public $unavailabilities;

    public function __construct(Collection $unavailabilites)
    {
        $this->unavailabilities = $unavailabilites;
    }
    public function apply(TimeSlotGenerator $timeSlotGenerator, CarbonPeriod $interval)
    {
        $interval->addFilter(function ($slot) use ($timeSlotGenerator) {
          foreach ($this->unavailabilities as $unavailability) {
              if ($slot->between(
                  $unavailability->schedule->date->setTimeFrom(
                      $unavailability->start_time->subMinutes(
                          $timeSlotGenerator->service->duration - $timeSlotGenerator::INCREMENT
                      )
                  ),
                  $unavailability->schedule->date->setTimeFrom(
                      $unavailability->end_time->subMinutes($timeSlotGenerator::INCREMENT)
                  )
              )
              ) {
                return false;
              }
          }
          return true;
        });
    }
}
