@extends('layouts.public', ['title' => 'Berita & Pengumuman'])

@section('content')

{{-- Page Header --}}
<section class="bg-primary text-white py-16">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl font-serif font-bold" data-aos="fade-up">Berita & Pengumuman</h1>
        <p class="text-lg mt-2" data-aos="fade-up" data-aos-delay="100">Ikuti informasi dan kegiatan terbaru dari Gampong Udeung.</p>
    </div>
</section>

{{-- Articles Grid --}}
<section class="py-16 bg-secondary-default">
    <div class="container mx-auto px-6">
        @if($articles->isEmpty())
            <div class="text-center py-12">
                <h2 class="text-2xl font-semibold">Belum Ada Berita</h2>
                <p class="text-gray-600 mt-2">Saat ini belum ada berita atau pengumuman yang dipublikasikan. Silakan kembali lagi nanti.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($articles as $article)
                    <x-card
                        :image="$article->image ? Storage::url($article->image) : 'https://picsum.photos/400/300?random=' . $loop->index"
                        :title="$article->title"
                        :date="$article->created_at"
                        :description="$article->summary"
                        :url="route('articles.show', $article)"
                    />
                @endforeach
            </div>

            {{-- Pagination Links --}}
            <div class="mt-12">
                {{ $articles->links() }}
            </div>
        @endif
    </div>
</section>

@endsection
