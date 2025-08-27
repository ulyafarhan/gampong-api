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
    action="{{ isset($guide) ? route('admin.guides.update', $guide->id) : route('admin.guides.store') }}"
    method="POST">
    @csrf
    @if (isset($guide))
        @method('PUT')
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="mb-3">
                <label for="title" class="form-label">Judul Panduan*</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $guide->title ?? '') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi Singkat*</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description-editor" name="description" rows="5">{{ old('description', $guide->description ?? '') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="steps" class="form-label">Langkah-langkah*</label>
                <textarea class="form-control @error('steps') is-invalid @enderror" id="steps-editor" name="steps" rows="10">{{ old('steps', $guide->steps ?? '') }}</textarea>
                @error('steps')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Persyaratan (Checklist)</label>
                <div id="requirements-container">
                    @php
                        $requirements = old('requirements', isset($guide) ? json_decode($guide->requirements, true) : ['']);
                        if (empty($requirements)) $requirements = ['']; // Ensure at least one input
                    @endphp
                    @foreach($requirements as $index => $requirement)
                    <div class="input-group mb-2 requirement-input-group">
                        <input type="text" class="form-control" name="requirements[]" value="{{ $requirement }}">
                        <button type="button" class="btn btn-outline-danger remove-requirement-btn">Hapus</button>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-outline-primary btn-sm" id="add-requirement-btn">Tambah Persyaratan</button>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="estimated_time" class="form-label">Estimasi Waktu</label>
                        <input type="text" class="form-control @error('estimated_time') is-invalid @enderror" id="estimated_time" name="estimated_time" value="{{ old('estimated_time', $guide->estimated_time ?? '') }}">
                        @error('estimated_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="estimated_cost" class="form-label">Estimasi Biaya (Rp)</label>
                        <input type="number" class="form-control @error('estimated_cost') is-invalid @enderror" id="estimated_cost" name="estimated_cost" value="{{ old('estimated_cost', $guide->estimated_cost ?? '') }}" step="1000">
                         @error('estimated_cost')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="tips" class="form-label">Tips Tambahan</label>
                <textarea class="form-control" id="tips" name="tips" rows="3">{{ old('tips', $guide->tips ?? '') }}</textarea>
            </div>

        </div>
        <div class="card-footer text-end">
            <a href="{{ route('admin.guides.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-success">
                {{ isset($guide) ? 'Perbarui Panduan' : 'Simpan Panduan' }}
            </button>
        </div>
    </div>
</form>

@push('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // WYSIWYG Editors
        const commonConfig = {
            plugins: 'code table lists link',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | link',
            height: 300,
        };
        tinymce.init({
            selector: '#description-editor',
            ...commonConfig
        });
        tinymce.init({
            selector: '#steps-editor',
            ...commonConfig,
            height: 450
        });

        // Requirements management
        const container = document.getElementById('requirements-container');

        document.getElementById('add-requirement-btn').addEventListener('click', function() {
            const newReq = document.createElement('div');
            newReq.className = 'input-group mb-2 requirement-input-group';
            newReq.innerHTML = `
                <input type="text" class="form-control" name="requirements[]" value="">
                <button type="button" class="btn btn-outline-danger remove-requirement-btn">Hapus</button>
            `;
            container.appendChild(newReq);
        });

        container.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-requirement-btn')) {
                // Do not remove the last input field
                if (container.querySelectorAll('.requirement-input-group').length > 1) {
                    e.target.closest('.requirement-input-group').remove();
                } else {
                    // Clear the value of the last input field instead of removing it
                    e.target.closest('.requirement-input-group').querySelector('input').value = '';
                }
            }
        });
    });
</script>
@endpush
