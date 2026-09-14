@extends('layouts.app')
@section('title', 'Pesanan Saya')

@section('content')
    <h1 class="text-2xl font-bold text-brand-900 mb-6">Pesanan Saya</h1>

    @if ($orders->isEmpty())
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-8 text-center text-gray-400">
            Belum ada pesanan.
            <div class="mt-3">
                <a href="{{ route('menu.index') }}" class="text-brand-700 font-medium hover:underline">Mulai pesan →</a>
            </div>
        </div>
    @else
        <div class="space-y-4">
            @foreach ($orders as $order)
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
                    <div class="flex items-center justify-between mb-3">
                        <p class="font-semibold text-brand-900">Pesanan #{{ $order->id }}</p>
                        <span @class([
                            'text-xs font-medium px-2 py-0.5 rounded-full',
                            'bg-yellow-100 text-yellow-700' => $order->status === 'pending',
                            'bg-blue-100 text-blue-700' => $order->status === 'diproses',
                            'bg-indigo-100 text-indigo-700' => $order->status === 'dikirim',
                            'bg-green-100 text-green-700' => $order->status === 'selesai',
                            'bg-red-100 text-red-700' => $order->status === 'dibatalkan',
                        ])>
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <ul class="text-sm text-gray-700 space-y-1 mb-3">
                        @foreach ($order->orderItems as $item)
                            <li>{{ $item->qty }}x {{ $item->menu->name }} <span class="text-xs text-gray-400 italic">({{ $item->menu->category->name }})</span></li>
                        @endforeach
                    </ul>

                    <div class="text-xs text-gray-500 flex flex-wrap gap-x-4 gap-y-1 border-t border-gray-100 pt-3">
                        <span>🛵 {{ $order->courier->name }}</span>
                        <span>💳 {{ $order->paymentMethod->name }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        @if (method_exists($orders, 'links'))
            <div class="mt-6">{{ $orders->links() }}</div>
        @endif
    @endif
@endsection
