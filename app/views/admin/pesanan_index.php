<?php
$orders = $data['pesanan'] ?? [];
?>

<!-- atur background sama seperti halaman admin lain -->
<div style="background:#f7f6e7; min-height:100vh; padding-top:20px;">
  <div class="order-wrapper">

    <!-- HEADER HALAMAN -->
    <div class="order-header">
      <div class="order-header-left">
        <h2>Order History</h2>
        <p>Daftar semua pesanan yang masuk ke toko Anda.</p>
      </div>
      <div class="order-header-right">
        <a href="<?= BASEURL; ?>/admin/dashboard" class="btn-back">
          &larr; Kembali ke Dashboard
        </a>
      </div>
    </div>

    <!-- RINGKASAN -->
    <div class="order-card">
      <div class="order-card-header">
        <div>
          <div class="order-card-title">Ringkasan Pesanan</div>
          <div class="order-card-subtitle">
            Total <?= count($orders); ?> pesanan tercatat di sistem.
          </div>
        </div>
      </div>
    </div>

    <!-- LIST PESANAN -->
    <div class="order-card">
      <div class="order-card-header">
        <div>
          <div class="order-card-title">List Pesanan</div>
          <div class="order-card-subtitle">
            Urut dari pesanan terbaru.
          </div>
        </div>
      </div>

      <div class="order-table-wrapper">
        <table class="order-table">
          <thead>
          <tr>
            <th>Nama customer</th>
            <th>Produk</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Status</th>
            <th style="width: 110px;">Aksi</th>
          </tr>
          </thead>
          <tbody>
          <?php if (empty($orders)): ?>
            <tr>
              <td colspan="6" class="order-empty">
                Belum ada pesanan masuk.
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($orders as $o): ?>
              <?php
              $statusRaw   = strtolower($o['status']);
              $statusClass = 'order-status-waiting';
              $statusLabel = ucfirst($statusRaw);

              if (in_array($statusRaw, ['dibayar','paid','selesai','completed'])) {
                  $statusClass = 'order-status-success';
              } elseif (in_array($statusRaw, ['batal','cancel','cancelled'])) {
                  $statusClass = 'order-status-danger';
              }
              ?>
              <tr>
                <!-- NAMA CUSTOMER -->
                <td data-label="Nama customer">
                  <div class="order-buyer-name">
                    <?= htmlspecialchars($o['nama_user']); ?>
                  </div>
                  <?php if (!empty($o['email'])): ?>
                    <div class="order-buyer-email">
                      <?= htmlspecialchars($o['email']); ?>
                    </div>
                  <?php endif; ?>
                </td>

                <!-- PRODUK -->
                <td data-label="Produk">
                  <?php if (!empty($o['items'])): ?>
                    <?php foreach (explode('||', $o['items']) as $item): ?>
                      <div style="font-size:12px; margin-bottom:2px;">
                        • <?= htmlspecialchars($item); ?>
                      </div>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <span class="order-date">Tidak ada data produk</span>
                  <?php endif; ?>
                </td>

                <!-- TANGGAL -->
                <td data-label="Tanggal">
                  <span class="order-date">
                    <?= date('d M Y H:i', strtotime($o['tanggal_order'])); ?>
                  </span>
                </td>

                <!-- TOTAL -->
                <td data-label="Total">
                  <span class="order-total">
                    Rp <?= number_format($o['total_harga'], 0, ',', '.'); ?>
                  </span>
                </td>

                <!-- STATUS -->
                <td data-label="Status">
                  <span class="order-status-badge <?= $statusClass; ?>">
                    <?= $statusLabel; ?>
                  </span>
                </td>

                <!-- AKSI -->
                <td data-label="Aksi">
                  <a href="<?= BASEURL; ?>/pesanan/detail/<?= $o['id']; ?>"
                     class="btn-small-primary">
                    Detail
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<style>
.order-wrapper {
    max-width: 1100px;
    margin: 0 auto 60px;
    padding: 0 15px;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
}

/* Header halaman */
.order-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 18px;
}
.order-header-left h2 {
    margin: 0;
    font-size: 26px;
    font-weight: 600;
    color: #111827;
}
.order-header-left p {
    margin: 4px 0 0;
    font-size: 13px;
    color: #6b7280;
}
.order-header-right {
    display: flex;
    gap: 10px;
}

/* Tombol */
.btn-back {
    padding: 8px 16px;
    border-radius: 999px;
    border: none;
    background: #4b5563;
    color: #ffffff;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
}
.btn-back:hover {
    background: #374151;
}
.btn-small-primary {
    padding: 6px 11px;
    border-radius: 999px;
    border: none;
    background: #f9a826;
    color: #ffffff;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
}

/* Card */
.order-card {
    background: #ffffff;
    border-radius: 14px;
    padding: 18px 20px;
    box-shadow: 0 8px 25px rgba(15, 23, 42, 0.06);
    border: 1px solid #f1f5f9;
    margin-bottom: 18px;
}

/* Header card */
.order-card-header {
    display: flex;
    align-items: baseline;
    justify-content: space-between;
    margin-bottom: 10px;
}
.order-card-title {
    font-size: 18px;
    font-weight: 600;
    color: #111827;
}
.order-card-subtitle {
    font-size: 12px;
    color: #6b7280;
}

/* Tabel */
.order-table-wrapper {
    overflow-x: auto;
}
.order-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}
.order-table thead th {
    text-align: left;
    padding: 10px 12px;
    background: #faf5dd;
    color: #6b7280;
    font-weight: 600;
    border-bottom: 1px solid #e5e7eb;
    white-space: nowrap;
}
.order-table tbody td {
    padding: 10px 12px;
    border-bottom: 1px solid #f3f4f6;
    vertical-align: middle;
}

/* Isi kolom */
.order-buyer-name {
    font-weight: 500;
    color: #111827;
}
.order-buyer-email {
    font-size: 12px;
    color: #9ca3af;
}
.order-date {
    font-size: 12px;
    color: #4b5563;
}
.order-total {
    font-weight: 600;
    color: #111827;
}

/* Status badge */
.order-status-badge {
    display: inline-flex;
    align-items: center;
    padding: 3px 9px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 600;
}
.order-status-waiting {
    background: #fef3c7;
    color: #92400e;
}
.order-status-success {
    background: #dcfce7;
    color: #166534;
}
.order-status-danger {
    background: #fee2e2;
    color: #b91c1c;
}

/* Empty state */
.order-empty {
    text-align: center;
    padding: 24px 10px;
    color: #9ca3af;
    font-size: 13px;
}

/* Responsive: mobile card style */
@media (max-width: 768px) {
    .order-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    .order-card {
        padding: 14px 14px;
    }
    .order-table thead {
        display: none;
    }
    .order-table tbody tr {
        display: block;
        margin-bottom: 10px;
        border-radius: 12px;
        background: #ffffff;
        box-shadow: 0 4px 12px rgba(15,23,42,0.05);
    }
    .order-table tbody td {
        display: flex;
        justify-content: space-between;
        border-bottom: 0;
        padding: 8px 10px;
        font-size: 12px;
    }
    .order-table tbody td::before {
        content: attr(data-label);
        font-weight: 600;
        color: #6b7280;
        margin-right: 8px;
    }
}
</style>
