<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:#f7f6e7;">

<div class="container mt-5 p-4 bg-white shadow rounded" style="max-width:800px;">
  <h3 class="mb-4 text-center">Edit Produk</h3>

  <!-- FORM EDIT PRODUK -->
  <form action="<?= BASEURL; ?>/admin/updateProduct/<?= $data['product']['id']; ?>" 
        method="POST" enctype="multipart/form-data">
    
    <!-- NAMA PRODUK -->
    <div class="mb-3">
      <label class="form-label">Nama Produk</label>
      <input type="text" name="nama_produk" class="form-control"
             value="<?= htmlspecialchars($data['product']['nama_produk']); ?>" required>
    </div>

    <!-- DESKRIPSI -->
    <div class="mb-3">
      <label class="form-label">Deskripsi</label>
      <textarea name="deskripsi" class="form-control" rows="3" required><?= htmlspecialchars($data['product']['deskripsi']); ?></textarea>
    </div>

    <!-- HARGA & STOK -->
    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label">Harga</label>
        <input type="number" name="harga" class="form-control"
               value="<?= intval($data['product']['harga']); ?>" min="0" step="1000" required>
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label">Stok</label>
        <input type="number" name="stok" class="form-control"
               value="<?= intval($data['product']['stok']); ?>" min="0" required>
      </div>
    </div>

    <!-- KATEGORI -->
    <div class="mb-3">
      <label class="form-label">Kategori</label>
      <select name="kategori" class="form-select" required>
        <option value="1" <?= $data['product']['id_kategori'] == 1 ? 'selected' : ''; ?>>Buku</option>
        <option value="2" <?= $data['product']['id_kategori'] == 2 ? 'selected' : ''; ?>>Giftbox</option>
        <option value="3" <?= $data['product']['id_kategori'] == 3 ? 'selected' : ''; ?>>Poster</option>
        <option value="4" <?= $data['product']['id_kategori'] == 4 ? 'selected' : ''; ?>>Clothes</option>
      </select>
    </div>

    <!-- FOTO PRODUK -->
    <div class="mb-3">
      <label class="form-label">Foto Produk</label><br>

      <!-- Gambar lama -->
      <div class="d-flex gap-3 mb-2">
        <?php if (!empty($data['product']['gambar'])): ?>
          <div class="text-center">
            <img src="<?= BASEURL; ?>/img/<?= htmlspecialchars($data['product']['gambar']); ?>" 
                 width="100" class="rounded shadow-sm mb-1">
            <p class="small text-muted">Gambar Utama</p>
          </div>
        <?php endif; ?>

        <?php if (!empty($data['product']['gambar2'])): ?>
          <div class="text-center">
            <img src="<?= BASEURL; ?>/img/<?= htmlspecialchars($data['product']['gambar2']); ?>" 
                 width="100" class="rounded shadow-sm mb-1">
            <p class="small text-muted">Gambar Hover</p>
          </div>
        <?php endif; ?>
      </div>

      <!-- Upload baru -->
      <input type="file" name="gambar[]" class="form-control" multiple accept="image/*">
      <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar (bisa pilih 1–2 file untuk gambar utama & hover).</small>
    </div>

    <!-- DISKON -->
    <div class="row align-items-center">
      <div class="col-md-6 mb-3">
        <div class="form-check">
          <input type="checkbox" name="diskon" id="diskon" class="form-check-input"
                 <?= $data['product']['diskon'] == 1 ? 'checked' : ''; ?>
                 onchange="toggleDiskon(this)">
          <label class="form-check-label" for="diskon">Aktifkan Diskon</label>
        </div>
      </div>

      <div class="col-md-6" id="diskon-container"
           style="display: <?= $data['product']['diskon'] == 1 ? 'block' : 'none'; ?>;">
        <label class="form-label">Persentase Diskon (%)</label>
        <input type="number" name="diskon_persen" class="form-control"
               value="<?= intval($data['product']['diskon_persen']); ?>" min="1" max="90">
      </div>
    </div>

    <!-- TOMBOL -->
    <div class="mt-4 text-center">
      <button type="submit" class="btn btn-success px-4">💾 Simpan Perubahan</button>
      <a href="<?= BASEURL; ?>/admin/dashboard" class="btn btn-secondary px-4">Kembali</a>
    </div>

  </form>
</div>

<script>
function toggleDiskon(cb) {
  document.getElementById('diskon-container').style.display = cb.checked ? 'block' : 'none';
}
</script>

</body>
</html>
