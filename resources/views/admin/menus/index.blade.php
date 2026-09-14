@extends('layouts.admin')
@section('title', 'Menu')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <p class="text-sm text-gray-500">{{ $menus->total() }} menu</p>
        <a href="{{ route('admin.menus.create') }}" class="bg-brand-600 hover:bg-brand-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">+ Tambah Menu</a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="bg-brand-900 text-white text-left">
                    <th class="px-4 py-3 font-medium">Nama Menu</th>
                    <th class="px-4 py-3 font-medium">Kategori</th>
                    <th class="px-4 py-3 font-medium">Harga</th>
                    <th class="px-4 py-3 font-medium w-32"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($menus as $menu)
                    <tr class="hover:bg-brand-50/60">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $menu->name }}</td>
                        <td class="px-4 py-3">
                            <span class="text-xs bg-brand-100 text-brand-700 px-2 py-0.5 rounded-full">{{ $menu->category->name }}</span>
                        </td>
                        <td class="px-4 py-3 text-gray-600">Rp{{ number_format($menu->price, 0, ',', '.') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.menus.edit', $menu) }}" class="text-xs text-brand-700 hover:underline">Edit</a>
                                <form method="POST" action="{{ route('admin.menus.destroy', $menu) }}" onsubmit="return confirm('Hapus menu ini?')">
                                    @csrf @method('DELETE')
                                    <button class="text-xs text-red-600 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-4 py-8 text-center text-gray-400">Belum ada menu.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $menus->links() }}</div>
@endsection
