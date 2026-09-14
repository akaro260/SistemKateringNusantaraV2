<?php

namespace App\Http\Controllers;

use App\Models\Category;

class MenuBrowseController extends Controller
{
    /**
     * Halaman customer untuk melihat & memesan menu.
     * Menu dikelompokkan per kategori, sekali query pakai eager loading
     * (Category::with('menus')) supaya tidak N+1 walau kategorinya banyak.
     */
    public function index()
    {
        $categories = Category::with(['menus' => function ($query) {
            $query->orderBy('name');
        }])->orderBy('name')->get();

        $cart = session('cart', []);

        return view('menu.index', compact('categories', 'cart'));
    }
}
