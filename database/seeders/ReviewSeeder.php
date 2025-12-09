<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::all()->each(function ($order) {

            if ($order->status !== 'completed') return;

            Review::factory()->create([
                'order_id'   => $order->id,
                'titiper_id' => $order->titiper_id,
                'runner_id'  => $order->runner_id,
            ]);

            $order->runner->update_rating();
        });
    }
}
