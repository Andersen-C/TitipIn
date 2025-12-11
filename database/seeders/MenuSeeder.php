<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Location;
use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Locale;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create();

        $menus = [
        // Makanan Berat
            ['name' => 'Nasi Goreng Spesial', 'price' => 15000, 'category' => 'Makanan Berat', 'description' => 'Nasi goreng dengan telur, ayam, dan sayuran'],
            ['name' => 'Mie Goreng Jawa', 'price' => 12000, 'category' => 'Mie', 'description' => 'Mie goreng khas Jawa dengan bumbu rahasia'],
            ['name' => 'Ayam Geprek', 'price' => 18000, 'category' => 'Ayam & Bebek', 'description' => 'Ayam goreng crispy dengan sambal geprek'],
            ['name' => 'Nasi Padang', 'price' => 20000, 'category' => 'Nasi', 'description' => 'Nasi dengan lauk khas Padang'],
            ['name' => 'Soto Ayam', 'price' => 14000, 'category' => 'Makanan Berat', 'description' => 'Soto ayam kuning dengan nasi'],
            ['name' => 'Bakso Sapi', 'price' => 13000, 'category' => 'Bakso', 'description' => 'Bakso sapi dengan mie'],
            
            // Makanan Ringan
            ['name' => 'Pisang Goreng', 'price' => 5000, 'category' => 'Makanan Ringan', 'description' => 'Pisang goreng crispy'],
            ['name' => 'Roti Bakar Coklat', 'price' => 8000, 'category' => 'Pastry', 'description' => 'Roti bakar dengan selai coklat'],
            ['name' => 'Sandwich Tuna', 'price' => 12000, 'category' => 'Makanan Ringan', 'description' => 'Sandwich dengan isian tuna'],
            
            // Minuman
            ['name' => 'Es Teh Manis', 'price' => 3000, 'category' => 'Minuman Dingin', 'description' => 'Es teh manis segar'],
            ['name' => 'Es Jeruk', 'price' => 5000, 'category' => 'Minuman Dingin', 'description' => 'Es jeruk peras segar'],
            ['name' => 'Kopi Hitam', 'price' => 8000, 'category' => 'Minuman Panas', 'description' => 'Kopi hitam original'],
            ['name' => 'Cappuccino', 'price' => 15000, 'category' => 'Minuman Panas', 'description' => 'Cappuccino dengan foam sempurna'],
            ['name' => 'Latte', 'price' => 16000, 'category' => 'Minuman Panas', 'description' => 'Latte dengan susu premium'],
            ['name' => 'Jus Alpukat', 'price' => 12000, 'category' => 'Minuman Dingin', 'description' => 'Jus alpukat segar'],
            ['name' => 'Teh Hangat', 'price' => 3000, 'category' => 'Minuman Panas', 'description' => 'Teh hangat manis'],
            
            // Dessert
            ['name' => 'Es Krim Vanilla', 'price' => 10000, 'category' => 'Dessert', 'description' => 'Es krim vanilla premium'],
            ['name' => 'Brownies', 'price' => 8000, 'category' => 'Dessert', 'description' => 'Brownies coklat lembut'],
        ];

        $location = Location::where('name', 'NOT LIKE', '%Kelas%')->get();

        foreach($menus as $menu) {
            $category = Category::where('name', $menu['category'])->first();
            $loc = $location->random();

            Menu::create([
                'location_id' => $loc->id,
                'category_id' => $category->id,
                'name' => $menu['name'],
                'price' => $menu['price'],
                'description' => $menu['description'],
                'availability' => true,
                'image' => $faker->imageUrl(640, 480, 'animals', true)
            ]);
        }
    }
}
