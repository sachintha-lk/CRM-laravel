<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Service extends Model
{

    protected $fillable = [
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
        'duration_minutes',
        'category_id',
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function hits()
    {
        return $this->hasMany(ServiceHit::class);
    }


}
