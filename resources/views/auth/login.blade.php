@extends('layouts.app')

@section('title', 'Masuk')

@section('content')

<div class="mx-auto flex min-h-[70vh] max-w-md items-center justify-center">
    <div class="w-full">

```
    {{-- Header --}}
    <div class="mb-6 text-center">
        <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-brand-100 text-brand-700">
            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25V9m9.75 0H6m9.75 0a2.25 2.25 0 0 1 2.25 2.25v7.5A2.25 2.25 0 0 1 15.75 21h-7.5A2.25 2.25 0 0 1 6 18.75v-7.5A2.25 2.25 0 0 1 8.25 9m3.75 4.5v3"
                />
            </svg>
        </div>

        <h1 class="text-2xl font-bold tracking-tight text-brand-900">
            Selamat Datang
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Masuk ke akun Rasa Nusantara
        </p>
    </div>

    {{-- Card --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8">

        {{-- Error --}}
        @if ($errors->any())
            <div class="mb-5 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <svg class="mt-0.5 h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 9v3.75m0 3.75h.007M10.29 3.86 2.82 17.25A1.5 1.5 0 0 0 4.12 19.5h15.76a1.5 1.5 0 0 0 1.3-2.25L13.71 3.86a1.97 1.97 0 0 0-3.42 0Z"/>
                </svg>

                <div>
                    <p class="font-medium">Login gagal</p>
                    <p class="mt-0.5 text-red-600">
                        {{ $errors->first() }}
                    </p>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="mb-2 block text-sm font-medium text-gray-700">
                    Email
                </label>

                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21.75 6.75v10.5A2.25 2.25 0 0 1 19.5 19.5h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15A2.25 2.25 0 0 0 2.25 6.75m19.5 0-8.69 5.796a1.875 1.875 0 0 1-2.12 0L2.25 6.75"/>
                        </svg>
                    </div>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="email"
                        placeholder="nama@email.com"
                        class="w-full rounded-xl border-gray-300 py-2.5 pl-11 pr-4 text-sm shadow-sm transition placeholder:text-gray-400 focus:border-brand-500 focus:ring-brand-500"
                    >
                </div>
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="mb-2 block text-sm font-medium text-gray-700">
                    Password
                </label>

                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M16.5 10.5V7.875a4.5 4.5 0 0 0-9 0V10.5m-1.125 0h11.25A1.875 1.875 0 0 1 19.5 12.375v6.75A1.875 1.875 0 0 1 17.625 21h-11.25A1.875 1.875 0 0 1 4.5 19.125v-6.75A1.875 1.875 0 0 1 6.375 10.5Z"/>
                        </svg>
                    </div>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Masukkan password"
                        class="w-full rounded-xl border-gray-300 py-2.5 pl-11 pr-4 text-sm shadow-sm transition placeholder:text-gray-400 focus:border-brand-500 focus:ring-brand-500"
                    >
                </div>
            </div>

            {{-- Remember --}}
            <label class="flex cursor-pointer items-center gap-2.5 text-sm text-gray-600">
                <input
                    type="checkbox"
                    name="remember"
                    class="h-4 w-4 rounded border-gray-300 text-brand-600 focus:ring-brand-500"
                >
                <span>Ingat saya</span>
            </label>

            {{-- Submit --}}
            <button
                type="submit"
                class="flex w-full items-center justify-center gap-2 rounded-xl bg-brand-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25V9m9.75 0H6m9.75 0a2.25 2.25 0 0 1 2.25 2.25v7.5A2.25 2.25 0 0 1 15.75 21h-7.5A2.25 2.25 0 0 1 6 18.75v-7.5A2.25 2.25 0 0 1 8.25 9m3.75 4.5v3"/>
                </svg>

                Masuk
            </button>
        </form>

        {{-- Register --}}
        <div class="mt-6 border-t border-gray-100 pt-5 text-center">
            <p class="text-sm text-gray-500">
                Belum punya akun?
                <a
                    href="{{ route('register') }}"
                    class="font-semibold text-brand-700 transition hover:text-brand-900 hover:underline"
                >
                    Daftar sekarang
                </a>
            </p>
        </div>
    </div>



</div>


</div>
@endsection
