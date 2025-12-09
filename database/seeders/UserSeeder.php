<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@campus.ac.id',
            'role' => 'admin',
            'mode' => 'titiper',
            'phone_number' => '081234567890',
            'password' => Hash::make('password1234'),
            'email_verified_at' => now(),
        ]);
        
        User::create([
            'name' => 'Spongebob Runner',
            'email' => 'spongebob@campus.ac.id',
            'role' => 'user',
            'mode' => 'runner',
            'phone_number' => '081234567891',
            'password' => Hash::make('password1235'),
            'avg_rating' => 4.5,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Patrick Runner',
            'email' => 'patrick@campus.ac.id',
            'role' => 'user',
            'mode' => 'runner',
            'phone_number' => '081234567892',
            'password' => Hash::make('password1236'),
            'avg_rating' => 4.8,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Mark Titiper',
            'email' => 'mark@campus.ac.id',
            'role' => 'user',
            'mode' => 'titiper',
            'phone_number' => '081234567893',
            'password' => Hash::make('password1237'),
            'avg_rating' => 4.2,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'John Titiper',
            'email' => 'john@campus.ac.id',
            'role' => 'user',
            'mode' => 'titiper',
            'phone_number' => '081234567894',
            'password' => Hash::make('password1238'),
            'avg_rating' => 4.7,
            'email_verified_at' => now(),
        ]);


        User::factory()->count(20)->create();
    }
}
