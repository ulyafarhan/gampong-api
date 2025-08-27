@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Tambah Berita Baru</h1>
    <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
</div>

{{-- The form partial will be included here.
    It doesn't need the $article variable passed for the create form. --}}
@include('admin.articles.form')

@endsection