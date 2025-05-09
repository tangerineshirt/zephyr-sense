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
        <div class="w-full max-w-md md:max-w-2xl bg-white rounded-2xl shadow-xl p-8 md:p-12 m-4">
            <div class="flex flex-col items-center space-y-4">
                {{-- Logo App --}}
                <img src="{{ asset('images/Zephyr.png') }}" alt="Zephyr Sense Logo" class="w-32 h-auto">
                {{-- TODO: Ganti logo.png dengan logo asli di folder public/images --}}

                <h1 class="text-2xl md:text-3xl font-bold text-green-700">Selamat Datang</h1>
                <p class="text-sm md:text-base text-gray-600 text-center">Pantau Kualitas Udara Anda</p>
            </div>

            <form method="POST" action="{{route('login')}}" class="mt-8 space-y-6">
                @csrf

                <div class="space-y-4">
                    <div>
                        <label for="email" class="sr-only">Email</label>
                        <div class="flex items-center bg-green-50 border border-green-200 rounded-lg px-3 py-2">
                            {{-- Email Icon --}}
                            <img src="{{ asset('images/email.png') }}" alt="Email Icon" class="w-5 h-5 mr-2">
                            {{-- TODO: Ganti email-icon.png dengan ikon email yang sesuai --}}
                            <input id="email" name="email" type="email" required
                                class="w-full bg-transparent focus:outline-none text-sm text-green-900 placeholder-green-700"
                                placeholder="Email">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <div class="flex items-center bg-green-50 border border-green-200 rounded-lg px-3 py-2">
                            {{-- Password Icon --}}
                            <img src="{{ asset('images/password.png') }}" alt="Password Icon" class="w-5 h-5 mr-2">
                            {{-- TODO: Ganti password-icon.png dengan ikon gembok/password --}}
                            <input id="password" name="password" type="password" required
                                class="w-full bg-transparent focus:outline-none text-sm text-green-900 placeholder-green-700"
                                placeholder="Password">
                        </div>
                    </div>
                </div>
                <div class="flex flex-col items-center space-y-2">
                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition">
                        MASUK
                    </button>
                </div>
                <div class="flex items-center w-full my-2">
                    <hr class="flex-grow border-gray-300">
                    <span class="mx-2 text-gray-500 text-sm">atau</span>
                    <hr class="flex-grow border-gray-300">
                </div>
                <p class="text-sm text-gray-700 justify-self-center">
                    Belum punya akun?
                    <a href="{{ route('show.register') }}" class="font-semibold text-green-600 hover:underline">
                        Daftar Sekarang
                    </a>
                </p>
            </form>
        </div>
    </div>
</body>

</html>