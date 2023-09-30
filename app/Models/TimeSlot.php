<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    protected $fillable = [
        'start-time',
        'end-time',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }



}
