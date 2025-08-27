@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Manajemen Struktur Pemerintahan</h1>
    <a href="{{ route('admin.government-structures.create') }}" class="btn btn-primary">Tambah Anggota Baru</a>
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
                        <th>Urutan</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($members as $member)
                        <tr>
                            <td>{{ $member->order }}</td>
                            <td>
                                @if($member->image)
                                    <img src="{{ Storage::url($member->image) }}" alt="{{ $member->name }}" style="max-height: 50px; max-width: 50px; object-fit: cover;">
                                @else
                                    <span class="text-muted">No-Image</span>
                                @endif
                            </td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->position }}</td>
                            <td>
                                <a href="{{ route('admin.government-structures.edit', $member) }}" class="btn btn-sm btn-info text-white">Edit</a>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $member->id }}">
                                    Hapus
                                </button>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal-{{ $member->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $member->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel-{{ $member->id }}">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus data: <strong>{{ $member->name }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('admin.government-structures.destroy', $member) }}" method="POST">
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
                            <td colspan="5" class="text-center">Tidak ada data anggota pemerintahan ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
