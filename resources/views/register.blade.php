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
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-b from-green-500 to-green-100">
        <div class="w-full max-w-sm bg-white rounded-xl shadow-md p-4 sm:p-6 m-2">
            <div class="flex flex-col items-center space-y-3">
                <img src="{{ asset('images/Zephyr.png') }}" alt="Zephyr Sense Logo" class="w-24 h-auto">
                <h1 class="text-xl font-bold text-green-700">Selamat Datang</h1>
                <p class="text-xs text-gray-600 text-center">Register</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-4">
                @csrf
                <div class="space-y-3">
                    <div>
                        <label for="name" class="sr-only">Nama</label>
                        <div class="flex items-center bg-green-50 border border-green-200 rounded px-2 py-1.5">
                            <img src="{{ asset('images/name.png') }}" alt="Name Icon" class="w-4 h-4 mr-2">
                            <input id="name" name="name" type="text" required
                                class="w-full bg-transparent focus:outline-none text-sm text-green-900 placeholder-green-700"
                                placeholder="Nama">
                            @error('name')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="email" class="sr-only">Email</label>
                        <div class="flex items-center bg-green-50 border border-green-200 rounded px-2 py-1.5">
                            <img src="{{ asset('images/email.png') }}" alt="Email Icon" class="w-4 h-4 mr-2">
                            <input id="email" name="email" type="email" required
                                class="w-full bg-transparent focus:outline-none text-sm text-green-900 placeholder-green-700"
                                placeholder="Email">
                            @error('email')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <div class="flex items-center bg-green-50 border border-green-200 rounded px-2 py-1.5">
                            <img src="{{ asset('images/password.png') }}" alt="Password Icon" class="w-4 h-4 mr-2">
                            <input id="password" name="password" type="password" required
                                class="w-full bg-transparent focus:outline-none text-sm text-green-900 placeholder-green-700"
                                placeholder="Password">
                            @error('password')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex flex-col items-center space-y-2">
                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold text-sm py-1.5 rounded transition">
                        DAFTAR DAN MASUK
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
