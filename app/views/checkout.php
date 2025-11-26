<?php include_once APPROOT . "/views/templates/header.php"; ?>

<div class="container mt-4">

    <h2 class="mb-4">Checkout</h2>

    <table class="table table-bordered table-striped checkout-table">
        <thead>
            <tr style="background: #f2f2f2;">
            <th style="width: 20%;">Produk</th>
            <th style="width: 20%;">Harga</th>
            <th style="width: 15%;">Jumlah</th>
            <th style="width: 20%;">Total</th>
            <br>
            </tr>
        </thead>

        <tbody>
        <?php 
            $grand_total = 0;
            foreach ($_SESSION['cart'] as $item): 
                $total_item = $item['harga'] * $item['qty'];
                $grand_total += $total_item;
        ?>
            <tr>
                <td><?= $item['nama']; ?></td>
                <td>Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
                <td><?= $item['qty']; ?></td>
                <td>Rp <?= number_format($total_item, 0, ',', '.'); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!-- TOTAL KESELURUHAN DITAMPILKAN DI SINI -->
    <div class="mt-3 p-3 border rounded bg-light"><br>
        <p class="mb-1 font-weight-bold">Total Keseluruhan</p>
        <h4 class="text-primary">Rp <?= number_format($grand_total, 0, ',', '.'); ?></h4>
    </div>

    <form action="<?= BASEURL ?>/checkout/process" method="POST" class="mt-4 p-3 border rounded shadow-sm"><br>

        <label class="font-weight-bold">Metode Pembayaran</label>
        <select name="metode_pembayaran" class="form-control mt-2 mb-3" required>
            <option value="">-- Pilih Metode Pembayaran --</option>
            <option value="Transfer Bank">Transfer Bank</option>
            <option value="QRIS">QRIS</option>
            <option value="Paypal">Paypal</option>
        </select>

        <button class="btn btn-warning btn-lg btn-block font-weight-bold">
            Bayar Sekarang
        </button>
    </form>

</div>
<br>
<br><br><br><br><br><br>
<?php include_once APPROOT . "/views/templates/footer.php"; ?>

<style>
    .checkout-table th, 
    .checkout-table td {
        padding: 12px 15px !important; 
        vertical-align: middle !important;
        text-align: center;
    }
</style>
