<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Keranjang disimpan di session, bentuknya:
     * ['<menu_id>' => ['qty' => int], ...]
     */
    public function index()
    {
        $cart = session('cart', []);

        $menus = Menu::with('category')
            ->whereIn('id', array_keys($cart))
            ->get()
            ->keyBy('id');

        $items = collect($cart)->map(function ($row, $menuId) use ($menus) {
            $menu = $menus->get($menuId);

            if (! $menu) {
                return null;
            }

            return [
                'menu' => $menu,
                'qty' => $row['qty'],
                'subtotal' => $menu->price * $row['qty'],
            ];
        })->filter()->values();

        $total = $items->sum('subtotal');

        return view('cart.index', compact('items', 'total'));
    }

    public function add(Request $request, Menu $menu)
    {
        $qty = max(1, (int) $request->input('qty', 1));

        $cart = session('cart', []);
        $cart[$menu->id]['qty'] = ($cart[$menu->id]['qty'] ?? 0) + $qty;
        session(['cart' => $cart]);

        return back()->with('success', "{$menu->name} ditambahkan ke keranjang.");
    }

    public function update(Request $request, Menu $menu)
    {
        $qty = (int) $request->input('qty', 1);
        $cart = session('cart', []);

        if ($qty <= 0) {
            unset($cart[$menu->id]);
        } else {
            $cart[$menu->id]['qty'] = $qty;
        }

        session(['cart' => $cart]);

        return back()->with('success', 'Keranjang diperbarui.');
    }

    public function remove(Menu $menu)
    {
        $cart = session('cart', []);
        unset($cart[$menu->id]);
        session(['cart' => $cart]);

        return back()->with('success', 'Item dihapus dari keranjang.');
    }
}
