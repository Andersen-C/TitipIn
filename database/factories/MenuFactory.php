<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $location = Location::where('name', 'NOT LIKE', '%Kelas%')->inRandomOrder()->first();
        return [
            'location_id' => $location->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'name' => fake()->words(2, true),
            'price' => $this->faker->randomFloat(2, 5000, 50000),
            'image_url' => fake()->imageUrl(300, 300, 'food'),
            'availability' => true,
        ];
    }
}
