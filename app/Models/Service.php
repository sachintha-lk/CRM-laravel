<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Service extends Model
{

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'is_hidden',
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

}
