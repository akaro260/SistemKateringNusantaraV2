@extends('layouts.app')

@section('title', 'Daftar')

@section('content')

<div class="px-4 py-10">
    <div class="mx-auto w-full max-w-md">


    {{-- Header --}}
    <div class="mb-7 text-center">
        <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-brand-100">
                <i class="fa-solid fa-user"></i>
        </div>

        <h1 class="text-2xl font-bold tracking-tight text-gray-900">
            Buat Akun
        </h1>

        <p class="mt-1.5 text-sm text-gray-500">
            Daftar sebagai pelanggan untuk mulai memesan.
        </p>
    </div>

    {{-- Card --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8">

        {{-- Error --}}
        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3">
                <div class="flex gap-3">
                    <svg class="mt-0.5 h-5 w-5 shrink-0 text-red-500"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4m0 4h.01M10.29 3.86l-7.82 13.5A2 2 0 004.2 20.5h15.6a2 2 0 001.73-3.14l-7.82-13.5a2 2 0 00-3.42 0z"/>
                    </svg>

                    <div>
                        <p class="text-sm font-semibold text-red-800">
                            Terjadi kesalahan
                        </p>

                        <ul class="mt-1 list-disc space-y-1 pl-4 text-xs text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            {{-- Nama --}}
            <div>
                <label for="name" class="mb-1.5 block text-sm font-medium text-gray-700">
                    Nama Lengkap
                </label>

                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Masukkan nama lengkap"
                    class="w-full rounded-xl border-gray-300 px-4 py-2.5 text-sm
                           placeholder:text-gray-400
                           focus:border-brand-500 focus:ring-brand-500"
                >

                @error('name')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="mb-1.5 block text-sm font-medium text-gray-700">
                    Email
                </label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    placeholder="contoh@email.com"
                    class="w-full rounded-xl border-gray-300 px-4 py-2.5 text-sm
                           placeholder:text-gray-400
                           focus:border-brand-500 focus:ring-brand-500"
                >

                @error('email')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- No HP --}}
            <div>
                <label for="phone" class="mb-1.5 block text-sm font-medium text-gray-700">
                    No. HP
                </label>

                <input
                    id="phone"
                    type="text"
                    name="phone"
                    value="{{ old('phone') }}"
                    required
                    autocomplete="tel"
                    placeholder="08xxxxxxxxxx"
                    class="w-full rounded-xl border-gray-300 px-4 py-2.5 text-sm
                           placeholder:text-gray-400
                           focus:border-brand-500 focus:ring-brand-500"
                >

                @error('phone')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kota --}}
            <div class="relative">
                <label for="city_search" class="mb-1.5 block text-sm font-medium text-gray-700">
                    Kota
                </label>

                {{-- Tombol Dropdown --}}
                <button
                    type="button"
                    id="city_button"
                    class="flex w-full items-center justify-between rounded-xl border border-gray-300
                           bg-white px-4 py-2.5 text-left text-sm
                           transition hover:border-gray-400
                           focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                >
                    <span id="city_selected" class="text-gray-400">
                        Pilih kota
                    </span>

                    <svg id="city_arrow"
                         class="h-5 w-5 text-gray-400 transition-transform duration-200"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                {{-- Hidden input untuk Laravel --}}
                <input
                    type="hidden"
                    name="city_id"
                    id="city_id"
                    value="{{ old('city_id') }}"
                    required
                >

                {{-- Dropdown --}}
                <div
                    id="city_dropdown"
                    class="absolute z-50 mt-2 hidden w-full overflow-hidden rounded-xl border border-gray-200
                           bg-white shadow-lg"
                >

                    {{-- Search --}}
                    <div class="border-b border-gray-100 p-3">
                        <div class="relative">
                            <svg
                                class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"/>
                            </svg>

                            <input
                                type="text"
                                id="city_search"
                                placeholder="Cari nama kota..."
                                autocomplete="off"
                                class="w-full rounded-lg border-gray-200 py-2 pl-9 pr-3 text-sm
                                       focus:border-brand-500 focus:ring-brand-500"
                            >
                        </div>
                    </div>

                    {{-- List Kota --}}
                    <div
                        id="city_list"
                        class="max-h-60 overflow-y-auto p-1.5"
                    >
                        @foreach ($cities as $city)
                            <button
                                type="button"
                                class="city-option flex w-full items-center justify-between rounded-lg px-3 py-2.5
                                       text-left text-sm text-gray-700 transition
                                       hover:bg-brand-50 hover:text-brand-700"
                                data-id="{{ $city->id }}"
                                data-name="{{ strtolower($city->name) }}"
                            >
                                <span>{{ $city->name }}</span>

                                <svg
                                    class="city-check hidden h-4 w-4 text-brand-600"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M5 13l4 4L19 7"/>
                                </svg>
                            </button>
                        @endforeach

                        <div
                            id="city_empty"
                            class="hidden px-3 py-6 text-center text-sm text-gray-400"
                        >
                            Kota tidak ditemukan.
                        </div>
                    </div>
                </div>

                @error('city_id')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="mb-1.5 block text-sm font-medium text-gray-700">
                    Password
                </label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="Masukkan password"
                    class="w-full rounded-xl border-gray-300 px-4 py-2.5 text-sm
                           placeholder:text-gray-400
                           focus:border-brand-500 focus:ring-brand-500"
                >

                @error('password')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div>
                <label for="password_confirmation" class="mb-1.5 block text-sm font-medium text-gray-700">
                    Konfirmasi Password
                </label>

                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Ulangi password"
                    class="w-full rounded-xl border-gray-300 px-4 py-2.5 text-sm
                           placeholder:text-gray-400
                           focus:border-brand-500 focus:ring-brand-500"
                >
            </div>

            {{-- Submit --}}
            <button
                type="submit"
                class="w-full rounded-xl bg-brand-600 px-4 py-2.5
                       text-sm font-semibold text-white
                       shadow-sm transition
                       hover:bg-brand-700
                       focus:outline-none focus:ring-2
                       focus:ring-brand-500 focus:ring-offset-2"
            >
                Daftar
            </button>
        </form>

        {{-- Login --}}
        <div class="mt-6 border-t border-gray-100 pt-5 text-center">
            <p class="text-sm text-gray-500">
                Sudah punya akun?

                <a
                    href="{{ route('login') }}"
                    class="font-semibold text-brand-700 transition hover:text-brand-800 hover:underline"
                >
                    Masuk
                </a>
            </p>
        </div>
    </div>

    <p class="mt-5 text-center text-xs text-gray-400">
        Data Anda akan digunakan untuk kebutuhan pemesanan.
    </p>

