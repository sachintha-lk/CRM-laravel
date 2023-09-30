<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceHit extends Model
{
    /**
     * @var \Illuminate\Support\Carbon|mixed
     */
    public mixed $hit_time;
    protected $fillable = [
        'service_id',
        'hit_time',
        'analytic_data_type',
        'user_id',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
