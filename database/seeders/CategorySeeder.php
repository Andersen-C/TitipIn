<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Makanan Ringan',
            'Makanan Berat',
            'Minuman Dingin',
            'Minuman Panas',
            'Dessert',
            'Ayam & Bebek',
            'Nasi',
            'Mie',
            'Bakso',
            'Pastry'
        ];

        foreach($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
