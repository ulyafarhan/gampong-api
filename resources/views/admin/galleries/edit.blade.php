@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Edit Item Galeri: {{ $gallery->title }}</h1>
    <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
</div>

@include('admin.galleries.form', ['gallery' => $gallery])

@endsection
