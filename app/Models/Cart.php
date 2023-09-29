<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'uuid',
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
        return $this
            ->belongsToMany(Service::class)
            ->with('locations')
            ->withPivot('id','time_slot_id','date', 'start_time', 'end_time', 'location_id' , 'price');

    }



    protected static function booted()
    {
        static::creating(function ($cart) {
            $cart->uuid = \Illuminate\Support\Str::uuid();
        });
    }

}
