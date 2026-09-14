<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderDashboardController extends Controller
{
    /**
     * Dashboard Admin: daftar order lengkap dengan relasi 3 tingkat.
     *
     * JEBAKAN N+1:
     * Kalau kita hanya menulis Order::paginate(15) lalu mengakses
     * $order->customer->city->name, $order->orderItems, dst di dalam view,
     * setiap baris akan memicu query baru ke DB (Lazy Loading).
     * Untuk 15 order x (customer+city+paymentMethod+courier+beberapa orderItem
     * x (menu+category)) itu bisa jadi RATUSAN query per halaman.
     *
     * SOLUSI: Nested Eager Loading dengan notasi titik (.)
     * Ini memuat semua relasi (termasuk relasi-di-dalam-relasi) hanya
     * dengan beberapa query saja, TIDAK PEDULI berapa banyak order/item-nya.
     */
    public function index()
    {
        $orders = Order::with([
            'customer.city',          // order -> customer -> city (2 tingkat)
            'paymentMethod',          // order -> paymentMethod
            'courier',                // order -> courier
            'orderItems.menu.category', // order -> orderItems -> menu -> category (3 tingkat)
        ])
            ->latest()
            ->paginate(15);

        return view('orders.dashboard', compact('orders'));
    }
}
