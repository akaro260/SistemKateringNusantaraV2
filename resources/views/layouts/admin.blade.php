<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin') - Rasa Nusantara</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#fdf6ee',
                            100: '#f8e8d3',
                            500: '#c17a3d',
                            600: '#a4602a',
                            700: '#824a20',
                            900: '#3c2f2f',
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="min-h-screen bg-brand-50 text-gray-800 antialiased">

<div class="flex min-h-screen">

    {{-- =========================================================
        SIDEBAR
    ========================================================== --}}
    <aside class="hidden w-64 shrink-0 flex-col bg-brand-900 text-white md:flex">

        {{-- Logo --}}
        <div class="flex h-16 items-center gap-3 border-b border-white/10 px-5">

            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-brand-500">
                <svg
                    class="h-5 w-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M12 3v18M5 8h14M5 16h14"
                    />
                </svg>
            </div>

            <div>
                <p class="text-sm font-semibold leading-tight">
                    Rasa Nusantara
                </p>

                <p class="text-[11px] leading-tight text-brand-100/60">
                    Admin Panel
                </p>
            </div>
        </div>


        {{-- Navigation --}}
        <nav class="flex-1 space-y-1 px-3 py-4">

            {{-- Dashboard --}}
            <a
                href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm transition
                {{ request()->routeIs('admin.dashboard')
                    ? 'bg-white/10 font-medium text-white'
                    : 'text-brand-100/80 hover:bg-white/5 hover:text-white' }}"
            >
                <svg
                    class="h-5 w-5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M4 13h6V4H4v9Zm10 7h6v-9h-6v9ZM4 20h6v-3H4v3Zm10-12h6V4h-6v4Z"
                    />
                </svg>

                <span>Dashboard Pesanan</span>
            </a>


            {{-- Section --}}
            <div class="px-3 pb-2 pt-6">
                <p class="text-[10px] font-semibold uppercase tracking-wider text-brand-100/40">
                    Master Data
                </p>
            </div>


            {{-- Menu --}}
            <a
                href="{{ route('admin.menus.index') }}"
                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm transition
                {{ request()->routeIs('admin.menus.*')
                    ? 'bg-white/10 font-medium text-white'
                    : 'text-brand-100/80 hover:bg-white/5 hover:text-white' }}"
            >
                <svg
                    class="h-5 w-5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M4 6h16M4 12h16M4 18h16"
                    />
                </svg>

                <span>Menu</span>
            </a>


            {{-- Kategori --}}
            <a
                href="{{ route('admin.categories.index') }}"
                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm transition
                {{ request()->routeIs('admin.categories.*')
                    ? 'bg-white/10 font-medium text-white'
                    : 'text-brand-100/80 hover:bg-white/5 hover:text-white' }}"
            >
                <svg
                    class="h-5 w-5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M20 12.5 11.5 21 3 12.5V4h8.5L20 12.5Z"
                    />

                    <circle
                        cx="7.5"
                        cy="7.5"
                        r="1"
                        stroke-width="1.8"
                    />
                </svg>

                <span>Kategori</span>
            </a>


            {{-- Kota --}}
            <a
                href="{{ route('admin.cities.index') }}"
                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm transition
                {{ request()->routeIs('admin.cities.*')
                    ? 'bg-white/10 font-medium text-white'
                    : 'text-brand-100/80 hover:bg-white/5 hover:text-white' }}"
            >
                <svg
                    class="h-5 w-5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M12 21s7-6.2 7-11a7 7 0 1 0-14 0c0 4.8 7 11 7 11Z"
                    />

                    <circle
                        cx="12"
                        cy="10"
                        r="2.2"
                        stroke-width="1.8"
                    />
                </svg>

                <span>Kota</span>
            </a>


            {{-- Kurir --}}
            <a
                href="{{ route('admin.couriers.index') }}"
                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm transition
                {{ request()->routeIs('admin.couriers.*')
                    ? 'bg-white/10 font-medium text-white'
                    : 'text-brand-100/80 hover:bg-white/5 hover:text-white' }}"
            >
                <svg
                    class="h-5 w-5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M3 6h11v11H3V6Zm11 4h4l3 3v4h-7v-7Z"
                    />

                    <circle
                        cx="7"
                        cy="19"
                        r="1.5"
                        stroke-width="1.8"
                    />

                    <circle
                        cx="18"
                        cy="19"
                        r="1.5"
                        stroke-width="1.8"
                    />
                </svg>

                <span>Kurir</span>
            </a>


            {{-- Metode Pembayaran --}}
            <a
                href="{{ route('admin.payment-methods.index') }}"
                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm transition
                {{ request()->routeIs('admin.payment-methods.*')
                    ? 'bg-white/10 font-medium text-white'
                    : 'text-brand-100/80 hover:bg-white/5 hover:text-white' }}"
            >
                <svg
                    class="h-5 w-5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <rect
                        x="3"
                        y="5"
                        width="18"
                        height="14"
                        rx="2"
                        stroke-width="1.8"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-width="1.8"
                        d="M3 10h18"
                    />
                </svg>

                <span>Metode Bayar</span>
            </a>

        </nav>


        {{-- User Info --}}
        <div class="border-t border-white/10 px-4 py-4">

            <p class="text-[11px] text-brand-100/50">
                Masuk sebagai
            </p>

            <div class="mt-1 flex items-center gap-2">

                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-brand-500 text-xs font-semibold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div class="min-w-0">
                    <p class="truncate text-sm font-medium text-white">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-[10px] text-brand-100/50">
                        Administrator
                    </p>
                </div>

            </div>

        </div>

    </aside>


    {{-- =========================================================
        MAIN
    ========================================================== --}}
    <div class="flex min-w-0 flex-1 flex-col">

        {{-- Topbar --}}
        <header class="sticky top-0 z-10 flex h-16 items-center justify-between border-b border-gray-100 bg-white px-4 sm:px-6">

            <div>
                <p class="text-xs text-gray-400">
                    Admin Panel
                </p>

                <h1 class="text-base font-semibold text-brand-900">
                    @yield('title', 'Dashboard')
                </h1>
            </div>


            <div class="flex items-center gap-3">

                {{-- Customer Page --}}
                <a
                    href="{{ route('menu.index') }}"
                    class="hidden items-center gap-1.5 text-sm text-gray-500 transition hover:text-brand-700 sm:flex"
                >
                    <svg
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M14 5l7 7-7 7M21 12H3"
                        />
                    </svg>

                    <span>Lihat sisi customer</span>
                </a>


                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 rounded-lg border border-gray-200 px-3 py-2 text-sm text-gray-600 transition hover:bg-gray-50 hover:text-gray-900"
                    >
                        <svg
                            class="h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M9 5H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h4M16 17l5-5-5-5M21 12H9"
                            />
                        </svg>

                        <span>Keluar</span>
                    </button>
                </form>

            </div>

        </header>


        {{-- Content --}}
        <main class="flex-1 p-4 sm:p-6">

            {{-- Success --}}
            @if (session('success'))
                <div class="mb-6 flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">

                    <svg
                        class="mt-0.5 h-5 w-5 shrink-0"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="m5 12 4 4L19 6"
                        />
                    </svg>

                    <span>{{ session('success') }}</span>

                </div>
            @endif


            {{-- Error --}}
            @if (session('error'))
                <div class="mb-6 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">

                    <svg
                        class="mt-0.5 h-5 w-5 shrink-0"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 8v4m0 4h.01M5 19h14a1 1 0 0 0 .9-1.45L13.9 5.55a1 1 0 0 0-1.8 0L4.1 17.55A1 1 0 0 0 5 19Z"
                        />
                    </svg>

                    <span>{{ session('error') }}</span>

                </div>
            @endif


            @yield('content')

        </main>

    </div>

</div>

</body>
</html>

