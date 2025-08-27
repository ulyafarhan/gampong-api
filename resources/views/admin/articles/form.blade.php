@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form
    action="{{ isset($article) ? route('admin.articles.update', $article->id) : route('admin.articles.store') }}"
    method="POST"
    enctype="multipart/form-data">
    @csrf
    @if (isset($article))
        @method('PUT')
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="mb-3">
                <label for="title" class="form-label">Judul Berita*</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $article->title ?? '') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Isi Berita*</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content-editor" name="content" rows="10">{{ old('content', $article->content ?? '') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Gambar Utama</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if (isset($article) && $article->image)
                    <div class="mt-2">
                        <small>Gambar saat ini:</small><br>
                        <img src="{{ Storage::url($article->image) }}" alt="Gambar {{ $article->title }}" style="max-height: 150px;">
                    </div>
                @endif
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="is_published" name="is_published" value="1" @if(old('is_published', $article->is_published ?? false)) checked @endif>
                <label class="form-check-label" for="is_published">Publikasikan Langsung</label>
            </div>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-success">
                {{ isset($article) ? 'Perbarui Artikel' : 'Simpan Artikel' }}
            </button>
        </div>
    </div>
</form>

@push('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        tinymce.init({
            selector: '#content-editor',
            plugins: 'code table lists image link',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | image link',
            // Simple image upload setup
            images_upload_url: '{{ route('admin.articles.store') }}', // This needs a dedicated image upload handler
            images_upload_handler: (blobInfo, progress) => new Promise((resolve, reject) => {
                // This is a placeholder. A real implementation needs a dedicated route
                // that accepts an image, stores it, and returns a JSON with the location.
                // For now, we will prevent the default upload and show an alert.
                reject('Fungsi unggah gambar dari editor belum diimplementasikan. Silakan gunakan field "Gambar Utama".');
            }),
            height: 400,
        });
    });
</script>
@endpush