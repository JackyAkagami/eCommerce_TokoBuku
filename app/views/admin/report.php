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

    <div class="card-box">
      <div class="row g-3 align-items-end">
        <div class="col-md-4">
          <label class="form-label">Periode</label>
          <select class="form-select">
            <option>Bulan Ini</option>
            <option>Bulan Lalu</option>
            <option>3 Bulan Terakhir</option>
            <option>1 Tahun Terakhir</option>
          </select>
        </div>

        <div class="col-md-4">
          <label class="form-label">Status</label>
          <select class="form-select">
            <option>Semua</option>
            <option>Sukses</option>
            <option>Batal</option>
            <option>Pending</option>
          </select>
        </div>

        <div class="col-md-4">
          <button class="btn btn-dark w-100">Terapkan Filter</button>
        </div>
      </div>
    </div>

    <div class="card-box">

      <table class="table table-hover align-middle">
        <thead>
          <tr>
            <th>ID Order</th>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Metode</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>

          <?php 
          $data = [
            ["INV-001", "Ari Yoly", "2024-01-12", 250000, "Paypall", "Sukses"],
            ["INV-002", "Bagas", "2024-01-14", 180000, "Credit card", "Pending"],
            ["INV-003", "Rika", "2024-01-14", 325000, "E-Wallet", "Batal"],
            ["INV-004", "Fikri", "2024-01-15", 210000, "Transfer", "Sukses"]
          ];

          foreach ($data as $d):
            $status = strtolower($d[5]); 
          ?>

          <tr>
            <td><?= $d[0] ?></td>
            <td><?= $d[1] ?></td>
            <td><?= date("d M Y", strtotime($d[2])) ?></td>
            <td>Rp <?= number_format($d[3], 0, ',', '.') ?></td>
            <td><?= $d[4] ?></td>
            <td>
              <?php if ($status == "sukses"): ?>
                <span class="status-badge approved">Sukses</span>
              <?php elseif ($status == "pending"): ?>
                <span class="status-badge pending">Pending</span>
              <?php else: ?>
                <span class="status-badge rejected">Batal</span>
              <?php endif; ?>
            </td>

            <td>
              <button 
                class="btn btn-outline-dark btn-sm viewDetail"
                data-bs-toggle="modal"
                data-bs-target="#detailModal"
                data-id="<?= $d[0] ?>"
                data-nama="<?= $d[1] ?>"
                data-tanggal="<?= date("d M Y", strtotime($d[2])) ?>"
                data-total="Rp <?= number_format($d[3], 0, ',', '.') ?>"
                data-metode="<?= $d[4] ?>"
                data-status="<?= $d[5] ?>"
              >
                <i class="bi bi-eye"></i>
              </button>
            </td>
          </tr>

          <?php endforeach; ?>

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
            <th>ID Order</th>
            <td id="modal-id"></td>
          </tr>
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
            <th>Metode</th>
            <td id="modal-metode"></td>
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
      document.getElementById('modal-id').textContent = this.dataset.id;
      document.getElementById('modal-nama').textContent = this.dataset.nama;
      document.getElementById('modal-tanggal').textContent = this.dataset.tanggal;
      document.getElementById('modal-total').textContent = this.dataset.total;
      document.getElementById('modal-metode').textContent = this.dataset.metode;
      document.getElementById('modal-status').textContent = this.dataset.status;
    });
  });
</script>

</body>
</html>
