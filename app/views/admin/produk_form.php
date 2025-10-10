<!-- Judul form -->
<!-- Jika ada data produk (edit), tampilkan "Edit Produk", kalau tidak tampilkan "Tambah Produk" -->
<h2><?= isset($data['produk']) ? 'Edit Produk' : 'Tambah Produk'; ?></h2>

<!-- Form untuk tambah/edit produk -->
<form method="POST">
    <!-- Input nama produk -->
    <label>Nama Produk</label><br>
    <!-- Jika mode edit, isi otomatis dengan nilai dari $data['produk']['nama_produk'] -->
    <input type="text" name="nama_produk" value="<?= $data['produk']['nama_produk'] ?? ''; ?>"><br>

    <!-- Input deskripsi produk -->
    <label>Deskripsi</label><br>
    <!-- Jika edit, isi otomatis dengan deskripsi produk -->
    <textarea name="deskripsi"><?= $data['produk']['deskripsi'] ?? ''; ?></textarea><br>

    <!-- Input harga produk -->
    <label>Harga</label><br>
    <input type="number" name="harga" value="<?= $data['produk']['harga'] ?? ''; ?>"><br>

    <!-- Input stok produk -->
    <label>Stok</label><br>
    <input type="number" name="stok" value="<?= $data['produk']['stok'] ?? ''; ?>"><br>

    <!-- Input gambar produk -->
    <label>Gambar</label><br>
    <!-- Bisa berupa URL atau path file gambar -->
    <input type="text" name="gambar" value="<?= $data['produk']['gambar'] ?? ''; ?>"><br><br>

    <!-- Tombol submit untuk menyimpan produk -->
    <button type="submit">Simpan</button>
</form>
