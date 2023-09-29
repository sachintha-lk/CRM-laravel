<?php

namespace App\View\Components;

use App\Models\Appointment;
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

    public function __construct(
        public readonly Carbon $date,

    )
    {
        $this->daySchedule = $this->getDaySchedule();
        $this->timeSlots = $this->getTimeSlots();
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
            ->with('service', 'timeSlot', 'user')
            ->get());
    }

    private function getTimeSlots()
    {
        return TimeSlot::all();
    }
}
