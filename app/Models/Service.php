<?php

namespace App\Models;

use App\Enums\UserRolesEnum;
use App\Jobs\SendNewServicePromoMailJob;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Service extends Model
{

//    protected $hidden = [
//        'id',
//        'category_id',
//        'is_hidden',
//        'created_at',
//        'updated_at',
//    ];
    protected $fillable = [
//        'uuid',
        'name',
        'slug',
        'description',
        'image',
        'price',
        'notes',
        'allergens',
        'benefits',
        'aftercare_tips',
        'cautions',
//        'duration_minutes',
        'category_id',
        'is_hidden',
    ];

    protected $casts = [
        'is_hidden' => 'boolean',
        'start_time' => 'time',
        'end_time' => 'time',
    ];

    // is visible
    public function scopeIsVisible($query)
    {
        return $query->where('is_hidden', false);
    }
    public function scopeOrderByPrice($query, $order)
    {
        if ($order === 'PriceLowToHigh') {
            return $query->orderBy('price', 'asc');
        } elseif ($order === 'PriceHighToLow') {
            return $query->orderBy('price', 'desc');
        }

        // default is PriceLowToHigh
        return $query->orderBy('price', 'asc');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function hits()
    {
        return $this->hasMany(ServiceHit::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function locations()
    {
        return $this->belongsToMany(Location::class, 'cart_service')
            ->withPivot('location_id');
    }

    protected static function booted()
    {
//        static::creating(function ($service) {
//            $service->uuid = (string) \Illuminate\Support\Str::uuid();
//        });

        static::created(function ($service) {

            // if service is hidden, don't send email
            if ($service->is_hidden) {
                return;
            }

            $customers = User::where('role_id', UserRolesEnum::Customer->value)->where('status', true)->get();

            foreach ($customers as $customer) {

                dispatch(new SendNewServicePromoMailJob($customer, $service));
            }
        });
    }



}
