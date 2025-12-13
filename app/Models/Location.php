<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'floor_number' => 'integer'
    ];

    public function menus() {
        return $this->hasMany(Menu::class, 'location_id');
    }

    public function pickupOrders() {
        return $this->hasMany(Order::class, 'pickup_location_id');
    }

    public function deliveryOrders() {
        return $this->hasMany(Order::class, 'delivery_location_id');
    }

    public function getFormattedFloorAttribute()
    {
        $floor = $this->floor_number;

        if ($floor == 0) {
            return 'Basement'; 
        }

        return 'L' . $floor; 
    }
}
