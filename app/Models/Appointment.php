<?php

namespace App\Models;

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
        'total',
        'status',

    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    static function boot()
    {
        parent::boot();

        static::creating(function ($appointment) {
            // a readable unique code for the appointment, including the id in the code
            $appointment->appointment_code = 'APP-'.  ($appointment->count() + 1) ;


        });
    }


}
