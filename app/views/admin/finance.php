<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Finance Page</title>

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
      color: #333;
      margin-bottom: 25px;
    }
    .sidebar a {
      display: block;
      padding: 10px 15px;
      border-radius: 10px;
      color: #333;
      margin-bottom: 8px;
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
    .wallet-btn {
      background-color: #333;
      color: #fff;
      border: none;
      padding: 7px 20px;
      border-radius: 8px;
    }
    .card-box {
      border-radius: 12px;
      background-color: #fff;
      padding: 20px;
      box-shadow: 0 1px 4px rgba(0,0,0,0.1);
    }
    .section-title {
      font-weight: 600;
      margin-top: 35px;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>

<div class="wrapper">

  <!-- Sidebar -->
  <div class="sidebar">
    <div>
      <h3>Nadi Admin</h3>
      <a href="<?= BASEURL ?>/admin/dashboard"><i class="bi bi-box"></i> Products</a>
      <a href="<?= BASEURL ?>/pesanan"><i class="bi bi-clock-history"></i> Orders</a>
      <a href="<?= BASEURL ?>/finance"><i class="bi bi-cash-coin"></i> Finance</a>
      <a href="<?= BASEURL; ?>/report"><i class="bi bi-clipboard-data"></i> Report</a>
    </div>

    <div>
      <button type="button" class="btn btn-sm btn-secondary mb-2" onclick="window.location.href='<?= BASEURL ?>/home'">
        Kembali
      </button>
      <a href="<?= BASEURL ?>/auth/logout"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
  </div>

  <!-- Content -->
  <div class="content">

    <!-- TOPBAR -->
    <div class="topbar">
      <h2>Finance Overview</h2>
      <button class="wallet-btn">Connect Wallet</button>
    </div>

    <!-- FINANCE STATS -->
    <div class="row g-3">
      <div class="col-md-4">
        <div class="card-box">
          <h6 class="text-muted">Income/Month</h6>
          <h3>257,900%</h3>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card-box">
          <h6 class="text-muted">Total</h6>
          <h3>$571,320</h3>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card-box">
          <h6 class="text-muted">Your Earnings/Day</h6>
          <h3>$0.00</h3>
        </div>
      </div>
    </div>

    <!-- TARGET PENDAPATAN SECTION -->
<h4 class="section-title">Target Pendapatan Bulanan</h4>

<div class="row">

  <!-- Input Target -->
  <div class="col-lg-8">
    <div class="card-box">
      <h5>Tetapkan Target Bulanan</h5>
      <hr>

      <label class="form-label">Masukkan Target Pendapatan (Rp)</label>
      <input type="number" class="form-control" placeholder="0">

      <button class="btn btn-dark mt-3 w-100">Simpan Target</button>
    </div>
  </div>

  <!-- Informasi Target -->
  <div class="col-lg-4">
    <div class="card-box">
      <h5 class="mb-3">Progress Target</h5>

      <p class="mb-1">Pendapatan Saat Ini</p>
      <h5>Rp 12.500.000</h5>

      <p class="mt-3 mb-1">Target Bulanan</p>
      <h5>Rp 20.000.000</h5>

      <p class="mt-3 mb-1">Pencapaian</p>
      <h6>62.5%</h6>

      <div class="progress mt-2" style="height: 10px;">
        <div class="progress-bar bg-dark" style="width: 62.5%;"></div>
      </div>

      <p class="mt-4 mb-1">Estimasi Tercapai</p>
      <h6>Diperkirakan tercapai dalam 9 hari lagi</h6>

    </div>
  </div>

</div>


    <!-- PENDAPATAN BULANAN SECTION -->
<h4 class="section-title">Pendapatan Bulanan</h4>

<div class="card-box">
  <table class="table table-bordered text-center align-middle">
    <thead>
      <tr>
        <th>Bulan</th>
        <th>Pendapatan (Rp)</th>
        <th>Target (Rp)</th>
        <th>Selisih</th>
        <th>Progres</th>
        <th>Status</th>
      </tr>
    </thead>

    <tbody>
      <?php 
    
      $dataPendapatan = [
        ["Januari", 12500000, 20000000],
        ["Februari", 18500000, 20000000],
        ["Maret", 21000000, 20000000]
      ];

      foreach ($dataPendapatan as $d):
        $bulan = $d[0];
        $pendapatan = $d[1];
        $target = $d[2];
        $selisih = $pendapatan - $target;
        $persen = $pendapatan / $target * 100;

        $status = $pendapatan >= $target ? "Tercapai" : "Belum";
      ?>

      <tr>
        <td><?= $bulan ?></td>
        <td>Rp <?= number_format($pendapatan, 0, ',', '.') ?></td>
        <td>Rp <?= number_format($target, 0, ',', '.') ?></td>

        <td>
          <?php if ($selisih >= 0): ?>
            <span class="text-success">+Rp <?= number_format($selisih, 0, ',', '.') ?></span>
          <?php else: ?>
            <span class="text-danger">Rp <?= number_format($selisih, 0, ',', '.') ?></span>
          <?php endif; ?>
        </td>

        <td>
          <div class="progress" style="height: 10px;">
            <div class="progress-bar bg-dark" style="width: <?= $persen ?>%;"></div>
          </div>
          <small><?= number_format($persen, 1) ?>%</small>
        </td>

        <td>
          <?php if ($status === "Tercapai"): ?>
            <span class="badge bg-success">Tercapai</span>
          <?php else: ?>
            <span class="badge bg-warning text-dark">Belum</span>
          <?php endif; ?>
        </td>
      </tr>

      <?php endforeach; ?>
    </tbody>
  </table>
</div>


  </div>
</div>

</body>
</html>
