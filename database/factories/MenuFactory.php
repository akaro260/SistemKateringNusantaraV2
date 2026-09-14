<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => ucwords(fake()->unique()->words(3, true)),
            'price' => fake()->numberBetween(8, 75) * 1000,
            'category_id' => Category::inRandomOrder()->value('id'),
        ];
    }
}
