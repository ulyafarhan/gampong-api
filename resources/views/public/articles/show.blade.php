@extends('layouts.public')

@section('title', $article->title)

@section('content')
<div class="max-w-4xl mx-auto">
    <article>
        <header class="mb-8">
            <h1 class="text-4xl md:text-5xl font-extrabold font-serif text-green-800 mb-4">{{ $article->title }}</h1>
            <p class="text-gray-500">
                <i class="bi bi-calendar-fill me-2"></i>Dipublikasikan pada {{ $article->created_at->format('d F Y') }}
            </p>
        </header>

        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-auto max-h-[500px] object-cover rounded-lg shadow-lg mb-8">

        <div class="prose max-w-none text-lg text-gray-800">
            {!! $article->content !!}
        </div>
    </article>

    <aside class="mt-16 pt-8 border-t">
        <h2 class="text-3xl font-bold font-serif mb-6">Berita Lainnya</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($latestArticles as $item)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-40 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-bold font-serif mb-2">{{ $item->title }}</h3>
                    <a href="{{ route('articles.show', $item) }}" class="font-bold text-sm text-green-700 hover:text-green-900">Baca Selengkapnya →</a>
                </div>
            </div>
            @endforeach
        </div>
    </aside>
</div>
@endsection