@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Manajemen Berita & Pengumuman</h1>
    <a href="{{ url('admin/articles/create') }}" class="btn btn-primary">Tambah Berita Baru</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="articles-table-body">
                </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus artikel ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const articlesTableBody = document.getElementById('articles-table-body');
        let articleIdToDelete = null;

        const token = document.querySelector('meta[name="csrf-token"]').content;

        async function fetchArticles() {
            try {
                const response = await fetch('/api/admin/articles', {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${token}` // Menggunakan token Sanctum jika ada
                    }
                });
                const data = await response.json();

                if (data.status === 'success') {
                    renderArticles(data.data);
                } else {
                    alert('Gagal memuat data artikel.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat berkomunikasi dengan server.');
            }
        }

        function renderArticles(articles) {
            articlesTableBody.innerHTML = '';
            if (articles.length === 0) {
                articlesTableBody.innerHTML = '<tr><td colspan="5" class="text-center">Tidak ada artikel.</td></tr>';
                return;
            }

            articles.forEach((article, index) => {
                const row = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${article.title}</td>
                        <td>${new Date(article.created_at).toLocaleDateString()}</td>
                        <td>${article.is_published ? '<span class="badge bg-success">Published</span>' : '<span class="badge bg-warning">Draft</span>'}</td>
                        <td>
                            <a href="/admin/articles/${article.id}/edit" class="btn btn-sm btn-info text-white">Edit</a>
                            <button class="btn btn-sm btn-danger delete-btn" data-id="${article.id}" data-bs-toggle="modal" data-bs-target="#deleteModal">Hapus</button>
                        </td>
                    </tr>
                `;
                articlesTableBody.innerHTML += row;
            });

            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function () {
                    articleIdToDelete = this.getAttribute('data-id');
                });
            });
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', async function () {
            if (articleIdToDelete) {
                try {
                    const response = await fetch(`/api/articles/${articleIdToDelete}`, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': `Bearer ${token}`
                        }
                    });
                    const data = await response.json();

                    if (data.status === 'success') {
                        alert('Artikel berhasil dihapus!');
                        const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
                        deleteModal.hide();
                        fetchArticles(); // Refresh tabel
                    } else {
                        alert('Gagal menghapus artikel.');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus artikel.');
                }
            }
        });

        fetchArticles(); // Panggil saat halaman dimuat
    });
</script>
@endsection