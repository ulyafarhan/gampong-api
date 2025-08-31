@extends('layouts.public')

@section('title', 'Panduan: ' . $guide->title)

@section('content')
<div class="max-w-4xl mx-auto">
    <article>
        <header class="mb-8 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold font-serif text-green-800">{{ $guide->title }}</h1>
        </header>
        <div class="prose max-w-none text-lg text-gray-800 bg-white p-8 rounded-lg shadow-lg">
            {!! $guide->content !!}
        </div>
    </article>
     <div class="text-center mt-12">
        <a href="{{ route('guides.index') }}" class="bg-green-700 text-white font-bold py-3 px-6 rounded-lg shadow hover:bg-green-800 transition-colors">
            ← Kembali ke Semua Panduan
        </a>
    </div>
</div>
@endsection