<x-layout>
    <nav class="fixed w-full z-50 bg-green-500">
        <div class="flex h-16 items-center px-4 justify-center">
            <h1 class="text-white text-xl font-semibold">History</h1>
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