@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Manajemen Panduan Administrasi</h1>
    <a href="{{ route('admin.guides.create') }}" class="btn btn-primary">Tambah Panduan Baru</a>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Judul Panduan</th>
                        <th>Estimasi Waktu</th>
                        <th>Estimasi Biaya</th>
                        <th style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($guides as $guide)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $guide->title }}</td>
                            <td>{{ $guide->estimated_time ?? '-' }}</td>
                            <td>Rp {{ number_format($guide->estimated_cost ?? 0, 2, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('admin.guides.edit', $guide) }}" class="btn btn-sm btn-info text-white">Edit</a>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $guide->id }}">
                                    Hapus
                                </button>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal-{{ $guide->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $guide->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel-{{ $guide->id }}">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus panduan: <strong>{{ $guide->title }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('admin.guides.destroy', $guide) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada panduan ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
