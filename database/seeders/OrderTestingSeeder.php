<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Location;
use App\Models\Review;
use Illuminate\Support\Facades\Hash;

class OrderTestingSeeder extends Seeder
{
    public function run()
    {
        $titiper = User::updateOrCreate(
            ['email' => 'theo@gmail.com'],
            [
                'name' => 'Theo (Titiper)',
                'password' => 'titiper1',
                'role' => 'user',
                'mode' => 'titiper',
                'phone_number' => '0812123456789'
            ]
        );

        $runnerA = User::firstOrCreate(
            ['email' => 'kevin@gmail.com'],
            [
                'name' => 'Kevin (Runner)',
                'password' => 'runner1',
                'role' => 'user',
                'mode' => 'runner',
                'phone_number' => '089876543111'
            ]
        );

        $runnerB = User::firstOrCreate(
            ['email' => 'ander@gmail.com'],
            [
                'name' => 'Ander (Runner)',
                'password' => 'runner2',
                'role' => 'user',
                'mode' => 'runner',
                'phone_number' => '089876543222'
            ]
        );

        $location = Location::firstOrCreate(
            ['name' => 'Kantin Utama'],
            ['floor_number' => 1]
        );

        $category = Category::firstOrCreate(
            ['name' => 'Makanan Berat'],
            ['group' => 'Makanan']
        );

        $menu = Menu::firstOrCreate(
            ['name' => 'Nasi Goreng Spesial Test'],
            [
                'location_id' => $location->id,
                'category_id' => $category->id,
                'price'       => 15000,
                'description' => 'Menu untuk testing order',
                'image'       => null,
                'availability' => true
            ]
        );

        $this->createOrder($titiper, null, $location, $menu, 'waiting_runner', 'Tolong cariin runner dong', 0);

        $this->createOrder($titiper, $runnerA, $location, $menu, 'on_delivery', 'Lagi dijalan nih', 10);

        $this->createOrder($titiper, null, $location, $menu, 'cancelled', 'Gajadi laper', 60);

        $orderA1 = $this->createOrder($titiper, $runnerA, $location, $menu, 'completed', 'Pesanan Asep 1 (Reviewed)', 120);
        Review::create([
            'order_id'   => $orderA1->id,
            'titiper_id' => $titiper->id,
            'runner_id'  => $runnerA->id,
            'rating'     => 5,
            'comment'    => 'Asep mantap kerjanya!',
        ]);
        $runnerA->update_rating();

        $this->createOrder($titiper, $runnerA, $location, $menu, 'completed', 'Pesanan Asep 2 (Belum Review)', 100);

        $orderB1 = $this->createOrder($titiper, $runnerB, $location, $menu, 'completed', 'Pesanan Udin 1 (Reviewed)', 200);
        Review::create([
            'order_id'   => $orderB1->id,
            'titiper_id' => $titiper->id,
            'runner_id'  => $runnerB->id,
            'rating'     => 4,
            'comment'    => 'Udin lumayan lah',
        ]);
        $runnerB->update_rating();

        $this->createOrder($titiper, $runnerB, $location, $menu, 'completed', 'Pesanan Udin 2 (Belum Review)', 90);
    }

    private function createOrder($user, $runner, $location, $menu, $status, $note, $minutesAgo)
    {
        $order = Order::create([
            'titiper_id'           => $user->id,
            'runner_id'            => $runner ? $runner->id : null,
            'pickup_location_id'   => $location->id,
            'delivery_location_id' => $location->id,
            'status'               => $status,
            'subtotal'             => 15000,
            'service_fee'          => 3000,
            'total_price'          => 18000,
            'notes'                => $note,
            'payment_method'       => 'cash',
            'created_at'           => now()->subMinutes($minutesAgo + 30),
            'accepted_at'          => $runner ? now()->subMinutes($minutesAgo + 20) : null,
            'completed_at'         => $status === 'completed' ? now()->subMinutes($minutesAgo) : null,
            'cancelled_at'         => $status === 'cancelled' ? now()->subMinutes($minutesAgo) : null,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'menu_id'  => $menu->id,
            'quantity' => 1,
            'price'    => 15000,
        ]);

        return $order;
    }
}
