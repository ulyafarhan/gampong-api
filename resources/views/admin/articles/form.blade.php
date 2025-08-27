<form id="article-form">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Judul Berita</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Isi Berita</label>
        <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Gambar (Opsional)</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="is_published" name="is_published" value="1">
        <label class="form-check-label" for="is_published">Publikasikan Langsung</label>
    </div>
    <button type="submit" class="btn btn-success">Simpan Artikel</button>
</form>