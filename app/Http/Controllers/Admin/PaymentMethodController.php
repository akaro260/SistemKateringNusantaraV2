<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentMethods = PaymentMethod::withCount('orders')->orderBy('name')->paginate(15);

        return view('admin.payment-methods.index', compact('paymentMethods'));
    }

    public function create()
    {
        return view('admin.payment-methods.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:payment_methods,name'],
        ]);

        PaymentMethod::create($data);

        return redirect()->route('admin.payment-methods.index')->with('success', 'Metode pembayaran ditambahkan.');
    }

    public function edit(PaymentMethod $paymentMethod)
    {
        return view('admin.payment-methods.edit', compact('paymentMethod'));
    }

    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:payment_methods,name,' . $paymentMethod->id],
        ]);

        $paymentMethod->update($data);

        return redirect()->route('admin.payment-methods.index')->with('success', 'Metode pembayaran diperbarui.');
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        if ($paymentMethod->orders()->exists()) {
            return back()->with('error', 'Tidak bisa hapus: masih dipakai oleh order.');
        }

        $paymentMethod->delete();

        return back()->with('success', 'Metode pembayaran dihapus.');
    }
}
