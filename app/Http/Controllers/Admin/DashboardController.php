<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Courier;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;

class DashboardController extends Controller
{
    /**
     * Dashboard Admin: daftar order lengkap dengan relasi 3 tingkat + monitoring.
     *
     * JEBAKAN N+1:
     * Kalau kita hanya menulis Order::paginate(15) lalu mengakses
     * $order->customer->city->name, $order->orderItems, dst di dalam view,
     * setiap baris akan memicu query baru ke DB (Lazy Loading).
     *
     * SOLUSI: Nested Eager Loading dengan notasi titik (.)
     */
    public function index()
    {
        $orders = Order::with([
            'customer.city',
            'paymentMethod',
            'courier',
            'orderItems.menu.category',
        ])
            ->latest()
            ->paginate(15);

        $stats = [
            'total_orders' => Order::count(),
            'total_customers' => Customer::count(),
            'total_couriers' => Courier::count(),
            'total_revenue' => OrderItem::sum('subtotal'),
        ];

        return view('admin.dashboard.index', compact('orders', 'stats'));
    }
}
