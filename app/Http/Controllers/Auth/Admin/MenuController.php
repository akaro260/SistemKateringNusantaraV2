<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // Eager load category supaya tabel index tidak N+1
        $menus = Menu::with('category')->orderBy('name')->paginate(15);

        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.menus.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        Menu::create($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.menus.edit', compact('menu', 'categories'));
    }

    public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $menu->update($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        if ($menu->orderItems()->exists()) {
            return back()->with('error', 'Tidak bisa hapus: menu ini sudah pernah dipesan.');
        }

        $menu->delete();

        return back()->with('success', 'Menu dihapus.');
    }
}
