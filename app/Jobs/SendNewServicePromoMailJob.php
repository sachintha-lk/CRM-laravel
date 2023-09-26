<?php

namespace App\Jobs;

use App\Http\Controllers\DisplayDeal;
use App\Models\Service;
use App\Models\User;
use App\Notifications\NewServiceReleasedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendNewServicePromoMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public User $customer,
        public Service $service
    )
    {
    }

    public function handle(): void
    {
        // send email to all customers
        $notification = new NewServiceReleasedNotification(
            $this->service
        );

        Notification::send($this->customer, $notification);
    }
}
