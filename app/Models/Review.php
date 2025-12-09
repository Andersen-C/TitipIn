<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function reviewer() {
        return $this->belongsTo(User::class, 'titiper_id');
    }

    public function reviewedUser() {
        return $this->belongsTo(User::class, 'runner_id');
    }
}
