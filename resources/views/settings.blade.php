<x-layout>
    <nav class="fixed w-full z-50 bg-green-500">
        <div class="flex h-16 items-center px-4 justify-between">
            <a href="{{ route('home') }}" class="hidden sm:flex">
                <img src="{{ asset('images/home.png') }}" alt="Home" class="h-8 w-auto">
            </a>
            <h1 class="text-white text-xl font-semibold justify-self-center">Settings</h1>
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
                <a href="{{ route('setting') }}">
                    <img src="{{ asset('images/settings.png') }}" alt="Settings" class="h-8 w-auto">
                </a>
            </div>
        </div>
    </nav>
    <div class="pt-16">
        <div class="shadow-md mx-4 mb-8 mt-4 rounded-md p-6 bg-gray-100">
            <h1 class="text-4xl font-semibold">{{ $user->name }}</h1>
            <p>{{ $user->email }}</p>
        </div>
    </div>
    <form method="POST" action="{{route('logout')}}">
        @csrf
        <button type='submit' class="flex m-4 border-2 border-red-500 text-red-500 justify-center rounded-md p-4 hover:bg-red-500 hover:text-white transition-colors duration-300">
            Keluar
        </button>
    </form>
</x-layout>
