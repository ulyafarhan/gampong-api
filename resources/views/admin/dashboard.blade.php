@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Dasbor</h1>
</div>

<div class="alert alert-info">
    @if (Auth::check())
        Selamat datang kembali, <strong>{{ Auth::user()->name }}</strong>!
    @else
        Selamat datang!
    @endif
    Anda telah login sebagai admin.
</div>

<div class="row">
    {{-- Articles Card --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Berita & Pengumuman</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">12</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-newspaper fs-2 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Guides Card --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Panduan Administrasi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">5</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-book-half fs-2 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Events Card --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Kalender Kegiatan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">8</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-calendar-event fs-2 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Galleries Card --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Galeri</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">25</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-images fs-2 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Adding some custom styles for the cards to match the example --}}
<style>
.card.border-left-primary { border-left: 0.25rem solid #4e73df !important; }
.card.border-left-success { border-left: 0.25rem solid #1cc88a !important; }
.card.border-left-info { border-left: 0.25rem solid #36b9cc !important; }
.card.border-left-warning { border-left: 0.25rem solid #f6c23e !important; }
.text-gray-300 { color: #dddfeb !important; }
.text-gray-800 { color: #5a5c69 !important; }
.font-weight-bold { font-weight: 700 !important; }
.text-xs { font-size: 0.7rem; }
</style>
@endsection