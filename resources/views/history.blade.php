<x-layout>
    <nav class="fixed w-full z-50 bg-green-500">
        <div class="flex h-16 items-center px-4 justify-between">
            <a href="{{ route('home') }}" class="hidden sm:flex">
                <img src="{{ asset('images/home.png') }}" alt="Home" class="h-8 w-auto">
            </a>
            <h1 class="text-white text-xl font-semibold justify-self-center">History</h1>
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
    <div class="p-4 pt-18">
        <h2 class="text-xl font-semibold mb-4">Histori Perubahan Kualitas Udara (3 Hari Terakhir)</h2>
    
        <ul class="space-y-3">
            @forelse ($history as $item)
                <li class="p-4 rounded shadow flex justify-between items-center border-l-4
                    @if ($item->air_quality === 'Good') border-green-500 bg-green-100
                    @elseif ($item->air_quality === 'Moderate') border-yellow-500 bg-yellow-100
                    @elseif ($item->air_quality === 'Poor') border-orange-500 bg-orange-100
                    @else border-red-500 bg-red-100
                    @endif">
                    <div>
                        <p class="font-semibold">{{ $item->air_quality }}</p>
                        <p class="text-sm text-gray-500">{{ $item->created_at->format('d M Y, H:i:s') }}</p>
                    </div>
                </li>
            @empty
                <p>Tidak ada perubahan status udara dalam 3 hari terakhir.</p>
            @endforelse
        </ul>
    </div>
</x-layout>