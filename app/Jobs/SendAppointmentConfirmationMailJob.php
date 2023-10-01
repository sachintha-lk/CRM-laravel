<?php

namespace App\Jobs;

use App\Http\Controllers\DisplayDeal;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use App\Notifications\AppointmentConfirmationNotification;
use App\Notifications\NewServiceReleasedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendAppointmentConfirmationMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public User $customer,
        public Appointment $appointment
    )
    {
    }

    public function handle(): void
    {

        $notification = new AppointmentConfirmationNotification(
            $this->appointment
        );

        Notification::send($this->customer, $notification);
    }
}
