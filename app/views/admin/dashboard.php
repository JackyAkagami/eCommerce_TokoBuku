<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>

  <!-- ✅ Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- ✅ Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f7f6e7;
      font-family: 'Poppins', sans-serif;
    }
    .wrapper {
      display: flex;
      min-height: 100vh;
    }
    .sidebar {
      width: 260px;
      background-color: #f1efdc;
      padding: 25px 15px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .sidebar h3 {
      font-weight: 700;
      color: #333;
      margin-bottom: 25px;
    }
    .sidebar a {
      display: flex;
      align-items: center;
      padding: 10px 15px;
      border-radius: 10px;
      color: #333;
      text-decoration: none;
      margin-bottom: 8px;
      transition: all 0.2s ease;
      font-size: 14px;
    }
    .sidebar a:hover {
      background-color: #d9d8c3;
    }
    .sidebar a i {
      margin-right: 10px;
      font-size: 16px;
    }
    .sidebar .bottom {
      border-top: 1px solid #ccc;
      padding-top: 10px;
      margin-top: 20px;
    }
    .content {
      flex-grow: 1;
      padding: 30px 40px;
    }
    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    .btn-upload {
      background-color: #6c7253;
      color: #fff;
      border: none;
      padding: 8px 20px;
      border-radius: 8px;
    }
    .btn-upload:hover {
      background-color: #4d5339;
    }
    .table-container {
      background-color: #fff;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .table th {
      background-color: #f8f8ee;
    }
  </style>
</head>

<body>
<div class="wrapper">
  <!-- Sidebar -->
  <div class="sidebar">
    <div>
      <h3>Nadi Admin</h3>
      <a href="<?= BASEURL; ?>/admin/dashboard"><i class="bi bi-box"></i> Products</a>
      <a href="<?= BASEURL; ?>/pesanan"><i class="bi bi-clock-history"></i> Order history</a>
      <a href="#"><i class="bi bi-cash-coin"></i> Finance</a>
      <a href="#"><i class="bi bi-clipboard-data"></i> Report</a>
      <a href="#"><i class="bi bi-gear"></i> Access management</a>
    </div>
    <div class="bottom">
      <a href="#"><i class="bi bi-sliders"></i> Settings</a>
      <a href="<?= BASEURL; ?>/auth/logout"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
  </div>

  <!-- Content -->
  <div class="content">
    <div class="topbar">
      <h2>Product Management</h2>
      <!-- ✅ Tombol memicu modal -->
      <button class="btn-upload" data-bs-toggle="modal" data-bs-target="#addProductModal">
        + Upload
      </button>
    </div>

    <!-- Tabel Produk -->
    <div class="table-container mt-3">
      <h5>List Produk</h5>
      <table class="table table-bordered mt-3 align-middle text-center">
        <thead>
          <tr>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Kategori</th>
            <th>Diskon</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data['products'] as $p): ?>
          <tr>
            <td><?= htmlspecialchars($p['nama_produk']); ?></td>
            <td>Rp <?= number_format($p['harga'], 0, ',', '.'); ?></td>
            <td><?= $p['stok']; ?></td>
            <!-- ✅ Perbaikan disini -->
            <td><?= htmlspecialchars($p['nama_kategori'] ?? '-'); ?></td>
            <td>
              <?php if ($p['diskon'] == 1): ?>
                <span class="badge bg-success"><?= $p['diskon_persen']; ?>%</span>
              <?php else: ?>
                <span class="badge bg-secondary">-</span>
              <?php endif; ?>
            </td>
            <td>
              <a href="<?= BASEURL; ?>/admin/editProduct/<?= $p['id']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
              <a href="<?= BASEURL; ?>/admin/deleteProduct/<?= $p['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk ini?')"><i class="bi bi-trash"></i></a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div> <!-- end content -->
</div> <!-- end wrapper -->


<!-- ✅ Modal Tambah Produk -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style="border-radius: 15px;">
      <form action="<?= BASEURL; ?>/admin/uploadProduct" method="POST" enctype="multipart/form-data">
        <div class="modal-header" style="background-color:#f1efdc;">
          <h5 class="modal-title fw-bold" id="addProductModalLabel">Tambah Produk Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Nama Produk</label>
              <input type="text" name="nama_produk" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Stok</label>
              <input type="number" name="stok" class="form-control" required>
            </div>
           <div class="col-md-6">
              <label class="form-label">Foto Produk (max 2 gambar)</label>
              <input type="file" name="gambar[]" class="form-control" accept="image/*" multiple required>
              <small class="text-muted">Gunakan Ctrl untuk pilih dua foto sekaligus (utama & hover)</small>
            </div>
            <div class="col-md-6">
              <label class="form-label">Harga</label>
              <input type="number" name="harga" class="form-control" required step="1000" min="0">
            </div>

            <div class="col-12">
              <label class="form-label">Deskripsi</label>
              <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
            </div>

            <div class="col-md-6">
              <label class="form-label">Kategori</label>
              <select name="kategori" class="form-select" required>
                <option value="1">Buku</option>
                <option value="2">Giftbox</option>
                <option value="3">Poster</option>
                <option value="4">Clothes</option>
              </select>
            </div>

            <div class="col-md-6">
              <div class="form-check mt-4">
                <input type="checkbox" name="diskon" class="form-check-input" id="diskon" onchange="toggleDiskon(this)">
                <label class="form-check-label" for="diskon">Aktifkan Diskon</label>
              </div>
              <div id="diskon-container" style="display:none;">
                <label class="form-label mt-2">Persentase Diskon (%)</label>
                <input type="number" name="diskon_persen" class="form-control" min="1" max="90" value="10">
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success px-4">Simpan</button>
          <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- ✅ Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
function toggleDiskon(cb) {
  document.getElementById('diskon-container').style.display = cb.checked ? 'block' : 'none';
}
</script>

</body>
</html>
