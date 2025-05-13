<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('images/Zephyr.png') }}" type="image/png">
    <title>Zephyr</title>

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="h-screen flex items-center justify-center bg-gradient-to-b from-green-500 to-green-100">
        <div class="w-full max-w-sm bg-white rounded-xl shadow-md p-4 sm:p-6 m-2">
            <div class="flex flex-col items-center space-y-3">
                <img src="{{ asset('images/Zephyr.png') }}" alt="Zephyr Sense Logo" class="w-24 h-auto">
                <h1 class="text-xl font-bold text-green-700">Selamat Datang</h1>
                <p class="text-xs text-gray-600 text-center">Pantau Kualitas Udara Anda</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
                @csrf

                <div class="space-y-3">
                    <div>
                        <label for="email" class="sr-only">Email</label>
                        <div class="flex items-center bg-green-50 border border-green-200 rounded px-2 py-1.5">
                            <img src="{{ asset('images/email.png') }}" alt="Email Icon" class="w-4 h-4 mr-2">
                            <input id="email" name="email" type="email" required
                                class="w-full bg-transparent text-sm focus:outline-none text-green-900 placeholder-green-700"
                                placeholder="Email">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <div class="flex items-center bg-green-50 border border-green-200 rounded px-2 py-1.5">
                            <img src="{{ asset('images/password.png') }}" alt="Password Icon" class="w-4 h-4 mr-2">
                            <input id="password" name="password" type="password" required
                                class="w-full bg-transparent text-sm focus:outline-none text-green-900 placeholder-green-700"
                                placeholder="Password">
                        </div>
                    </div>
                </div>
                @error('email')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
                <div class="flex flex-col items-center space-y-2">
                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold text-sm py-1.5 rounded transition">
                        MASUK
                    </button>
                </div>

                <div class="flex items-center w-full my-2">
                    <hr class="flex-grow border-gray-300">
                    <span class="mx-2 text-gray-500 text-xs">atau</span>
                    <hr class="flex-grow border-gray-300">
                </div>

                <p class="text-xs text-gray-700 text-center">
                    Belum punya akun?
                    <a href="{{ route('show.register') }}" class="font-medium text-green-600 hover:underline">
                        Daftar Sekarang
                    </a>
                </p>
            </form>
        </div>
    </div>

</body>

</html>
