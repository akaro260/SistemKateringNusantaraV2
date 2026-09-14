@extends('layouts.app')
@section('title', 'Menu')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-brand-900">Menu Katering</h1>
            <p class="text-sm text-gray-500">Pilih menu favoritmu, lalu lanjut ke keranjang.</p>
        </div>
        <a href="{{ route('cart.index') }}"
           class="bg-brand-600 hover:bg-brand-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
            Lihat Keranjang ({{ collect($cart)->sum('qty') }})
        </a>
    </div>

    @foreach ($categories as $category)
        @if ($category->menus->isNotEmpty())
            <div class="mb-8">
                <h2 class="text-sm font-semibold uppercase tracking-wide text-brand-700 mb-3">{{ $category->name }}</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($category->menus as $menu)
                        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 flex flex-col">
                            <p class="font-medium text-gray-900">{{ $menu->name }}</p>
                            <p class="text-brand-700 font-semibold mt-1">Rp{{ number_format($menu->price, 0, ',', '.') }}</p>

                            <form method="POST" action="{{ route('cart.add', $menu) }}" class="mt-3 flex items-center gap-2">
                                @csrf
                                <input type="number" name="qty" value="1" min="1"
                                       class="w-16 rounded-lg border-gray-300 text-sm focus:border-brand-500 focus:ring-brand-500">
                                <button type="submit"
                                        class="flex-1 bg-brand-50 hover:bg-brand-100 text-brand-700 text-sm font-medium py-2 rounded-lg transition">
                                    + Keranjang
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach
@endsection
