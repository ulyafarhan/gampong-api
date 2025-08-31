@extends('layouts.public', ['title' => 'Galeri Dokumentasi'])

@section('content')

{{-- Page Header --}}
<section class="bg-primary text-white py-16">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl font-serif font-bold" data-aos="fade-up">Galeri Dokumentasi</h1>
        <p class="text-lg mt-2" data-aos="fade-up" data-aos-delay="100">Momen-momen penting dari berbagai kegiatan yang telah berlangsung di Gampong Udeung.</p>
    </div>
</section>

{{-- Gallery Grid --}}
<section class="py-16 bg-secondary-default">
    <div class="container mx-auto px-6">
        @if($galleries->isEmpty())
            <div class="text-center py-12">
                <h2 class="text-2xl font-semibold">Galeri Masih Kosong</h2>
                <p class="text-gray-600 mt-2">Saat ini belum ada foto atau video yang ditambahkan ke galeri.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" x-data="{ open: false, imageUrl: '' }">
                @foreach($galleries as $item)
                    <div class="group relative" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                        @if($item->type == 'image')
                            <a href="#" @click.prevent="open = true; imageUrl = '{{ Storage::url($item->url) }}'">
                                <img src="{{ Storage::url($item->url) }}" alt="{{ $item->title }}" class="w-full h-64 object-cover rounded-lg shadow-md transition-transform duration-300 group-hover:scale-105">
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                                    <p class="text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-center p-4">{{ $item->title }}</p>
                                </div>
                            </a>
                        @else
                            <a href="{{ $item->url }}" target="_blank" rel="noopener noreferrer">
                                <div class="w-full h-64 rounded-lg shadow-md bg-gray-800 flex flex-col items-center justify-center text-white p-4">
                                     <svg class="w-16 h-16 mb-4" fill="currentColor" viewBox="0 0 24 24"><path d="M21.582,6.186c-0.23-0.86-0.908-1.538-1.768-1.768C18.267,4,12,4,12,4S5.733,4,4.186,4.418C3.326,4.648,2.648,5.326,2.418,6.186C2,7.733,2,12,2,12s0,4.267,0.418,5.814c0.23,0.86,0.908,1.538,1.768,1.768C5.733,20,12,20,12,20s6.267,0,7.814-0.418c0.86-0.23,1.538-0.908,1.768-1.768C22,16.267,22,12,22,12S22,7.733,21.582,6.186z M10,15.464V8.536L16,12L10,15.464z"/></svg>
                                    <p class="text-center font-semibold">{{ $item->title }}</p>
                                    <p class="text-xs text-gray-400 mt-2">Klik untuk melihat video</p>
                                </div>
                            </a>
                        @endif
                    </div>
                @endforeach

                {{-- Lightbox Modal --}}
                <div x-show="open" @click.away="open = false" @keydown.escape.window="open = false" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75 p-4" style="display: none;">
                    <div class="relative">
                        <img :src="imageUrl" alt="Lightbox Image" class="max-w-full max-h-[90vh] rounded-lg shadow-lg">
                        <button @click="open = false" class="absolute -top-4 -right-4 h-10 w-10 bg-white rounded-full text-gray-800 flex items-center justify-center">&times;</button>
                    </div>
                </div>
            </div>

            {{-- Pagination Links --}}
            <div class="mt-12">
                {{ $galleries->links() }}
            </div>
        @endif
    </div>
</section>

@endsection
