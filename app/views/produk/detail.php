<?php include_once APPROOT . "/views/templates/header.php"; ?>

<?php
// CEK DISKON: cuma tampil info, TIDAK POTONG HARGA
$diskon_aktif = !empty($data['product']['diskon']) && $data['product']['diskon'] == 1;
$diskon_persen = $diskon_aktif ? intval($data['product']['diskon_persen']) : 0;
?>

<div class="product-detail-page">

    <!-- Kolom kiri: deskripsi -->
    <div class="product-main">

        <!-- Tombol Back -->
        <a href="<?= BASEURL; ?>/produk" class="btn-back">← Back to products</a>

        <!-- Judul produk -->
        <h1 class="product-title"><?= htmlspecialchars($data['product']['nama_produk']); ?></h1>

        <!-- Info singkat + DISKON BADGE -->
        <div class="product-meta-wrapper">
            <span>Stok: <?= intval($data['product']['stok']); ?>+</span>
            <?php if ($diskon_aktif): ?>
                <span class="discount-badge">Diskon <?= $diskon_persen ?>% OFF</span>
            <?php endif; ?>
        </div>

        <!-- Deskripsi -->
        <p class="product-description"><?= nl2br(htmlspecialchars($data['product']['deskripsi'])); ?></p>

        <!-- Info tambahan -->
        <p class="product-extra">
            <strong>Kategori:</strong> <?= htmlspecialchars($data['product']['nama_kategori']); ?><br>
            <strong>Harga:</strong> 
            <?php if ($diskon_aktif): ?>
                <span class="harga-diskon">Rp <?= number_format($data['product']['harga'], 0, ',', '.'); ?> 
                    <span class="diskon-info">(sudah diskon <?= $diskon_persen ?>%)</span>
                </span>
            <?php else: ?>
                Rp <?= number_format($data['product']['harga'], 0, ',', '.'); ?>
            <?php endif; ?><br>
            <strong>Stok:</strong> <?= intval($data['product']['stok']); ?>
        </p>
    </div>

    <!-- Kolom kanan: gambar + ringkasan -->
    <aside class="product-side">
        <div class="side-card image-card">
            <img src="<?= BASEURL; ?>/img/<?= htmlspecialchars($data['product']['gambar']); ?>"
                 alt="<?= htmlspecialchars($data['product']['nama_produk']); ?>">
        </div>

        <div class="side-card summary-card">
            <p class="summary-note">Shipping costs will be calculated at checkout.</p>

            <!-- HARGA: sesuai database (SUDAH diskon) -->
            <div class="summary-row">
                <span>Subtotal:</span>
                <span>Rp <?= number_format($data['product']['harga'], 0, ',', '.'); ?></span>
            </div>

            <?php if ($diskon_aktif): ?>
                <!-- INFO DISKON (tanpa potong harga lagi) -->
                <div class="summary-row discount-info">
                    <span>Diskon <?= $diskon_persen ?>%:</span>
                    <span class="diskon-label">Sudah diterapkan</span>
                </div>
            <?php endif; ?>

            <div class="summary-row">
                <span>VAT included:</span>
                <span>Rp 0</span>
            </div>

            <div class="summary-total">
                <span>Total:</span>
                <span>Rp <?= number_format($data['product']['harga'], 0, ',', '.'); ?></span>
            </div>

            <!-- Tombol Add to Cart & Buy Now -->
            <a href="<?= BASEURL; ?>/cart/add/<?= $data['product']['id']; ?>" class="btn-checkout">Add to cart</a>
            
            <form action="<?= BASEURL; ?>/checkout/buynow" method="POST" style="margin-top:8px;">
                <input type="hidden" name="product_id" value="<?= $data['product']['id']; ?>">
                <input type="hidden" name="qty" value="1">
                <button type="submit" class="btn-checkout" style="background:#F18A5D;">Buy now</button>
            </form>

            <a href="<?= BASEURL; ?>/produk" class="btn-back-right">← Back to products</a>
        </div>
    </aside>
</div>

<style>
.product-detail-page {
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 40px;
    display: grid;
    grid-template-columns: 2fr 1.1fr;
    gap: 40px;
    font-family: Arial, sans-serif;
    color: #333;
    background: #F5F2E8;
}

.product-main { padding: 40px 50px; background: #F5F2E8; }

.btn-back {
    display: inline-block;
    margin-bottom: 16px;
    padding: 6px 12px;
    border-radius: 20px;
    background: transparent;
    border: 1px solid #586053;
    color: #586053;
    font-size: 13px;
    text-decoration: none;
}
.btn-back:hover { background: #586053; color: #fff; }

.product-title {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 6px;
    color: #333;
}

/* WRAPPER META + BADGE */
.product-meta-wrapper {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    color: #777;
    margin-bottom: 20px;
}

.discount-badge {
    background: linear-gradient(45deg, #FF4444, #FF6B6B);
    color: white;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    box-shadow: 0 2px 8px rgba(255,68,68,0.3);
}

.product-description {
    font-size: 14px;
    line-height: 1.7;
    margin-bottom: 25px;
}

.product-extra {
    font-size: 14px;
    line-height: 1.6;
}

.product-extra strong { color: #586053; }

/* HARGA DISKON INFO */
.harga-diskon { 
    color: #FFD700; 
    font-weight: 700; 
    font-size: 16px; 
}
.diskon-info { 
    font-size: 11px; 
    color: #FF6B6B; 
    font-weight: 500; 
}

/* Kolom kanan */
.product-side {
    background: #4F584C;
    padding: 24px 20px 30px;
    display: flex;
    flex-direction: column;
    gap: 20px;
    color: #fff;
}

.image-card img {
    width: 70%;
    max-width: 260px;
    height: auto;
    object-fit: contain;
    border-radius: 4px;
}

.summary-card { font-size: 13px; }

.summary-note {
    font-size: 11px;
    line-height: 1.5;
    margin-bottom: 14px;
    opacity: 0.85;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 6px;
}

.discount-info {
    background: rgba(255,215,0,0.15);
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 12px;
}

.diskon-label {
    color: #FFD700;
    font-weight: 600;
}

.summary-total {
    display: flex;
    justify-content: space-between;
    font-weight: 700;
    font-size: 15px;
    margin-top: 12px;
    margin-bottom: 16px;
    padding-top: 12px;
    border-top: 1px solid rgba(255,255,255,0.2);
}

.btn-checkout {
    display: block;
    width: 100%;
    text-align: center;
    padding: 12px 0;
    border-radius: 20px;
    background: #F3A57A;
    color: #fff;
    font-weight: 600;
    text-decoration: none;
    margin-bottom: 8px;
    border: none;
    cursor: pointer;
    transition: all 0.2s;
}
.btn-checkout:hover { background: #e18f62; transform: translateY(-1px); }

.btn-back-right {
    display: block;
    text-align: center;
    font-size: 13px;
    color: #fff;
    text-decoration: none;
    opacity: 0.8;
}
.btn-back-right:hover { opacity: 1; }

@media (max-width: 900px) {
    .product-detail-page { grid-template-columns: 1fr; padding: 0 20px; }
    .product-main { padding: 30px 20px; }
    .product-side { margin-top: 10px; }
}
</style>

<?php include_once APPROOT . "/views/templates/footer.php"; ?>
