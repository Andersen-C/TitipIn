<?php

namespace Database\Factories;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $orders = Order::inRandomOrder()->first();
        $menus = Menu::inRandomOrder()->first();
        return [
            'order_id' => $orders ? $orders->id : Order::factory(),
            'menu_id' => $menus? $menus->id : Menu::factory(),
            'quantity' => fake()->numberBetween(1, 3),
            'price' => fake()->randomFloat(2, 2000, 20000),
        ];
    }
}
