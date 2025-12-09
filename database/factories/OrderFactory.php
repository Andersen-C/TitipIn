<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Order::class;

    public function definition(): array
    {

        $pickup_location = Location::where('name', 'NOT LIKE', '%Kelas%')->inRandomOrder()->first();
        $delivery_location = Location::where('name', 'LIKE', '%Kelas%')->inRandomOrder()->first();
        return [
            'titiper_id' => User::factory()->state(['mode' => 'titiper']),
            'runner_id' => null,
            'pickup_location_id' => $pickup_location ? $pickup_location->id : Location::factory(),
            'delivery_location_id' => $delivery_location ? $delivery_location->id : Location::factory(),
            'subtotal' => 0,
            'service_fee' => 3000,
            'total_price' => 0,
            'status' => 'waiting_runner',
        ];
    }

    public function completed()
    {
        return $this->state(function () {
            return [
                'status' => 'completed',
                'runner_id' => User::factory()->state(['mode' => 'runner']),
                'accepted_at' => now()->subMinutes(30),
                'completed_at' => now(),
            ];
        });
    }
}
