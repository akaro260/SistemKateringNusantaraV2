<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentMethodFactory extends Factory
{
    public function definition(): array
    {
        static $methods = ['Transfer Bank', 'QRIS', 'Cash on Delivery (COD)'];

        return [
            'name' => fake()->unique()->randomElement($methods),
        ];
    }
}
