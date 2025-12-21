<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Report Penjualan</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
      margin-bottom: 25px;
      color: #333;
    }
    .sidebar a {
      display: block;
      padding: 10px 15px;
      border-radius: 10px;
      margin-bottom: 8px;
      color: #333;
      text-decoration: none;
      transition: 0.2s;
    }
    .sidebar a:hover {
      background-color: #d8d7c5;
    }
    .content {
      flex-grow: 1;
      padding: 30px 40px;
    }
    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
    }
    .card-box {
      border-radius: 12px;
      background-color: #fff;
      padding: 20px;
      box-shadow: 0 1px 4px rgba(0,0,0,0.1);
      margin-bottom: 25px;
    }
    .table thead {
      background: #eef0ea;
      font-weight: 600;
    }
    .status-badge.approved {
      background: #4caf50;
      color: #fff;
      padding: 5px 10px;
      border-radius: 8px;
      font-size: 12px;
    }
    .status-badge.rejected {
      background: #f44336;
      color: #fff;
      padding: 5px 10px;
      border-radius: 8px;
      font-size: 12px;
    }
    .status-badge.pending {
      background: #ffb700;
      color: #333;
      padding: 5px 10px;
      border-radius: 8px;
      font-size: 12px;
    }
  </style>
</head>
<body>

<?php
$periode = $data['periode'] ?? 'bulan_ini';
$status  = $data['status']  ?? 'semua';
$orders  = $data['orders']  ?? [];
?>

<div class="wrapper">

  <!-- SIDEBAR -->
  <div class="sidebar">
    <div>
      <h3>Nadi Admin</h3>

      <a href="<?= BASEURL ?>/admin/dashboard"><i class="bi bi-box"></i> Products</a>
      <a href="<?= BASEURL ?>/pesanan"><i class="bi bi-clock-history"></i> Orders</a>
      <a href="<?= BASEURL ?>/finance"><i class="bi bi-cash-coin"></i> Finance</a>
      <a href="<?= BASEURL ?>/report"><i class="bi bi-clipboard-data"></i> Report</a>
    </div>

    <div>
      <button class="btn btn-sm btn-secondary mb-2" onclick="window.location.href='<?= BASEURL ?>/home'">Kembali</button>
      <a href="<?= BASEURL ?>/auth/logout"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="content">

    <div class="topbar">
      <h2>Report Penjualan</h2>
    </div>

    <!-- FILTER -->
    <div class="card-box">
      <form method="get" action="<?= BASEURL ?>/report">
        <div class="row g-3 align-items-end">
          <div class="col-md-4">
            <label class="form-label">Periode</label>
            <select class="form-select" name="periode">
              <option value="bulan_ini"  <?= ($periode === 'bulan_ini') ? 'selected' : '' ?>>Bulan Ini</option>
              <option value="bulan_lalu" <?= ($periode === 'bulan_lalu') ? 'selected' : '' ?>>Bulan Lalu</option>
              <option value="3_bulan"    <?= ($periode === '3_bulan') ? 'selected' : '' ?>>3 Bulan Terakhir</option>
              <option value="1_tahun"    <?= ($periode === '1_tahun') ? 'selected' : '' ?>>1 Tahun Terakhir</option>
            </select>
          </div>

          <div class="col-md-4">
            <label class="form-label">Status</label>
            <select class="form-select" name="status">
              <option value="semua"   <?= ($status === 'semua') ? 'selected' : '' ?>>Semua</option>
              <option value="sukses"  <?= ($status === 'sukses') ? 'selected' : '' ?>>Sukses</option>
              <option value="batal"   <?= ($status === 'batal') ? 'selected' : '' ?>>Batal</option>
              <option value="pending" <?= ($status === 'pending') ? 'selected' : '' ?>>Pending</option>
            </select>
          </div>

          <div class="col-md-4">
            <button class="btn btn-dark w-100" type="submit">Terapkan Filter</button>
          </div>
        </div>
      </form>
    </div>

    <!-- TABEL REPORT -->
    <div class="card-box">
      <table class="table table-hover align-middle">
        <thead>
          <tr>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php if (!empty($orders)): ?>
            <?php foreach ($orders as $o): 
              $statusRaw   = $o['status_order'];
              $statusLower = strtolower($statusRaw);
            ?>
            <tr>
              <td><?= htmlspecialchars($o['nama_pelanggan']) ?></td>
              <td><?= date("d M Y", strtotime($o['tanggal_order'])) ?></td>
              <td>Rp <?= number_format($o['total_harga'], 0, ',', '.') ?></td>
              <td>
                <?php if (in_array($statusLower, ['paid','completed'])): ?>
                  <span class="status-badge approved">Sukses</span>
                <?php elseif ($statusLower === 'pending'): ?>
                  <span class="status-badge pending">Pending</span>
                <?php elseif ($statusLower === 'canceled'): ?>
                  <span class="status-badge rejected">Batal</span>
                <?php else: ?>
                  <span class="status-badge pending"><?= htmlspecialchars($statusRaw) ?></span>
                <?php endif; ?>
              </td>
              <td>
                <button 
                  class="btn btn-outline-dark btn-sm viewDetail"
                  data-bs-toggle="modal"
                  data-bs-target="#detailModal"
                  data-nama="<?= htmlspecialchars($o['nama_pelanggan']) ?>"
                  data-tanggal="<?= date("d M Y", strtotime($o['tanggal_order'])) ?>"
                  data-total="Rp <?= number_format($o['total_harga'], 0, ',', '.') ?>"
                  data-status="<?= htmlspecialchars($statusRaw) ?>"
                >
                  <i class="bi bi-eye"></i>
                </button>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="5" class="text-center">Tidak ada data untuk filter ini.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

  </div>
</div>

<!-- MODAL DETAIL -->
<div class="modal fade" id="detailModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Detail Pelanggan</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <table class="table">
          <tr>
            <th>Nama</th>
            <td id="modal-nama"></td>
          </tr>
          <tr>
            <th>Tanggal</th>
            <td id="modal-tanggal"></td>
          </tr>
          <tr>
            <th>Total</th>
            <td id="modal-total"></td>
          </tr>
          <tr>
            <th>Status</th>
            <td id="modal-status"></td>
          </tr>
        </table>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.querySelectorAll('.viewDetail').forEach(btn => {
    btn.addEventListener('click', function() {
      document.getElementById('modal-nama').textContent    = this.dataset.nama;
      document.getElementById('modal-tanggal').textContent = this.dataset.tanggal;
      document.getElementById('modal-total').textContent   = this.dataset.total;
      document.getElementById('modal-status').textContent  = this.dataset.status;
    });
  });
</script>

</body>
</html>
