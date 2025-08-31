@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Manajemen Galeri</h1>
    <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">Tambah Item Baru</a>
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
                        <th>Preview</th>
                        <th>Judul</th>
                        <th>Tipe</th>
                        <th>Tanggal</th>
                        <th style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($galleries as $gallery)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($gallery->type == 'image')
                                    <img src="{{ Storage::url($gallery->url) }}" alt="{{ $gallery->title }}" style="max-height: 50px; max-width: 100px;">
                                @else
                                    <a href="{{ $gallery->url }}" target="_blank">Lihat Video</a>
                                @endif
                            </td>
                            <td>{{ $gallery->title }}</td>
                            <td>
                                @if ($gallery->type == 'image')
                                    <span class="badge bg-info">Gambar</span>
                                @else
                                    <span class="badge bg-danger">Video</span>
                                @endif
                            </td>
                            <td>{{ $gallery->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('admin.galleries.edit', $gallery) }}" class="btn btn-sm btn-info text-white">Edit</a>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $gallery->id }}">
                                    Hapus
                                </button>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal-{{ $gallery->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $gallery->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel-{{ $gallery->id }}">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus item: <strong>{{ $gallery->title }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST">
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
                            <td colspan="6" class="text-center">Tidak ada item galeri ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
