<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'is_paid',
        'is_cancelled',
        'is_abandoned',
        'total',
    ];


    protected $with = ['services'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class)->withPivot('service_start_date_time', 'service_end_date_time');
    }

}
