@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Edit Panduan: {{ $guide->title }}</h1>
    <a href="{{ route('admin.guides.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
</div>

@include('admin.guides.form', ['guide' => $guide])

@endsection
