<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{   
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'service_fee' => 'decimal:2',
        'total_price' => 'decimal:2',
        'accepted_at' => 'datetime',
        'completed_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    public function titiper() {
        return $this->belongsTo(User::class, 'titiper_id');
    }

    public function runner() {
        return $this->belongsTo(User::class, 'runner_id');
    }

    public function pickupLocation() {
        return $this->belongsTo(Location::class, 'pickup_location_id');
    }

    public function deliveryLocation() {
        return $this->belongsTo(Location::class, 'delivery_location_id');
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function orderStatusLogs() {
        return $this->hasMany(OrderStatusLogs::class, 'order_id');
    }

    public function review() {
        return $this->hasOne(Review::class);
    }

    public function hasReview() {
        return $this->review()->exists();
    }

    public function cancelable() {
        return in_array($this->status, ['waiting_runner']);
    }

    public function calculateTotalPrice() {
        $this->subtotal = $this->orderItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        $this->total_price = $this->subtotal + $this->service_fee;
        $this->save();
    }
}
