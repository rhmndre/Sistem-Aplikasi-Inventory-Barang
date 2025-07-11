<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .bg-image {
            background-image: url('{{ asset('bg_inventory.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-image">
        <div class="w-full sm:max-w-md px-6 py-4 bg-white/90 backdrop-blur-sm shadow-2xl overflow-hidden sm:rounded-2xl">
            <div class="mb-8 text-center">
                <img src="{{ asset('Logo-PAMR.png') }}" alt="Logo PAMR" class="mx-auto h-24 w-auto transform hover:scale-105 transition-transform duration-300">
                <h2 class="mt-6 text-3xl font-bold text-gray-900">Selamat Datang</h2>
                <p class="mt-2 text-sm text-gray-600">Silakan masuk ke akun Anda</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                {{ csrf_field() }}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
                    <div class="mt-2 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </div>
                        <x-text-input id="email" class="block mt-1 w-full pl-10" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Masukkan email Anda" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700" />
                    <div class="mt-2 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <x-text-input id="password" class="block mt-1 w-full pl-10"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="Masukkan password Anda" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Ingat Saya') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-600 hover:text-indigo-500" href="{{ route('password.request') }}">
                            {{ __('Lupa password?') }}
                        </a>
                    @endif
                </div>

                <div class="mt-6">
                    <x-primary-button class="w-full justify-center py-3 bg-indigo-600 hover:bg-indigo-700 transition-colors duration-200">
                        {{ __('Masuk') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Add CSRF token to all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>
</html>
