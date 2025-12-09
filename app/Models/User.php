<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'mode',
        'phone_number',
        'avg_rating',
        'profile_pic'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'avg_rating' => 'decimal:2'
        ];
    }

    public function titiperOrders() {
        return $this->hasMany(Order::class, 'titiper_id');
    }

    public function runnerOrders() {
        return $this->hasMany(Order::class, 'runner_id');
    }

    public function reviewsGiven() {
        return $this->hasMany(Review::class, 'titiper_id');
    }
    
    public function reviewsGotten() {
        return $this->hasMany(Review::class, 'runner_id');
    }

    public function update_rating() {
        if ($this->mode === 'runner') {
            $avgRating = $this->reviewsGotten()->avg('rating');
            $this->update(['avg_rating' => $avgRating ?? 0]);
        }
    }
}
