<?php

namespace App\Models;

use App\Enums\UserRolesEnum;
use App\Jobs\SendAppointmentConfirmationMailJob;
use App\Jobs\SendNewServicePromoMailJob;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'appointment_code',
        'cart_id',
        'user_id',
        'service_id',
        'date',
        'time_slot_id',
        'start_time',
        'end_time',
        'location_id',
        'total',
        'status',

    ];

    protected $casts = [
        'start_time' => 'string',  // as string cuz we get it from the time slot
        'end_time' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function timeSlot()
    {
        return $this->belongsTo(TimeSlot::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }



    static function boot()
    {
        parent::boot();

        static::creating(function ($appointment) {
            // a readable unique code for the appointment, including the id in the code
            $appointment->appointment_code = 'APP-'.  ($appointment->count() + 1) ;

        });
    }


}
