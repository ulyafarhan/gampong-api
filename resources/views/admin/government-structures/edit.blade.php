@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Edit Anggota: {{ $governmentStructure->name }}</h1>
    <a href="{{ route('admin.government-structures.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
</div>

@include('admin.government-structures.form', ['governmentStructure' => $governmentStructure])

@endsection
