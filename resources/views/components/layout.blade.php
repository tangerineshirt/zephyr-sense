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

<body class="bg-green-50">
    {{ $slot }}
    @php
        $currentRoute = Route::currentRouteName();
    @endphp

    <div class="fixed bottom-0 w-full bg-white border-t shadow-md flex justify-around items-center h-16 z-50 md:hidden">
        <a href="{{ route('home') }}">
            <div class="flex flex-col items-center {{ $currentRoute === 'home' ? 'text-black' : 'text-gray-400' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
                <span class="text-xs">Home</span>
            </div>
        </a>
        <a href="{{ route('history') }}">
            <div class="flex flex-col items-center {{ $currentRoute === 'history' ? 'text-black' : 'text-gray-400' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <!-- Lingkaran luar jam -->
                    <circle cx="12" cy="12" r="10" />
                    <!-- Jarum jam (pendek) -->
                    <line x1="12" y1="12" x2="12" y2="8" />
                    <!-- Jarum menit (panjang) -->
                    <line x1="12" y1="12" x2="16" y2="12" />
                </svg>

                <span class="text-xs">History</span>
            </div>
        </a>
        <a href="{{ route('setting') }}">
            <div class="flex flex-col items-center {{ $currentRoute === 'setting' ? 'text-black' : 'text-gray-400' }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                    <path
                        d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33h.06a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09c0 .66.39 1.26 1 1.51h.06a1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82v.06c.23.63.84 1.06 1.51 1.06H21a2 2 0 1 1 0 4h-.09c-.66 0-1.26.39-1.51 1z" />
                    <circle cx="12" cy="12" r="3" />
                </svg>
                <span class="text-xs">Settings</span>
            </div>
        </a>
    </div>
</body>

</html>
