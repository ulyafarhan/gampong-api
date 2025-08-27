@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Edit Berita: {{ $article->title }}</h1>
    <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
</div>

{{-- Pass the existing $article object to the form partial --}}
@include('admin.articles.form', ['article' => $article])

@endsection