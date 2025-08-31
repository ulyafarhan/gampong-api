@extends('layouts.public', ['title' => $article->title])

@section('content')

{{-- Article Header --}}
<section class="bg-white pt-16">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-serif font-bold text-gray-900 leading-tight" data-aos="fade-up">{{ $article->title }}</h1>
        <p class="text-gray-500 mt-4" data-aos="fade-up" data-aos-delay="100">
            Dipublikasikan pada {{ $article->created_at->translatedFormat('d F Y') }}
        </p>
    </div>
</section>

{{-- Article Image --}}
@if($article->image)
<section class="py-8 bg-white">
    <div class="container mx-auto px-6" data-aos="fade-up" data-aos-delay="200">
        <img src="{{ Storage::url($article->image) }}" alt="Gambar untuk {{ $article->title }}" class="w-full max-w-4xl mx-auto rounded-lg shadow-lg">
    </div>
</section>
@endif

{{-- Main Content --}}
<section class="py-12 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-3xl mx-auto">
            {{-- Using prose class from tailwind typography for nice article styling --}}
            <div class="prose lg:prose-xl max-w-none text-gray-800" data-aos="fade-up">
                {!! $article->content !!}
            </div>
        </div>
    </div>
</section>


{{-- Related Articles --}}
@if($relatedArticles->isNotEmpty())
<section class="py-16 bg-secondary-default">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-serif font-bold text-center mb-12">Berita Lainnya</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($relatedArticles as $relatedArticle)
                <x-card
                    :image="$relatedArticle->image ? Storage::url($relatedArticle->image) : 'https://picsum.photos/400/300?random=' . $loop->index"
                    :title="$relatedArticle->title"
                    :date="$relatedArticle->created_at"
                    :description="$relatedArticle->summary"
                    :url="route('articles.show', $relatedArticle)"
                />
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Prose styles for article content --}}
<style>
    .prose h1, .prose h2, .prose h3 {
        font-family: 'Merriweather', serif;
        font-weight: 700;
    }
    .prose p, .prose li {
        font-family: 'Inter', sans-serif;
    }
    .prose img {
        border-radius: 0.5rem;
        margin-top: 2em;
        margin-bottom: 2em;
    }
    .prose blockquote {
        border-left-color: #047857; /* primary color */
        font-style: italic;
    }
</style>
@endsection
