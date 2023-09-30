<?php

namespace Database\Seeders;

use App\Models\TimeSlot;
use DateInterval;
use DateTime;
use Illuminate\Database\Seeder;

class TimeSlotSeeder extends Seeder
{
    public function run(): void
    {

        $startTime = '09:00:00';
        $endTime = '18:00:00';

        $startDateTime = new DateTime($startTime);
        $endDateTime = new DateTime($endTime);

        // Interval between time slot
        $interval = new DateInterval('PT1H');

        while ($startDateTime < $endDateTime) {

            TimeSlot::create([
                'start_time' => $startDateTime->format('H:i:s'),
                'end_time' => $startDateTime->add($interval)->format('H:i:s'),
            ]);
        }

    }
}
