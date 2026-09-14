<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::withCount('customers')->orderBy('name')->paginate(15);

        return view('admin.cities.index', compact('cities'));
    }

    public function create()
    {
        return view('admin.cities.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:cities,name'],
        ]);

        City::create($data);

        return redirect()->route('admin.cities.index')->with('success', 'Kota ditambahkan.');
    }

    public function edit(City $city)
    {
        return view('admin.cities.edit', compact('city'));
    }

    public function update(Request $request, City $city)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:cities,name,' . $city->id],
        ]);

        $city->update($data);

        return redirect()->route('admin.cities.index')->with('success', 'Kota diperbarui.');
    }

    public function destroy(City $city)
    {
        if ($city->customers()->exists()) {
            return back()->with('error', 'Tidak bisa hapus: masih ada pelanggan dari kota ini.');
        }

        $city->delete();

        return back()->with('success', 'Kota dihapus.');
    }
}
