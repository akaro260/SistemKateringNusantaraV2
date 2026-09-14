
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="min-h-screen bg-[#fdf6ee] py-8">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Welcome --}}
        <div class="mb-8">
            <p class="text-sm font-medium text-[#a4602a]">
                Selamat datang kembali
            </p>

            <h1 class="mt-1 text-3xl font-bold text-[#3c2f2f]">
                Halo, {{ auth()->user()->name }}!
            </h1>

            <p class="mt-2 text-sm text-gray-600">
                Mau makan apa hari ini?
            </p>
        </div>

        {{-- Promo Banner --}}
        <div class="relative mb-8 overflow-hidden rounded-3xl bg-[#3c2f2f] p-7 shadow-lg">

            <div class="relative z-10 max-w-xl">

                <span class="inline-flex rounded-full bg-[#c17a3d] px-3 py-1 text-xs font-semibold text-white">
                    PROMO HARI INI
                </span>

                <h2 class="mt-4 text-2xl font-bold text-white sm:text-3xl">
                    Nikmati Hidangan Nusantara
                </h2>

                <p class="mt-2 text-sm leading-6 text-[#f8e8d3]">
                    Temukan berbagai pilihan makanan lezat dari berbagai
                    daerah Indonesia dan pesan dengan mudah.
                </p>

                <a href="{{ route('menu.index') }}"
                   class="mt-5 inline-flex items-center gap-2 rounded-xl bg-[#c17a3d] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#a4602a]">

                    Lihat Menu

                    <svg class="h-4 w-4"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>

                </a>

            </div>

            {{-- Decorative --}}
            <div class="absolute -right-16 -top-16 h-64 w-64 rounded-full bg-[#c17a3d]/20"></div>
            <div class="absolute -bottom-24 right-24 h-72 w-72 rounded-full bg-[#a4602a]/20"></div>

        </div>

        {{-- Quick Menu --}}
        <div class="mb-8 grid grid-cols-2 gap-4 sm:grid-cols-4">

            {{-- Menu --}}
            <a href="{{ route('menu.index') }}"
               class="group rounded-2xl bg-white p-5 shadow-sm ring-1 ring-[#f0dfcd] transition hover:-translate-y-1 hover:shadow-md">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#f8e8d3] text-[#a4602a]">

                    <svg class="h-5 w-5"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 10h18M5 6h14M7 14h10M9 18h6"/>
                    </svg>

                </div>

                <h3 class="mt-4 text-sm font-bold text-[#3c2f2f]">
                    Menu
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Lihat makanan
                </p>

            </a>

            {{-- Pesanan --}}
            <a href="#"
               class="group rounded-2xl bg-white p-5 shadow-sm ring-1 ring-[#f0dfcd] transition hover:-translate-y-1 hover:shadow-md">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#f8e8d3] text-[#a4602a]">

                    <svg class="h-5 w-5"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>
                    </svg>

                </div>

                <h3 class="mt-4 text-sm font-bold text-[#3c2f2f]">
                    Pesanan
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Riwayat pesanan
                </p>

            </a>

            {{-- Keranjang --}}
            <a href="#"
               class="group rounded-2xl bg-white p-5 shadow-sm ring-1 ring-[#f0dfcd] transition hover:-translate-y-1 hover:shadow-md">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#f8e8d3] text-[#a4602a]">

                    <svg class="h-5 w-5"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 4h13m-11 0a1 1 0 102 0m8 0a1 1 0 102 0"/>
                    </svg>

                </div>

                <h3 class="mt-4 text-sm font-bold text-[#3c2f2f]">
                    Keranjang
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Item pilihanmu
                </p>

            </a>

            {{-- Profil --}}
            <a href="{{ route('profile.edit') }}"
               class="group rounded-2xl bg-white p-5 shadow-sm ring-1 ring-[#f0dfcd] transition hover:-translate-y-1 hover:shadow-md">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#f8e8d3] text-[#a4602a]">

                    <svg class="h-5 w-5"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M15 19a6 6 0 00-12 0m6-8a4 4 0 100-8 4 4 0 000 8zm6-3h6m-3-3v6"/>
                    </svg>

                </div>

                <h3 class="mt-4 text-sm font-bold text-[#3c2f2f]">
                    Profil
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Kelola akun
                </p>

            </a>

        </div>

        {{-- Main Grid --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

            {{-- Popular Menu --}}
            <div class="lg:col-span-2">

                <div class="mb-4 flex items-center justify-between">

                    <div>
                        <h2 class="text-xl font-bold text-[#3c2f2f]">
                            Pilihan Untukmu
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Menu yang mungkin kamu sukai
                        </p>
                    </div>

                    <a href="{{ route('menu.index') }}"
                       class="text-sm font-semibold text-[#a4602a] hover:text-[#824a20]">
                        Lihat semua
                    </a>

                </div>

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                    {{-- Food Card --}}
                    <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-[#f0dfcd]">

                        <div class="flex h-40 items-center justify-center bg-[#f8e8d3]">

                            <svg class="h-16 w-16 text-[#c17a3d]"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.5"
                                      d="M12 3v18M5 8h14M7 8c0-3 2-5 5-5s5 2 5 5M6 8v5a6 6 0 0012 0V8"/>
                            </svg>

                        </div>

                        <div class="p-5">

                            <p class="text-xs font-medium text-[#c17a3d]">
                                Makanan
                            </p>

                            <h3 class="mt-1 font-bold text-[#3c2f2f]">
                                Hidangan Nusantara
                            </h3>

                            <div class="mt-3 flex items-center justify-between">

                                <span class="font-bold text-[#a4602a]">
                                    Mulai Rp25.000
                                </span>

                                <a href="{{ route('menu.index') }}"
                                   class="rounded-lg bg-[#c17a3d] px-3 py-2 text-xs font-semibold text-white hover:bg-[#a4602a]">
                                    Pesan
                                </a>

                            </div>

                        </div>

                    </div>

                    {{-- Food Card --}}
                    <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-[#f0dfcd]">

                        <div class="flex h-40 items-center justify-center bg-[#f8e8d3]">

                            <svg class="h-16 w-16 text-[#c17a3d]"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.5"
                                      d="M4 19h16M6 19V9h12v10M8 9V5h8v4M9 5h6"/>
                            </svg>

                        </div>

                        <div class="p-5">

                            <p class="text-xs font-medium text-[#c17a3d]">
                                Paket
                            </p>

                            <h3 class="mt-1 font-bold text-[#3c2f2f]">
                                Paket Hemat
                            </h3>

                            <div class="mt-3 flex items-center justify-between">

                                <span class="font-bold text-[#a4602a]">
                                    Mulai Rp35.000
                                </span>

                                <a href="{{ route('menu.index') }}"
                                   class="rounded-lg bg-[#c17a3d] px-3 py-2 text-xs font-semibold text-white hover:bg-[#a4602a]">
                                    Pesan
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- Recent Order --}}
            <div>

                <div class="mb-4">
                    <h2 class="text-xl font-bold text-[#3c2f2f]">
                        Pesanan Terbaru
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Pesanan terakhir kamu
                    </p>
                </div>

                <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-[#f0dfcd]">

                    <div class="flex items-center justify-between border-b border-gray-100 pb-4">

                        <div>
                            <p class="text-xs text-gray-500">
                                Pesanan #ORD-001
                            </p>

                            <p class="mt-1 font-semibold text-[#3c2f2f]">
                                Paket Nusantara
                            </p>
                        </div>

                        <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                            Diproses
                        </span>

                    </div>

                    <div class="py-4">

                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">
                                Total
                            </span>

                            <span class="font-bold text-[#3c2f2f]">
                                Rp75.000
                            </span>
                        </div>

                        <div class="mt-2 flex justify-between text-sm">
                            <span class="text-gray-500">
                                Tanggal
                            </span>

                            <span class="text-gray-700">
                                Hari ini
                            </span>
                        </div>

                    </div>

                    <a href="#"
                       class="block rounded-xl border border-[#c17a3d] py-2.5 text-center text-sm font-semibold text-[#a4602a] transition hover:bg-[#c17a3d] hover:text-white">
                        Lihat Pesanan
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

