<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\City;
use App\Models\Courier;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Urutan seeding SANGAT PENTING karena foreign key:
     * 1. Master data tanpa relasi (cities, categories, payment_methods, couriers)
     * 2. Data yang bergantung pada master data (customers -> cities, menus -> categories)
     * 3. Transaksi utama (orders -> customers, payment_methods, couriers)
     * 4. Detail transaksi (order_items -> orders, menus)
     */
    public function run(): void
    {
        $this->command->info('1/8 Seeding 50 Cities...');
        City::factory(50)->create();

        $this->command->info('2/8 Seeding Users (admin & demo customer)...');
        $this->call(UserSeeder::class);

        $this->command->info('3/8 Seeding 10 Categories...');
        Category::factory(10)->create();

        $this->command->info('4/8 Seeding 3 Payment Methods...');
        PaymentMethod::factory(3)->create();

        $this->command->info('5/8 Seeding 10 Couriers...');
        Courier::factory(10)->create();

        $this->command->info('6/8 Seeding 150 Menus...');
        Menu::factory(150)->create();

        $this->command->info('7/8 Seeding 200 Customers...');
        Customer::factory(200)->create();

        $this->command->info('8/8 Seeding 150 Orders + 3-5 OrderItems each...');

        // Ambil ID master data sekali saja (hindari query berulang di dalam loop)
        $customerIds = Customer::pluck('id')->all();
        $paymentMethodIds = PaymentMethod::pluck('id')->all();
        $courierIds = Courier::pluck('id')->all();
        $menus = Menu::all(['id', 'price']);
        $statuses = ['pending', 'diproses', 'dikirim', 'selesai', 'dibatalkan'];

        for ($i = 0; $i < 150; $i++) {
            $order = Order::create([
                'customer_id' => fake()->randomElement($customerIds),
                'payment_method_id' => fake()->randomElement($paymentMethodIds),
                'courier_id' => fake()->randomElement($courierIds),
                'status' => fake()->randomElement($statuses),
            ]);

            // Perulangan: setiap order mendapat 3-5 item pesanan acak
            $itemCount = rand(3, 5);
            for ($j = 0; $j < $itemCount; $j++) {
                $menu = $menus->random();
                $qty = rand(1, 5);

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menu->id,
                    'qty' => $qty,
                    'subtotal' => $menu->price * $qty,
                ]);
            }
        }

        $this->command->info('Seeding selesai! 50 cities, 10 categories, 3 payment methods, 10 couriers, 150 menus, 200 customers, 150 orders + order items.');
    }
}
