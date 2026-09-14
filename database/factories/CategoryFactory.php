<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        // Kategori makanan katering yang realistis
        static $categories = [
            'Pembuka', 'Utama', 'Penutup', 'Minuman', 'Camilan',
            'Nasi & Karbohidrat', 'Sayur', 'Sambal & Pelengkap', 'Sup', 'Aneka Sate',
        ];

        return [
            'name' => fake()->unique()->randomElement($categories),
        ];
    }
}
