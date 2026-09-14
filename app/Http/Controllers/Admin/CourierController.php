<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Courier;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    public function index()
    {
        $couriers = Courier::withCount('orders')->orderBy('name')->paginate(15);

        return view('admin.couriers.index', compact('couriers'));
    }

    public function create()
    {
        return view('admin.couriers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
        ]);

        Courier::create($data);

        return redirect()->route('admin.couriers.index')->with('success', 'Kurir ditambahkan.');
    }

    public function edit(Courier $courier)
    {
        return view('admin.couriers.edit', compact('courier'));
    }

    public function update(Request $request, Courier $courier)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
        ]);

        $courier->update($data);

        return redirect()->route('admin.couriers.index')->with('success', 'Kurir diperbarui.');
    }

    public function destroy(Courier $courier)
    {
        if ($courier->orders()->exists()) {
            return back()->with('error', 'Tidak bisa hapus: masih dipakai oleh order.');
        }

        $courier->delete();

        return back()->with('success', 'Kurir dihapus.');
    }
}
