<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun admin utama untuk login ke dasbor
        User::factory()->create([
            'name' => 'Admin Rasa Nusantara',
            'email' => 'admin@rasanusantara.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 1 akun customer contoh yang sudah pasti bisa dipakai untuk login & pesan
        $demoUser = User::factory()->create([
            'name' => 'Budi Santoso',
            'email' => 'customer@rasanusantara.test',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        \App\Models\Customer::create([
            'user_id' => $demoUser->id,
            'name' => $demoUser->name,
            'phone' => '081234567890',
            'city_id' => \App\Models\City::inRandomOrder()->value('id'),
        ]);
    }
}
