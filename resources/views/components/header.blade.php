<header x-data="{ open: false }" id="main-header" class="bg-white sticky top-0 z-50 transition-all duration-300 shadow-sm">
    <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center space-x-2">
            <svg class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="font-serif font-bold text-xl text-gray-800">Gampong Udeung</span>
        </a>

        {{-- Desktop Navigation --}}
        <div class="hidden md:flex items-center space-x-8 font-medium">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-primary">Beranda</a>
            <a href="{{ route('profile') }}" class="text-gray-600 hover:text-primary">Profil</a>
            <a href="#" class="text-gray-400 cursor-not-allowed" title="Segera Hadir">UMKM</a>
            <a href="{{ route('events.index') }}" class="text-gray-600 hover:text-primary">Agenda</a>
            <a href="{{ route('articles.index') }}" class="text-gray-600 hover:text-primary">Berita</a>
            <a href="{{ route('contact.create') }}" class="bg-primary text-white px-5 py-2 rounded-md hover:bg-primary-dark transition">Kontak</a>
        </div>

        {{-- Mobile Menu Button --}}
        <div class="md:hidden">
            <button @click="open = !open" class="text-gray-600 hover:text-primary focus:outline-none">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </nav>

    {{-- Mobile Menu --}}
    <div x-show="open" x-transition class="md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-white hover:bg-primary">Beranda</a>
            <a href="{{ route('profile') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-white hover:bg-primary">Profil</a>
            <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 cursor-not-allowed" title="Segera Hadir">UMKM</a>
            <a href="{{ route('events.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-white hover:bg-primary">Agenda</a>
            <a href="{{ route('articles.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-white hover:bg-primary">Berita</a>
            <a href="{{ route('contact.create') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-white hover:bg-primary">Kontak</a>
        </div>
    </div>
</header>
