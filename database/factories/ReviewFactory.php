<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Review::class;

    public function definition()
    {
        // ambil 1 order completed yang belum ada review
        $order = Order::where('status', 'completed')
                      ->whereDoesntHave('review')
                      ->inRandomOrder()
                      ->first();

        // fallback jika tidak ada order completed
        if (!$order) {
            $order = Order::factory()->create(['status' => 'completed']);
        }

        return [
            'order_id'    => $order->id,
            'titiper_id'  => $order->titiper_id,
            'runner_id'   => $order->runner_id,
            'rating'      => $this->faker->numberBetween(3, 5),
            'comment'     => $this->faker->sentence(10),
        ];
    }
}