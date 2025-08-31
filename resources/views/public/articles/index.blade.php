@extends('layouts.public')

@section('title', 'Berita & Pengumuman')

@section('content')
<section class="text-center mb-12">
    <h1 class="text-4xl md:text-5xl font-extrabold font-serif text-green-800">Berita & Pengumuman</h1>
    <p class="text-lg text-gray-700 max-w-2xl mx-auto mt-4">
        Informasi terkini tentang kegiatan, program, dan pengumuman penting dari pemerintahan Gampong Udeung.
    </p>
</section>

<section>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($articles as $article)
            <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col transform hover:-translate-y-2 transition-transform duration-300">
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-56 object-cover">
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-xl font-bold font-serif mb-3 flex-grow">{{ $article->title }}</h3>
                    <div class="flex justify-between items-center mt-auto text-sm text-gray-500">
                        <span>{{ $article->created_at->format('d F Y') }}</span>
                        <a href="{{ route('articles.show', $article) }}" class="font-bold text-green-700 hover:text-green-900">Baca Selengkapnya →</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500 col-span-full">Belum ada berita yang dipublikasikan.</p>
        @endforelse
    </div>

    {{-- Paginasi --}}
    <div class="mt-12">
        {{ $articles->links() }}
    </div>
</section>
@endsection