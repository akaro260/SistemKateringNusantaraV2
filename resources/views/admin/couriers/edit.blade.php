@extends('layouts.admin')
@section('title', 'Edit Kurir')

@section('content')
    <div class="max-w-md bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <form method="POST" action="{{ route('admin.couriers.update', $courier) }}" class="space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kurir</label>
                <input type="text" name="name" value="{{ old('name', $courier->name) }}" required autofocus
                       class="w-full rounded-lg border-gray-300 text-sm focus:border-brand-500 focus:ring-brand-500">
                @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">No. HP</label>
                <input type="text" name="phone" value="{{ old('phone', $courier->phone) }}" required
                       class="w-full rounded-lg border-gray-300 text-sm focus:border-brand-500 focus:ring-brand-500">
                @error('phone') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="flex gap-3">
                <button class="bg-brand-600 hover:bg-brand-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">Simpan Perubahan</button>
                <a href="{{ route('admin.couriers.index') }}" class="text-sm text-gray-500 px-4 py-2">Batal</a>
            </div>
        </form>
    </div>
@endsection
