@extends('layouts.app')
@section('title', 'Checkout')

@section('content')
    <h1 class="text-2xl font-bold text-brand-900 mb-6">Checkout</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <h2 class="font-semibold text-gray-800 mb-3">Ringkasan Pesanan</h2>
            <ul class="divide-y divide-gray-100">
                @foreach ($items as $row)
                    <li class="py-2.5 flex items-center justify-between text-sm">
                        <div>
                            <p class="font-medium text-gray-900">{{ $row['qty'] }}x {{ $row['menu']->name }}</p>
                            <p class="text-xs text-gray-400 italic">{{ $row['menu']->category->name }}</p>
                        </div>
                        <p class="font-medium text-gray-900">Rp{{ number_format($row['subtotal'], 0, ',', '.') }}</p>
                    </li>
                @endforeach
            </ul>
            <div class="flex items-center justify-between pt-3 mt-1 border-t border-gray-100">
                <p class="font-semibold text-brand-900">Total</p>
                <p class="font-bold text-brand-900">Rp{{ number_format($total, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <h2 class="font-semibold text-gray-800 mb-3">Pengiriman &amp; Pembayaran</h2>

            @if ($errors->any())
                <div class="mb-3 rounded-lg bg-red-100 text-red-700 text-xs px-3 py-2">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('checkout.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kurir</label>
                    <select name="courier_id" required class="w-full rounded-lg border-gray-300 text-sm focus:border-brand-500 focus:ring-brand-500">
                        <option value="">— Pilih kurir —</option>
                        @foreach ($couriers as $courier)
                            <option value="{{ $courier->id }}">{{ $courier->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Metode Pembayaran</label>
                    <select name="payment_method_id" required class="w-full rounded-lg border-gray-300 text-sm focus:border-brand-500 focus:ring-brand-500">
                        <option value="">— Pilih metode —</option>
                        @foreach ($paymentMethods as $method)
                            <option value="{{ $method->id }}">{{ $method->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="w-full bg-brand-600 hover:bg-brand-700 text-white font-medium py-2.5 rounded-lg transition">
                    Buat Pesanan
                </button>
            </form>
        </div>
    </div>
@endsection
