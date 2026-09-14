@extends('layouts.admin')
@section('title', 'Kurir')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <p class="text-sm text-gray-500">{{ $couriers->total() }} kurir</p>
        <a href="{{ route('admin.couriers.create') }}" class="bg-brand-600 hover:bg-brand-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">+ Tambah Kurir</a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="bg-brand-900 text-white text-left">
                    <th class="px-4 py-3 font-medium">Nama</th>
                    <th class="px-4 py-3 font-medium">No. HP</th>
                    <th class="px-4 py-3 font-medium">Total Order</th>
                    <th class="px-4 py-3 font-medium w-32"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($couriers as $courier)
                    <tr class="hover:bg-brand-50/60">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $courier->name }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $courier->phone }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $courier->orders_count }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.couriers.edit', $courier) }}" class="text-xs text-brand-700 hover:underline">Edit</a>
                                <form method="POST" action="{{ route('admin.couriers.destroy', $courier) }}" onsubmit="return confirm('Hapus kurir ini?')">
                                    @csrf @method('DELETE')
                                    <button class="text-xs text-red-600 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-4 py-8 text-center text-gray-400">Belum ada kurir.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $couriers->links() }}</div>
@endsection
