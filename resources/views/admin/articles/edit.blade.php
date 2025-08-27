@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Edit Berita</h1>
    <a href="{{ url('admin/articles') }}" class="btn btn-secondary">Kembali ke Daftar</a>
</div>

@include('admin.articles.form')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('article-form');
        const articleId = {{ $article->id }}; // Menggunakan PHP untuk mendapatkan ID artikel
        const token = document.querySelector('meta[name="csrf-token"]').content;

        // Fetch data artikel yang akan diedit
        async function fetchArticleData() {
            try {
                const response = await fetch(`/api/admin/articles/${articleId}`, {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${token}`
                    }
                });
                const data = await response.json();
                
                if (data.status === 'success') {
                    // Isi formulir dengan data yang diambil
                    document.getElementById('title').value = data.data.title;
                    document.getElementById('content').value = data.data.content;
                    if (data.data.is_published) {
                        document.getElementById('is_published').checked = true;
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Gagal memuat data artikel.');
            }
        }
        
        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            const formData = new FormData(form);
            formData.append('_method', 'PUT'); // Penting untuk metode PUT/PATCH
            
            try {
                const response = await fetch(`/api/articles/${articleId}`, {
                    method: 'POST', // Menggunakan POST dengan _method=PUT
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${token}`
                        'X-CSRF-TOKEN': token
                    },
                    body: formData,
                });

                const data = await response.json();

                if (response.ok) {
                    alert('Artikel berhasil diperbarui!');
                    window.location.href = '/admin/articles';
                } else {
                    alert('Gagal memperbarui artikel. Cek konsol untuk detail.');
                    console.error(data);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengirim data.');
            }
        });
        
        fetchArticleData();
    });
</script>
@endsection