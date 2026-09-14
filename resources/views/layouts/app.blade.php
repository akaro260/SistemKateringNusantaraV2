<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css" integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg==" crossorigin="anonymous" referrerpolicy="no-referrer">
<title>@yield('title', 'Rasa Nusantara')</title>

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

@stack('styles')


</head>

<body class="min-h-screen bg-brand-50 text-gray-800 antialiased">


{{-- Navbar --}}
<nav class="sticky top-0 z-50 border-b border-white/10 bg-brand-900 text-white shadow-sm">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">

        <div class="flex h-16 items-center justify-between">

            {{-- Logo --}}
            <a
                href="{{ route('dashboard') }}"
                class="flex items-center gap-3 transition hover:opacity-90"
            >
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-brand-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3.75 10.5h16.5M5.25 10.5v8.25m13.5-8.25v8.25M3.75 18.75h16.5M6 7.5h12M8.25 4.5h7.5M9 7.5v-3m6 3v-3"/>
                    </svg>
                </div>

                <div class="hidden sm:block">
                    <p class="font-bold leading-tight">
                        Rasa Nusantara
                    </p>
                    <p class="text-xs text-brand-100/70">
                        Sistem Katering
                    </p>
                </div>
            </a>

            {{-- Navigation --}}
            <div class="flex items-center gap-1 text-sm sm:gap-2">

                {{-- Menu --}}
                <a
                    href="{{ route('menu.index') }}"
                    class="flex items-center gap-2 rounded-lg px-3 py-2 transition hover:bg-white/10
                    {{ request()->routeIs('menu.index') ? 'bg-white/10 font-semibold' : '' }}"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/>
                    </svg>

                    <span class="hidden sm:inline">Menu</span>
                </a>

                {{-- Pesanan --}}
                @auth
                    <a
                        href="{{ route('orders.mine') }}"
                        class="flex items-center gap-2 rounded-lg px-3 py-2 transition hover:bg-white/10
                        {{ request()->routeIs('orders.mine') ? 'bg-white/10 font-semibold' : '' }}"
                    >
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M6.75 3.75h10.5A1.5 1.5 0 0 1 18.75 5.25v15l-6.75-3-6.75 3v-15a1.5 1.5 0 0 1 1.5-1.5Z"/>
                        </svg>

                        <span class="hidden sm:inline">Pesanan Saya</span>
                    </a>
                @endauth

                {{-- Keranjang --}}
                <a
                    href="{{ route('cart.index') }}"
                    class="relative flex items-center gap-2 rounded-lg px-3 py-2 transition hover:bg-white/10
                    {{ request()->routeIs('cart.*') ? 'bg-white/10 font-semibold' : '' }}"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M2.25 3h1.386a1.5 1.5 0 0 1 1.456 1.136L5.5 6.75m0 0h14.25l-1.5 7.5H7.125L5.5 6.75Zm1.625 7.5-1.5 1.5a1.5 1.5 0 0 0 1.06 2.56h10.69M9 20.25h.008M16.5 20.25h.008"/>
                    </svg>

                    <span class="hidden sm:inline">Keranjang</span>

                    @php
                        $cartCount = collect(session('cart', []))->sum('qty');
                    @endphp

                    @if ($cartCount > 0)
                        <span class="absolute -right-1 -top-1 flex h-5 min-w-5 items-center justify-center rounded-full bg-red-500 px-1 text-[10px] font-bold text-white ring-2 ring-brand-900">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                {{-- Auth --}}
                @auth

                    {{-- Admin --}}
                    @if (auth()->user()->isAdmin())
                        <a
                            href="{{ route('admin.dashboard') }}"
                            class="ml-1 flex items-center gap-2 rounded-lg bg-brand-500 px-3 py-2 font-semibold transition hover:bg-brand-600"
                        >
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3.75 3.75h6v6h-6v-6Zm10.5 0h6v6h-6v-6Zm-10.5 10.5h6v6h-6v-6Zm10.5 0h6v6h-6v-6Z"/>
                            </svg>

                            <span class="hidden sm:inline">Admin</span>
                        </a>
                    @endif

                    {{-- Logout --}}
                    <form method="POST" action="{{ route('logout') }}" class="ml-1">
                        @csrf

                        <button
                            type="submit"
                            class="flex items-center gap-2 rounded-lg px-3 py-2 transition hover:bg-white/10"
                        >
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15.75 8.25V5.625A1.875 1.875 0 0 0 13.875 3.75h-7.5A1.875 1.875 0 0 0 4.5 5.625v12.75a1.875 1.875 0 0 0 1.875 1.875h7.5a1.875 1.875 0 0 0 1.875-1.875V15.75m-4.5-3.75h9m0 0-3-3m3 3-3 3"/>
                            </svg>

                            <span class="hidden sm:inline">Keluar</span>
                        </button>
                    </form>

                @else

                    {{-- Login --}}
                    <a
                        href="{{ route('login') }}"
                        class="ml-1 rounded-lg border border-white/15 px-3 py-2 font-medium transition hover:bg-white/10"
                    >
                        Masuk
                    </a>

                @endauth

            </div>
        </div>
    </div>
</nav>

{{-- Main --}}
<main class="mx-auto min-h-[calc(100vh-128px)] w-full max-w-6xl px-4 py-8 sm:px-6 lg:px-8">

    {{-- Success --}}
    @if (session('success'))
        <div class="mb-6 flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            <svg class="mt-0.5 h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="m5.25 12.75 4.5 4.5 9-10.5"/>
            </svg>

            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- Error --}}
    @if (session('error'))
        <div class="mb-6 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            <svg class="mt-0.5 h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 9v3.75m0 3.75h.007M10.29 3.86 2.82 17.25A1.5 1.5 0 0 0 4.12 19.5h15.76a1.5 1.5 0 0 0 1.3-2.25L13.71 3.86a1.97 1.97 0 0 0-3.42 0Z"/>
            </svg>

            <span>{{ session('error') }}</span>
        </div>
    @endif

    @yield('content')

</main>

{{-- Footer --}}
<footer class="border-t border-brand-100 bg-white">
    <div class="mx-auto max-w-6xl px-4 py-6 text-center sm:px-6 lg:px-8">
        <p class="text-xs text-gray-400">
            &copy; {{ date('Y') }} Rasa Nusantara
        </p>

        <p class="mt-1 text-xs text-gray-400">
            Sistem Katering Nusantara V2
        </p>
    </div>
</footer>

@stack('scripts')


</body>
</html>
