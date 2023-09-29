<?php

namespace App\View\Components;

use App\Models\Appointment;
use App\Models\Location;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

/**
 *
 */
class DaySchedule extends Component
{
    public  $daySchedule = null;
    public  $timeSlots  = null;

    public $location   = null;

    public function __construct(
        public readonly Carbon $date,
        // location id
        public readonly int $locationId,

    )
    {
        $this->daySchedule = $this->getDaySchedule();
        $this->timeSlots = $this->getTimeSlots();
        $this->location = Location::where('id', $this->locationId)->first();
    }

    public function render(): View
    {

        return view('components.day-schedule');
    }

    private function getDaySchedule()
    {

        return (
            Appointment::orderBy('start_time', 'asc')
            ->where('date', $this->date->toDateString())
            ->where('status', '!=', 0)
            ->orderBy('time_slot_id', 'asc')
            ->where('status', '!=', 0)
            ->where('location_id', $this->locationId)
            ->with('service', 'timeSlot', 'user')
            ->get());
    }

    private function getTimeSlots()
    {
        return TimeSlot::all();
    }
}
