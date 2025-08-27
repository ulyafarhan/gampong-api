@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Manajemen Kalender Kegiatan</h1>
    <a href="{{ route('admin.events.create') }}" class="btn btn-primary">Tambah Kegiatan Baru</a>
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
                        <th>Judul Kegiatan</th>
                        <th>Lokasi</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($events as $event)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $event->title }}</td>
                            <td>{{ $event->location ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($event->start_time)->format('d M Y, H:i') }}</td>
                            <td>{{ $event->end_time ? \Carbon\Carbon::parse($event->end_time)->format('d M Y, H:i') : '-' }}</td>
                            <td>
                                <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-info text-white">Edit</a>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $event->id }}">
                                    Hapus
                                </button>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal-{{ $event->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $event->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel-{{ $event->id }}">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus kegiatan: <strong>{{ $event->title }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('admin.events.destroy', $event) }}" method="POST">
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
                            <td colspan="6" class="text-center">Tidak ada kegiatan ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
