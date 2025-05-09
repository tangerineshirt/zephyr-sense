<x-layout>
    <nav class="fixed w-full z-50 {{ $colorClass }}">
        <div class="flex h-16 items-center px-4 justify-between">
            <a href="{{ route('home') }}" class="hidden sm:flex">
                <img src="{{ asset('images/home.png') }}" alt="Home" class="h-8 w-auto">
            </a>
            <h1 class="text-white text-xl font-semibold justify-self-center">Zephyr's</h1>
            <div class="hidden sm:flex space-x-4">
                <a href="{{ route('history') }}" class="flex items-center">
                    <div class="flex flex-col items-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <!-- Lingkaran luar jam -->
                            <circle cx="12" cy="12" r="10" />
                            <!-- Jarum jam (pendek) -->
                            <line x1="12" y1="12" x2="12" y2="8" />
                            <!-- Jarum menit (panjang) -->
                            <line x1="12" y1="12" x2="16" y2="12" />
                        </svg>
                    </div>
                </a>
                <a href="{{route('setting')}}">
                    <img src="{{asset('images/settings.png')}}" alt="Settings" class="h-8 w-auto">
                </a>
            </div>
        </div>
    </nav>
    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 pt-16">
        <div class="flex flex-col">
            <div
                class="mt-4 {{ $colorClass }} flex flex-col justify-between text-white mx-4 rounded-t-md p-4 shadow-md">
                <div class="flex justify-baseline font-bold">
                    <h1>Kualitas Udara</h1>
                </div>
                <div class="flex-row justify-items-center">
                    <h1 class="text-6xl lg:text-8xl font-semibold py-4">{{ $air->air_quality }}</h1>
                    <h3 class="mt-4">Terakhir diperbarui: {{ $air->created_at }}</h3>
                </div>
            </div>
            <div class="flex mx-4 mb-4 rounded-b-md justify-between p-4 shadow-md h-28 items-center">
                <div class="flex-1">
                    <p class="gas-text">PM2.5</p>
                    <p class="justify-self-center">{{ $air->pm25 }} µg/m³</p>
                    <hr class="small-line {{ $border }}">
                </div>
                <div class="flex-1">
                    <p class="gas-text">NO2</p>
                    <p class="justify-self-center">{{ $air->no2 }} ppb</p>
                    <hr class="small-line {{ $border }}">
                </div>
                <div class="flex-1">
                    <p class="gas-text">CO</p>
                    <p class="justify-self-center">{{ $air->co }} ppm</p>
                    <hr class="small-line {{ $border }}">
                </div>
            </div>
        </div>

        <div>
            <div class="rounded-md shadow-md p-4 mx-4 text-green-900 mb-4 mt-4">
                <h1 class="font-semibold text-xl">Kondisi Lingkungan</h1>
                <div class="flex mt-4">
                    <div class="flex-1 {{ $kondisi }} mr-2 rounded-md p-8">
                        <div>
                            <p class="justify-self-center">Suhu</p>
                            <h1 class="justify-self-center text-3xl font-semibold">{{ $air->temp }}°C</h1>
                        </div>
                    </div>
                    <div class="flex-1 {{ $kondisi }} ml-2 rounded-md p-8">
                        <div>
                            <p class="justify-self-center">Kelembaban</p>
                            <h1 class="justify-self-center text-3xl font-semibold">{{ $air->humidity }}%</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-md shadow-md p-4 mx-4 mb-4">
                <h1 class="font-semibold text-green-900 text-xl">Status Air Purifier</h1>
                <div class="flex justify-start">
                    <div>
                        <img src="{{ asset('images/breeze.png') }}" alt="Breeze" class="h-16 w-auto">
                    </div>
                    <div class="flex-col items-center">
                        <h1 class="font-semibold text-xl mt-4">{{ $purifier }}</h1>
                        <p class="text-gray-500 text-sm">{{ $statusPurifier }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=" {{ $colorClass }} flex-row text-white mx-4 rounded-t-md p-4 shadow-md">
        <div class="flex justify-baseline font-bold">
            <h1>Tips dan Rekomendasi</h1>
        </div>
    </div>
    <div class=" mx-4 @if ($air->air_quality !== 'Hazardous') mb-20 md:mb-4 @endif rounded-b-md p-4 shadow-md space-y-2">
        <div class="flex justify-start space-x-1">
            <img src="{{ asset('images/info.png') }}" alt="Info" class="w-auto h-4">
            <p class="text-xs text-gray-500">{{ $tip1 }}</p>
        </div>
        @if ($air->air_quality !== 'Hazardous')
            <div class="flex justify-start space-x-1">
                <img src="{{ asset('images/clip.png') }}" alt="Clip" class="w-auto h-4">
                <p class="text-xs text-gray-500">{{ $tip2 }}</p>
            </div>
        @endif
    </div>
    @if ($air->air_quality == 'Hazardous')
        <div class="bg-red-600 text-white px-4 py-2 flex items-center space-x-3 pb-18 sm:pb-2">
            <!-- Ikon Warning -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01M10.29 3.86l-7.6 13.18A1 1 0 003.38 19h17.24a1 1 0 00.87-1.5l-7.6-13.18a1 1 0 00-1.74 0z" />
            </svg>

            <!-- Teks -->
            <div>
                <p class="font-bold">PERINGATAN: Kualitas Udara Berbahaya!</p>
                <p class="text-sm">Disarankan untuk segera mengungsi ke area yg lebih aman.</p>
            </div>
        </div>
    @endif
</x-layout>
