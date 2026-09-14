@extends('layouts.admin')

@section('title', 'Dashboard Pesanan')

@section('content')

{{-- Informasi Pagination --}}
<div class="mb-6 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
    <p class="text-sm text-gray-500">
        Menampilkan {{ $orders->count() }} dari {{ $orders->total() }} pesanan
        (halaman {{ $orders->currentPage() }}/{{ $orders->lastPage() }})
    </p>

    <span class="inline-flex w-fit items-center gap-1.5 rounded-full bg-green-100 px-3 py-1.5 text-xs font-medium text-green-700">
        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
        Nested Eager Loading aktif
    </span>
</div>

{{-- Statistik --}}
<div class="mb-8 grid grid-cols-2 gap-4 lg:grid-cols-4">

    {{-- Total Order --}}
    <div class="rounded-xl border border-gray-100 bg-white p-4 shadow-sm">
        <p class="text-xs text-gray-500">
            Total Order
        </p>

        <p class="mt-1 text-2xl font-bold text-brand-900">
            {{ number_format($stats['total_orders']) }}
        </p>
    </div>

    {{-- Total Pelanggan --}}
    <div class="rounded-xl border border-gray-100 bg-white p-4 shadow-sm">
        <p class="text-xs text-gray-500">
            Total Pelanggan
        </p>

        <p class="mt-1 text-2xl font-bold text-brand-900">
            {{ number_format($stats['total_customers']) }}
        </p>
    </div>

    {{-- Total Kurir --}}
    <div class="rounded-xl border border-gray-100 bg-white p-4 shadow-sm">
        <p class="text-xs text-gray-500">
            Total Kurir
        </p>

        <p class="mt-1 text-2xl font-bold text-brand-900">
            {{ number_format($stats['total_couriers']) }}
        </p>
    </div>

    {{-- Total Pendapatan --}}
    <div class="rounded-xl border border-gray-100 bg-white p-4 shadow-sm">
        <p class="text-xs text-gray-500">
            Total Pendapatan
        </p>

        <p class="mt-1 text-2xl font-bold text-brand-900">
            Rp{{ number_format($stats['total_revenue'], 0, ',', '.') }}
        </p>
    </div>

</div>

{{-- Tabel Pesanan --}}
<div class="overflow-hidden rounded-xl border border-gray-100 bg-white shadow-sm">

    <div class="overflow-x-auto">

        <table class="min-w-full text-sm">

            <thead>
                <tr class="bg-brand-900 text-left text-white">

                    <th class="px-4 py-3 font-medium">
                        ID
                    </th>

                    <th class="px-4 py-3 font-medium">
                        Pelanggan
                    </th>

                    <th class="px-4 py-3 font-medium">
                        Pesanan
                    </th>

                    <th class="px-4 py-3 font-medium">
                        Pengiriman &amp; Pembayaran
                    </th>

                    <th class="px-4 py-3 font-medium">
                        Status
                    </th>

                    <th class="px-4 py-3 font-medium">
                        Aksi
                    </th>

                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">

                @forelse ($orders as $order)

                    <tr class="align-top transition hover:bg-brand-50/60">

                        {{-- ID --}}
                        <td class="whitespace-nowrap px-4 py-3">
                            <span class="font-semibold text-brand-700">
                                #{{ $order->id }}
                            </span>
                        </td>

                        {{-- Pelanggan --}}
                        <td class="px-4 py-3">

                            <p class="font-medium text-gray-900">
                                {{ $order->customer?->name ?? 'Pelanggan tidak ditemukan' }}
                            </p>

                            @if ($order->customer?->city)
                                <div class="mt-1 flex items-center gap-1.5 text-xs text-gray-500">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-3.5 w-3.5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 21s7-5.686 7-11a7 7 0 10-14 0c0 5.314 7 11 7 11z"
                                        />
                                        <circle cx="12" cy="10" r="2.5" />
                                    </svg>

                                    {{ $order->customer->city->name }}

                                </div>
                            @endif

                        </td>

                        {{-- Detail Pesanan --}}
                        <td class="px-4 py-3">

                            @if ($order->orderItems->count())

                                <ul class="space-y-2">

                                    @foreach ($order->orderItems as $item)

                                        <li class="flex items-center gap-2 text-gray-700">

                                            <span class="inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-brand-100 text-xs font-semibold text-brand-700">
                                                {{ $item->qty }}
                                            </span>

                                            <span>
                                                {{ $item->menu?->name ?? 'Menu tidak ditemukan' }}

                                                @if ($item->menu?->category)
                                                    <span class="text-xs italic text-gray-400">
                                                        ({{ $item->menu->category->name }})
                                                    </span>
                                                @endif
                                            </span>

                                        </li>

                                    @endforeach

                                </ul>

                            @else

                                <span class="text-xs text-gray-400">
                                    Tidak ada item pesanan
                                </span>

                            @endif

                        </td>

                        {{-- Pengiriman & Pembayaran --}}
                        <td class="px-4 py-3">

                            <p class="text-gray-900">
                                {{ $order->courier?->name ?? 'Belum ditentukan' }}
                            </p>

                            <p class="mt-1 text-xs text-gray-500">
                                {{ $order->paymentMethod?->name ?? 'Belum dipilih' }}
                            </p>

                        </td>

                        {{-- Status --}}
                        <td class="px-4 py-3">

                            <form
                                method="POST"
                                action="{{ route('admin.orders.updateStatus', $order) }}"
                            >

                                @csrf
                                @method('PATCH')

                                <select
                                    name="status"
                                    onchange="this.form.submit()"
                                    class="rounded-lg border-gray-300 text-xs focus:border-brand-500 focus:ring-brand-500"
                                >

                                    @foreach ([
                                        'pending',
                                        'diproses',
                                        'dikirim',
                                        'selesai',
                                        'dibatalkan'
                                    ] as $status)

                                        <option
                                            value="{{ $status }}"
                                            @selected($order->status === $status)
                                        >
                                            {{ ucfirst($status) }}
                                        </option>

                                    @endforeach

                                </select>

                            </form>

                        </td>

                        {{-- Hapus --}}
                        <td class="px-4 py-3">

                            <form
                                method="POST"
                                action="{{ route('admin.orders.destroy', $order) }}"
                                onsubmit="return confirm('Hapus order #{{ $order->id }}?')"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="text-xs font-medium text-red-600 transition hover:text-red-800 hover:underline"
                                >
                                    Hapus
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="6"
                            class="px-4 py-10 text-center"
                        >

                            <div class="flex flex-col items-center">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-10 w-10 text-gray-300"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4"
                                    />
                                </svg>

                                <p class="mt-3 text-sm text-gray-400">
                                    Belum ada order.
                                </p>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

{{-- Pagination --}}
<div class="mt-6">
    {{ $orders->links() }}
</div>

@endsection
