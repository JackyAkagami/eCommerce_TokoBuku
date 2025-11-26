<div class="container product-detail">

    <!-- Tombol Kembali di kanan atas -->
    <div class="back-button-wrapper">
        <a href="<?= BASEURL; ?>/produk" class="btn-back">Kembali</a>
    </div>

    <!-- Nama produk sebagai judul -->
    <h2 class="product-title"><?= htmlspecialchars($data['product']['nama_produk']); ?></h2>

    <div class="detail-content">
        <!-- Gambar produk -->
        <div class="image-wrapper">
            <img src="<?= BASEURL; ?>/img/<?= htmlspecialchars($data['product']['gambar']); ?>"
                alt="<?= htmlspecialchars($data['product']['nama_produk']); ?>">
        </div>

        <!-- Info produk -->
        <div class="info-wrapper">
          <a href="<?= BASEURL; ?>/cart/add/<?= $data['product']['id']; ?>"
   class="btn-add-detail">
   + Tambah ke Keranjang
</a>
            <p><strong>Kategori:</strong> <?= htmlspecialchars($data['product']['nama_kategori']); ?></p>
            <p><strong>Deskripsi:</strong> <?= nl2br(htmlspecialchars($data['product']['deskripsi'])); ?></p>
            <p><strong>Harga:</strong> Rp <?= number_format($data['product']['harga'], 0, ',', '.'); ?></p>
            <p><strong>Stok:</strong> <?= intval($data['product']['stok']); ?></p>
        </div>
    </div>
</div>

<style>
    .product-detail {
  max-width: 1000px;
  margin: 40px auto 80px;
  padding: 0 60px;
  font-family: Arial, sans-serif;
  color: #333;
}

/* Tombol kembali posisinya ke kanan atas */
.back-button-wrapper {
  display: flex;
  justify-content: flex-end;
  margin-bottom: 15px;
}

.btn-back {
  padding: 8px 14px;
  background-color: #586053;
  color: white;
  border-radius: 6px;
  text-decoration: none;
  font-weight: 600;
  transition: background-color 0.3s ease;
}

.btn-back:hover {
  background-color: #758064;
}

/* Judul produk */
.product-title {
  font-size: 32px;
  font-weight: 700;
  margin-bottom: 30px;
  color: #444;
}

/* Container gambar dan info sejajar */
.detail-content {
  display: flex;
  gap: 50px;
  flex-wrap: wrap;
}

/* Gambar produk */
.image-wrapper {
  flex: 1 1 300px;
  max-width: 420px;
  background: #f7f7f7;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  text-align: center;
}

.image-wrapper img {
  width: 100%;
  height: auto;
  object-fit: contain;
  display: block;
}

/* Info produk */
.info-wrapper {
  flex: 1 1 320px;
  font-size: 18px;
  line-height: 1.6;
}

.info-wrapper p {
  margin-bottom: 18px;
}

.info-wrapper strong {
  color: #586053;
}

.btn-add-detail {
  display: inline-block;
  margin-top: 15px;
  padding: 10px 18px;
  background: #586053;
  color: white;
  border-radius: 8px;
  text-decoration: none;
  font-size: 16px;
  font-weight: 600;
}

.btn-add-detail:hover {
  background: #758064;
}
</style>