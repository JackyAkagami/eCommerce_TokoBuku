<?php include_once APPROOT . '/views/templates/header.php'; ?>

<style>
    .cart-wrapper {
        max-width: 1100px;
        margin: 50px auto 80px;
    }

    .cart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-bottom: 25px;
    }

    .cart-title {
        font-size: 26px;
        font-weight: 700;
        color: #444;
    }

    .cart-subtitle {
        font-size: 13px;
        color: #888;
    }

    .cart-card {
        background: #ffffff;
        border-radius: 14px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.06);
        padding: 20px 22px;
    }

    .checkout-table {
        margin-bottom: 0;
    }

    .checkout-table th,
    .checkout-table td {
        padding: 14px 16px !important;
        vertical-align: middle !important;
        text-align: center;
        border-color: #eee;
    }

    .checkout-table thead th {
        background: #f5f5f5;
        font-weight: 600;
        font-size: 14px;
    }

    .cart-item-name {
        text-align: left;
        font-weight: 600;
    }

    .cart-item-price,
    .cart-item-total {
        font-weight: 600;
        color: #586053;
    }

    .cart-empty {
        background: #fff7e6;
        border-radius: 12px;
        padding: 25px 22px;
        border: 1px dashed #ffb84d;
    }

    .cart-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 18px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .cart-total-text {
        font-size: 15px;
        font-weight: 600;
        color: #333;
    }

    .cart-total-amount {
        font-size: 18px;
        font-weight: 700;
        color: #586053;
    }

    .btn-continue {
        border-radius: 999px;
        font-size: 14px;
        font-weight: 500;
        padding: 8px 16px;
    }

    .btn-checkout-main {
        font-size: 15px;
        font-weight: 600;
        border-radius: 999px;
        padding: 10px 22px;
    }
</style>

<div class="cart-wrapper">

    <div class="cart-header">
        <div>
            <h2 class="cart-title">Keranjang Belanja</h2>
            <div class="cart-subtitle">
                Cek kembali barang yang kamu pilih sebelum lanjut ke pembayaran.
            </div>
        </div>
    </div>

    <?php if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])): ?>

        <div class="cart-empty">
            <h5 class="mb-2">Keranjang masih kosong 🙁</h5>
            <p class="mb-3">
                Yuk mulai isi keranjang dengan buku atau produk favorit kamu!
            </p>
            <a href="<?= BASEURL; ?>/produk" class="btn btn-outline-success btn-continue">
                ← Lanjut belanja
            </a>
        </div>

    <?php else: ?>

        <?php
        $grand_total = 0;
        foreach ($_SESSION['cart'] as $id => $item) {
            $grand_total += $item['harga'] * $item['qty'];
        }
        ?>

        <div class="cart-card">
            <table class="table table-bordered table-striped checkout-table">
                <thead>
                    <tr>
                        <th style="width: 35%;">Produk</th>
                        <th style="width: 15%;">Harga</th>
                        <th style="width: 15%;">Jumlah</th>
                        <th style="width: 20%;">Total</th>
                        <th style="width: 10%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($_SESSION['cart'] as $id => $item): ?>
                        <tr>
                            <td class="cart-item-name">
                                <?= htmlspecialchars($item['nama']); ?>
                            </td>
                            <td class="cart-item-price">
                                Rp <?= number_format($item['harga'], 0, ',', '.'); ?>
                            </td>
                            <td>
                                <?= $item['qty']; ?>
                            </td>
                            <td class="cart-item-total">
                                Rp <?= number_format($item['harga'] * $item['qty'], 0, ',', '.'); ?>
                            </td>
                            <td style="text-align: center;">
                                <a href="<?= BASEURL; ?>/cart/remove/<?= $id ?>"
                                   class="btn btn-danger btn-sm"
                                   title="Hapus dari keranjang">
                                    ✕
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="cart-footer">
                <a href="<?= BASEURL; ?>/produk"
                   class="btn btn-outline-secondary btn-continue">
                    ← Lanjut belanja
                </a>

                <div class="d-flex align-items-center gap-3">
                    <div class="cart-total-text">
                        Total Keranjang:
                        <span class="cart-total-amount">
                            Rp <?= number_format($grand_total, 0, ',', '.'); ?>
                        </span>
                    </div>

                    <a href="<?= BASEURL; ?>/checkout"
                       class="btn btn-success btn-checkout-main">
                        Lanjut ke Pembayaran →
                    </a>
                </div>
            </div>
        </div>

    <?php endif; ?>

</div>

<?php include_once APPROOT . '/views/templates/footer.php'; ?>
