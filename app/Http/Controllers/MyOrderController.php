<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyOrderController extends Controller
{
    /**
     * Riwayat pesanan milik customer yang sedang login.
     * Tetap pakai nested eager loading walau cuma order milik 1 customer.
     */
    public function index(Request $request)
    {
        $customer = $request->user()->customer;

        $orders = $customer
            ? $customer->orders()
                ->with(['courier', 'paymentMethod', 'orderItems.menu.category'])
                ->latest()
                ->paginate(10)
            : collect();

        return view('my-orders.index', compact('orders'));
    }
}
