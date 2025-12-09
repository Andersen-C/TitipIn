<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderStatusLogs>
 */
class OrderStatusLogsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $order = Order::inRandomOrder()->first();
        return [
            'order_id' => $order ? $order->id : Order::factory(),
            'status' => fake()->randomElement([
                'waiting_runner', 'accepted', 'picking_up', 'delivering', 'completed'
            ]),
            'notes' => fake()->sentence(3),
        ];
    }
}
