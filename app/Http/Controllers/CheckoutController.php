<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function show(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong.');
        }

        $menus = Menu::with('category')->whereIn('id', array_keys($cart))->get()->keyBy('id');

        $items = collect($cart)->map(function ($row, $menuId) use ($menus) {
            $menu = $menus->get($menuId);

            return $menu ? [
                'menu' => $menu,
                'qty' => $row['qty'],
                'subtotal' => $menu->price * $row['qty'],
            ] : null;
        })->filter()->values();

        $total = $items->sum('subtotal');
        $couriers = Courier::orderBy('name')->get();
        $paymentMethods = PaymentMethod::orderBy('name')->get();

        return view('checkout.show', compact('items', 'total', 'couriers', 'paymentMethods'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'courier_id' => ['required', 'exists:couriers,id'],
            'payment_method_id' => ['required', 'exists:payment_methods,id'],
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong.');
        }

        $customer = $request->user()->customer;

        if (! $customer) {
            abort(403, 'Akun ini tidak memiliki profil pelanggan.');
        }

        $menus = Menu::whereIn('id', array_keys($cart))->get()->keyBy('id');

        $order = DB::transaction(function () use ($cart, $menus, $customer, $data) {
            $order = Order::create([
                'customer_id' => $customer->id,
                'courier_id' => $data['courier_id'],
                'payment_method_id' => $data['payment_method_id'],
                'status' => 'pending',
            ]);

            foreach ($cart as $menuId => $row) {
                $menu = $menus->get($menuId);

                if (! $menu) {
                    continue;
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menu->id,
                    'qty' => $row['qty'],
                    'subtotal' => $menu->price * $row['qty'],
                ]);
            }

            return $order;
        });

        session()->forget('cart');

        return redirect()->route('orders.mine')->with('success', "Pesanan #{$order->id} berhasil dibuat!");
    }
}
