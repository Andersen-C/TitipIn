<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate([
            'name' => 'Admin',
            'email' => 'admin@campus.ac.id',
            'role' => 'admin',
            'mode' => 'titiper',
            'phone_number' => '081234567890',
            'password' => Hash::make('password1234'),
            'email_verified_at' => now(),
        ]);
    }
}
