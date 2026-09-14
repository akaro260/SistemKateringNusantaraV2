@extends('layouts.app')
@section('title', 'Keranjang')

@section('content')
    <h1 class="text-2xl font-bold text-brand-900 mb-6">Keranjang</h1>

    @if ($items->isEmpty())
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-8 text-center text-gray-400">
            Keranjang masih kosong.
            <div class="mt-3">
                <a href="{{ route('menu.index') }}" class="text-brand-700 font-medium hover:underline">Lihat menu →</a>
            </div>
        </div>
    @else
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-brand-900 text-white text-left">
                        <th class="px-4 py-3 font-medium">Menu</th>
                        <th class="px-4 py-3 font-medium">Harga</th>
                        <th class="px-4 py-3 font-medium">Qty</th>
                        <th class="px-4 py-3 font-medium">Subtotal</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($items as $row)
                        <tr>
                            <td class="px-4 py-3">
                                <p class="font-medium text-gray-900">{{ $row['menu']->name }}</p>
                                <p class="text-xs text-gray-400 italic">{{ $row['menu']->category->name }}</p>
                            </td>
                            <td class="px-4 py-3 text-gray-600">Rp{{ number_format($row['menu']->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">
                                <form method="POST" action="{{ route('cart.update', $row['menu']) }}" class="flex items-center gap-1">
                                    @csrf @method('PATCH')
                                    <input type="number" name="qty" value="{{ $row['qty'] }}" min="0"
                                           class="w-16 rounded-lg border-gray-300 text-sm focus:border-brand-500 focus:ring-brand-500">
                                    <button class="text-xs text-brand-700 hover:underline">Update</button>
                                </form>
                            </td>
                            <td class="px-4 py-3 font-medium text-gray-900">Rp{{ number_format($row['subtotal'], 0, ',', '.') }}</td>
                            <td class="px-4 py-3">
                                <form method="POST" action="{{ route('cart.remove', $row['menu']) }}">
                                    @csrf @method('DELETE')
                                    <button class="text-xs text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex items-center justify-between mt-6">
            <p class="text-lg font-bold text-brand-900">Total: Rp{{ number_format($total, 0, ',', '.') }}</p>
            <a href="{{ route('checkout.show') }}"
               class="bg-brand-600 hover:bg-brand-700 text-white font-medium px-5 py-2.5 rounded-lg transition">
                Lanjut ke Checkout →
            </a>
        </div>
    @endif
@endsection
