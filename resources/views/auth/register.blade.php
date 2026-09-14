@extends('layouts.app')
@section('title', 'Daftar')

@section('content')
<div class="max-w-sm mx-auto bg-white rounded-xl shadow-sm border border-gray-100 p-6 mt-8">
    <h1 class="text-xl font-bold text-brand-900 mb-1">Buat Akun</h1>
    <p class="text-sm text-gray-500 mb-6">Daftar sebagai pelanggan untuk mulai memesan.</p>

    @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-100 text-red-700 text-sm px-4 py-3">
            <ul class="list-disc list-inside space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   class="w-full rounded-lg border-gray-300 focus:border-brand-500 focus:ring-brand-500 text-sm">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="w-full rounded-lg border-gray-300 focus:border-brand-500 focus:ring-brand-500 text-sm">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">No. HP</label>
            <input type="text" name="phone" value="{{ old('phone') }}" required
                   class="w-full rounded-lg border-gray-300 focus:border-brand-500 focus:ring-brand-500 text-sm">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
            <select name="city_id" required class="w-full rounded-lg border-gray-300 focus:border-brand-500 focus:ring-brand-500 text-sm">
                <option value="">— Pilih kota —</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}" @selected(old('city_id') == $city->id)>{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" name="password" required
                   class="w-full rounded-lg border-gray-300 focus:border-brand-500 focus:ring-brand-500 text-sm">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required
                   class="w-full rounded-lg border-gray-300 focus:border-brand-500 focus:ring-brand-500 text-sm">
        </div>
        <button type="submit" class="w-full bg-brand-600 hover:bg-brand-700 text-white text-sm font-medium py-2.5 rounded-lg transition">
            Daftar
        </button>
    </form>

    <p class="text-sm text-gray-500 mt-5 text-center">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-brand-700 font-medium hover:underline">Masuk</a>
    </p>
</div>
@endsection
