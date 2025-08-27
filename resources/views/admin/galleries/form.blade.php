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
    action="{{ isset($gallery) ? route('admin.galleries.update', $gallery->id) : route('admin.galleries.store') }}"
    method="POST"
    enctype="multipart/form-data">
    @csrf
    @if (isset($gallery))
        @method('PUT')
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="mb-3">
                <label for="title" class="form-label">Judul*</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $gallery->title ?? '') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $gallery->description ?? '') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Tipe Media*</label>
                <select class="form-select @error('type') is-invalid @enderror" id="type" name="type">
                    <option value="image" @if(old('type', $gallery->type ?? 'image') == 'image') selected @endif>Gambar</option>
                    <option value="video" @if(old('type', $gallery->type ?? '') == 'video') selected @endif>Video (URL)</option>
                </select>
                @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Conditional Fields --}}
            <div id="image-input-container" class="mb-3">
                <label for="url_image" class="form-label">File Gambar*</label>
                <input type="file" class="form-control @error('url_image') is-invalid @enderror" id="url_image" name="url_image" accept="image/*">
                @error('url_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if (isset($gallery) && $gallery->type == 'image' && $gallery->url)
                    <div class="mt-2">
                        <small>Gambar saat ini:</small><br>
                        <img src="{{ Storage::url($gallery->url) }}" alt="Gambar {{ $gallery->title }}" style="max-height: 150px;">
                    </div>
                @endif
            </div>

            <div id="video-input-container" class="mb-3">
                <label for="url_video" class="form-label">URL Video*</label>
                <input type="url" class="form-control @error('url_video') is-invalid @enderror" id="url_video" name="url_video" value="{{ old('url_video', ($gallery->type ?? '') == 'video' ? $gallery->url : '') }}" placeholder="https://www.youtube.com/watch?v=...">
                @error('url_video')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>
        <div class="card-footer text-end">
            <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-success">
                {{ isset($gallery) ? 'Perbarui Item' : 'Simpan Item' }}
            </button>
        </div>
    </div>
</form>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const typeSelect = document.getElementById('type');
        const imageInputContainer = document.getElementById('image-input-container');
        const videoInputContainer = document.getElementById('video-input-container');

        function toggleInputs() {
            if (typeSelect.value === 'image') {
                imageInputContainer.style.display = 'block';
                videoInputContainer.style.display = 'none';
            } else {
                imageInputContainer.style.display = 'none';
                videoInputContainer.style.display = 'block';
            }
        }

        // Initial state
        toggleInputs();

        // On change
        typeSelect.addEventListener('change', toggleInputs);
    });
</script>
@endpush
