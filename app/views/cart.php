<?php include_once APPROOT . '/views/templates/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Keranjang Belanja</h2>

    <?php if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])): ?>
        <div class="alert alert-warning">
            Keranjang masih kosong 🙁<br>
            yuk segera masukin ke keranjang belanjaan kamu!
        </div>
    <?php else: ?>
    <table class="table table-bordered table-striped checkout-table">
    <thead>
        <tr style="background: #f2f2f2;">
            <th style="width: 20%;">Produk</th>
            <th style="width: 20%;">Harga</th>
            <th style="width: 15%;">Jumlah</th>
            <th style="width: 20%;">Total</th>
            <th style="width: 5%;">Aksi</th>
            <br>
        </tr>
    </thead>

    <tbody>
        <?php foreach($_SESSION['cart'] as $id => $item): ?>
        <tr>
            <td style="padding: 10px;"><?= htmlspecialchars($item['nama']); ?></td>

            <td style="padding: 10px;">
                Rp <?= number_format($item['harga'], 0, ',', '.'); ?>
            </td>

            <td style="padding: 10px;"><?= $item['qty']; ?></td>

            <td style="padding: 10px;">
                Rp <?= number_format($item['harga'] * $item['qty'], 0, ',', '.'); ?>
            </td>

            <td style="text-align: center; padding: 10px;">
                <a href="<?= BASEURL; ?>/cart/remove/<?= $id ?>" 
                   class="btn btn-danger btn-sm">
                    X
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

    <div class="text-end mt-4"><br>
    <a href="<?= BASEURL; ?>/checkout" 
       class="btn btn-success px-4 py-2"
       style="font-size: 16px; font-weight: 600; border-radius: 8px;">
        Lanjut ke Pembayaran →
    </a>
    </div>

    <?php endif; ?>

</div>
<br><br><br><br><br><br>
<?php include_once APPROOT . '/views/templates/footer.php'; ?>

<style>
    .checkout-table th, 
    .checkout-table td {
        padding: 12px 15px !important; 
        vertical-align: middle !important;
        text-align: center;
    }
</style>
