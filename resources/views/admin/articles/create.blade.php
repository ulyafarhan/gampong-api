@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Tambah Berita Baru</h1>
    <a href="{{ url('admin/articles') }}" class="btn btn-secondary">Kembali ke Daftar</a>
</div>

@include('admin.articles.form')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('article-form');
        const token = document.querySelector('meta[name="csrf-token"]').content;

        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            const formData = new FormData(form);
            
            try {
                const response = await fetch('/api/articles', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${token}`
                        'X-CSRF-TOKEN': token
                    },
                    body: formData,
                });

                const data = await response.json();

                if (response.status === 201) {
                    alert('Artikel berhasil dibuat!');
                    window.location.href = '/admin/articles';
                } else {
                    alert('Gagal membuat artikel. Cek konsol untuk detail.');
                    console.error(data);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengirim data.');
            }
        });
    });
</script>
@endsection