@props([
    'image' => 'https://picsum.photos/400/300',
    'title' => 'Judul Default',
    'date' => null,
    'description' => 'Deskripsi default singkat untuk kartu ini.',
    'url' => '#',
])

<div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:transform hover:-translate-y-2 hover:shadow-xl" data-aos="fade-up">
    <a href="{{ $url }}">
        <img src="{{ $image }}" alt="Gambar untuk {{ $title }}" class="w-full h-48 object-cover">
    </a>
    <div class="p-6">
        @if($date)
        <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($date)->translatedFormat('d F Y') }}</span>
        @endif
        <h3 class="font-serif font-bold text-xl my-2">
            <a href="{{ $url }}" class="hover:text-primary">{{ $title }}</a>
        </h3>
        <p class="text-gray-700 text-base line-clamp-3">
            {{ $description }}
        </p>
        <a href="{{ $url }}" class="text-primary hover:text-primary-dark font-semibold mt-4 inline-block">
            Baca Selengkapnya &rarr;
        </a>
    </div>
</div>

<style>
    .line-clamp-3 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
    }
</style>
