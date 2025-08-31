@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Tambah Kegiatan Baru</h1>
    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
</div>

@include('admin.events.form')

@endsection
