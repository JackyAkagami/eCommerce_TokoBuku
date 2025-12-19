<?php
$order = $data['order'] ?? null;
$items = $data['items'] ?? [];
?>

<div style="background:#f7f6e7; min-height:100vh; padding-top:20px;">
  <div class="order-wrapper">

    <!-- HEADER -->
    <div class="order-header">
      <div class="order-header-left">
        <h2>Detail Pesanan</h2>
        <p>Informasi lengkap transaksi pelanggan</p>
      </div>
      <div class="order-header-right">
        <a href="<?= BASEURL; ?>/pesanan" class="btn-back">
            <span class="icon">←</span>
            <span>Kembali ke Order History</span>
        </a>

      </div>
    </div>

    <?php if (!$order): ?>
      <div class="order-card">
        <p>Data pesanan tidak ditemukan.</p>
      </div>
    <?php else: ?>

    <!-- INFO UTAMA -->
    <div class="order-grid">

      <!-- KIRI: INFO CUSTOMER -->
      <div class="order-card">
        <div class="order-card-title">Informasi Pesanan</div>

        <div class="order-info-row">
          <span>Nama Customer</span>
          <strong><?= htmlspecialchars($order['nama_user']); ?></strong>
        </div>

        <div class="order-info-row">
          <span>Tanggal Pesanan</span>
          <strong><?= date('d M Y H:i', strtotime($order['tanggal_order'])); ?></strong>
        </div>

        <div class="order-info-row">
          <span>Total Pembayaran</span>
          <strong class="order-total">
            Rp <?= number_format($order['total_harga'],0,',','.'); ?>
          </strong>
        </div>
      </div>

      <!-- KANAN: STATUS -->
      <div class="order-card">
        <div class="order-card-title">Status Pesanan</div>

        <form action="<?= BASEURL; ?>/pesanan/updateStatus" method="post">
          <input type="hidden" name="order_id" value="<?= $order['id']; ?>">

          <select name="status" class="order-select">
            <?php
            $statuses = [
              'pending'   => 'Menunggu',
              'paid'      => 'Dibayar',
              'shipped'   => 'Dikirim',
              'completed' => 'Selesai',
              'canceled'  => 'Dibatalkan'
            ];
            foreach ($statuses as $key => $label):
            ?>
              <option value="<?= $key; ?>" <?= $order['status']===$key?'selected':''; ?>>
                <?= $label; ?>
              </option>
            <?php endforeach; ?>
          </select>

          <button class="btn-primary-full" type="submit">
            Simpan Perubahan
          </button>
        </form>
      </div>

    </div>

    <!-- PRODUK -->
    <div class="order-card">
      <div class="order-card-title">Produk Dipesan</div>

      <table class="order-table">
        <thead>
          <tr>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($items as $i): ?>
          <tr>
            <td><?= htmlspecialchars($i['nama_produk']); ?></td>
            <td><?= $i['jumlah']; ?></td>
            <td>Rp <?= number_format($i['harga_satuan'],0,',','.'); ?></td>
            <td>Rp <?= number_format($i['subtotal'],0,',','.'); ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <?php endif; ?>

  </div>
</div>

<style>
.order-wrapper { max-width:1100px; margin:0 auto 60px; padding:0 15px; }
.order-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
.order-header h2 { margin:0; font-size:26px; }
.order-header p { margin:4px 0 0; font-size:13px; color:#6b7280; }

.order-grid {
  display:grid;
  grid-template-columns: 2fr 1fr;
  gap:18px;
  margin-bottom:18px;
}

.order-card {
  background:#fff;
  border-radius:14px;
  padding:18px 20px;
  box-shadow:0 8px 25px rgba(15,23,42,.06);
}

.order-card-title {
  font-size:18px;
  font-weight:600;
  margin-bottom:14px;
}

.order-info-row {
  display:flex;
  justify-content:space-between;
  padding:8px 0;
  border-bottom:1px dashed #e5e7eb;
  font-size:14px;
}

.order-info-row:last-child { border-bottom:none; }

.order-total {
  color:#111827;
  font-size:16px;
}

.order-select {
  width:100%;
  padding:10px;
  border-radius:10px;
  border:1px solid #d1d5db;
  margin-bottom:12px;
  font-size:14px;
}

.btn-primary-full {
  width:100%;
  padding:10px;
  border-radius:999px;
  border:none;
  background:#f9a826;
  color:#fff;
  font-weight:600;
  cursor:pointer;
}

.order-table {
  width:100%;
  border-collapse:collapse;
  font-size:13px;
}

.order-table th {
  text-align:left;
  padding:10px;
  background:#faf5dd;
  color:#6b7280;
}

.order-table td {
  padding:10px;
  border-bottom:1px solid #f3f4f6;
}

.btn-back {
  display:inline-flex;
  align-items:center;
  gap:8px;
  padding:8px 16px;
  border-radius:999px;
  background:#374151;
  border:1px solid #e5e7eb;
  font-size:13px;
  font-weight:500;
  color:#fff;
  text-decoration:none;
  transition:all .2s ease;
  box-shadow:0 3px 10px rgba(0,0,0,.05);
}

.btn-back .icon {
  font-size:16px;
}

.btn-back:hover {
  background:#f9a826;
  color:#fff;
  border-color:#f9a826;
  transform:translateX(-2px);
}


@media(max-width:768px){
  .order-grid { grid-template-columns:1fr; }
}
</style>
