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
    {{ $slot }}
    @php
        $currentRoute = Route::currentRouteName();
    @endphp

    <div class="fixed bottom-0 w-full bg-white border-t shadow-md flex justify-around items-center h-16 z-50 md:hidden">
        <a href="{{route('home')}}">
            <div class="flex flex-col items-center {{ $currentRoute === 'home' ? 'text-black' : 'text-gray-400' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
                <span class="text-xs">Home</span>
            </div>
        </a>
        <a href="{{route('history')}}">
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
        <a href="">
            <div class="flex flex-col items-center text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11.25 2.25c.966 0 1.75.784 1.75 1.75v.48a6.78 6.78 0 0 1 1.648.677l.34-.34a1.75 1.75 0 0 1 2.475 0l.084.084a1.75 1.75 0 0 1 0 2.475l-.34.34c.278.522.51 1.08.677 1.648h.48c.966 0 1.75.784 1.75 1.75v.168c0 .966-.784 1.75-1.75 1.75h-.48a6.78 6.78 0 0 1-.677 1.648l.34.34a1.75 1.75 0 0 1 0 2.475l-.084.084a1.75 1.75 0 0 1-2.475 0l-.34-.34a6.78 6.78 0 0 1-1.648.677v.48c0 .966-.784 1.75-1.75 1.75h-.168a1.75 1.75 0 0 1-1.75-1.75v-.48a6.78 6.78 0 0 1-1.648-.677l-.34.34a1.75 1.75 0 0 1-2.475 0l-.084-.084a1.75 1.75 0 0 1 0-2.475l.34-.34a6.78 6.78 0 0 1-.677-1.648h-.48a1.75 1.75 0 0 1-1.75-1.75v-.168c0-.966.784-1.75 1.75-1.75h.48a6.78 6.78 0 0 1 .677-1.648l-.34-.34a1.75 1.75 0 0 1 0-2.475l.084-.084a1.75 1.75 0 0 1 2.475 0l.34.34a6.78 6.78 0 0 1 1.648-.677v-.48c0-.966.784-1.75 1.75-1.75h.168zM12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5z" />
                </svg>
                <span class="text-xs">Settings</span>
            </div>
        </a>
    </div>
</body>

</html>