</div>


</div>

{{-- JavaScript Dropdown Kota --}}

<script>
document.addEventListener('DOMContentLoaded', function () {

    const button = document.getElementById('city_button');
    const dropdown = document.getElementById('city_dropdown');
    const search = document.getElementById('city_search');
    const cityId = document.getElementById('city_id');
    const selected = document.getElementById('city_selected');
    const arrow = document.getElementById('city_arrow');
    const empty = document.getElementById('city_empty');
    const options = document.querySelectorAll('.city-option');

    function openDropdown() {
        dropdown.classList.remove('hidden');
        arrow.classList.add('rotate-180');

        setTimeout(() => {
            search.focus();
        }, 50);
    }

    function closeDropdown() {
        dropdown.classList.add('hidden');
        arrow.classList.remove('rotate-180');
    }

    button.addEventListener('click', function () {
        if (dropdown.classList.contains('hidden')) {
            openDropdown();
        } else {
            closeDropdown();
        }
    });

    // Search kota
    search.addEventListener('input', function () {

        const keyword = this.value.toLowerCase().trim();
        let visibleCount = 0;

        options.forEach(option => {

            const cityName = option.dataset.name;

            if (cityName.includes(keyword)) {
                option.classList.remove('hidden');
                visibleCount++;
            } else {
                option.classList.add('hidden');
            }
        });

        if (visibleCount === 0) {
            empty.classList.remove('hidden');
        } else {
            empty.classList.add('hidden');
        }
    });

    // Pilih kota
    options.forEach(option => {

        option.addEventListener('click', function () {

            const id = this.dataset.id;
            const name = this.querySelector('span').textContent.trim();

            cityId.value = id;
            selected.textContent = name;
            selected.classList.remove('text-gray-400');
            selected.classList.add('text-gray-900');

            // Reset semua tanda centang
            options.forEach(item => {
                item.querySelector('.city-check').classList.add('hidden');
            });

            // Tampilkan centang
            this.querySelector('.city-check').classList.remove('hidden');

            closeDropdown();
            search.value = '';

            // Tampilkan kembali semua kota
            options.forEach(item => {
                item.classList.remove('hidden');
            });

            empty.classList.add('hidden');
        });
    });

    // Klik di luar dropdown
    document.addEventListener('click', function (event) {

        if (!button.contains(event.target) &&
            !dropdown.contains(event.target)) {
            closeDropdown();
        }
    });

    // Isi kota lama jika validasi gagal
    const oldCityId = cityId.value;

    if (oldCityId) {

        options.forEach(option => {

            if (option.dataset.id === oldCityId) {

                const name = option.querySelector('span').textContent.trim();

                selected.textContent = name;
                selected.classList.remove('text-gray-400');
                selected.classList.add('text-gray-900');

                option.querySelector('.city-check').classList.remove('hidden');
            }
        });
    }
});
</script>

@endsection
