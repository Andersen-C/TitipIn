<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatusLogs;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = Menu::all();

        // 30 order belum ada runner
        Order::factory()->count(30)->create()->each(function ($order) use ($menus) {

        $items = OrderItem::factory()->count(rand(1, 4))->make([
            'order_id' => $order->id,
            'menu_id' => $menus->random()->id,
        ]);

        $order->orderItems()->saveMany($items);

        $order->calculateTotalPrice();

        OrderStatusLogs::factory()->create([
            'order_id' => $order->id,
            'status' => 'waiting_runner',
        ]);

        });

        // 10 completed order (harus assign runner & item)
        Order::factory()->completed()->count(10)->create()->each(function ($order) use ($menus) {

        // assign runner kalau belum ada
        if (!$order->runner_id) {
            $order->update([
                'runner_id' => \App\Models\User::where('mode', 'runner')->inRandomOrder()->first()->id
            ]);
        }

        // Tambahkan item untuk completed orders
        $items = OrderItem::factory()->count(rand(1, 4))->make([
            'order_id' => $order->id,
            'menu_id' => $menus->random()->id,
        ]);

        $order->orderItems()->saveMany($items);

        $order->calculateTotalPrice();

        // Tambahkan log completed
        OrderStatusLogs::factory()->create([
            'order_id' => $order->id,
            'status' => 'completed',
        ]);

        });
    }
}