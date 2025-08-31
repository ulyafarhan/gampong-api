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
    action="{{ isset($governmentStructure) ? route('admin.government-structures.update', $governmentStructure->id) : route('admin.government-structures.store') }}" 
    method="POST" 
    enctype="multipart/form-data">
    @csrf
    @if (isset($governmentStructure))
        @method('PUT')
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap*</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $governmentStructure->name ?? '') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="position" class="form-label">Jabatan*</label>
                <input type="text" class="form-control @error('position') is-invalid @enderror" id="position" name="position" value="{{ old('position', $governmentStructure->position ?? '') }}" required>
                @error('position')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="order" class="form-label">Nomor Urut*</label>
                <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', $governmentStructure->order ?? 0) }}" required>
                 @error('order')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Digunakan untuk mengurutkan tampilan di halaman publik.</div>
            </div>
            
            <div class="mb-3">
                <label for="image" class="form-label">Foto</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if (isset($governmentStructure) && $governmentStructure->image)
                    <div class="mt-2">
                        <small>Foto saat ini:</small><br>
                        <img src="{{ Storage::url($governmentStructure->image) }}" alt="Foto {{ $governmentStructure->name }}" style="max-height: 150px;">
                    </div>
                @endif
            </div>

        </div>
        <div class="card-footer text-end">
            <a href="{{ route('admin.government-structures.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-success">
                {{ isset($governmentStructure) ? 'Perbarui Data' : 'Simpan Data' }}
            </button>
        </div>
    </div>
</form>
@push('scripts')
@endpush