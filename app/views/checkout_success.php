<?php include_once APPROOT . "/views/templates/header.php"; ?>

<style>
.success-box {
    max-width: 500px;
    margin: 80px auto;
    background: #ffffff;
    padding: 35px;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    text-align: center;
    animation: fadeIn 0.6s ease;
    font-family: Arial, sans-serif;
}

.success-icon {
    font-size: 80px;
    color: #28a745;
    animation: pop 0.4s ease;
}

.success-title {
    font-size: 26px;
    font-weight: 700;
    color: #2f855a;
    margin-top: 15px;
    margin-bottom: 10px;
}

.success-text {
    font-size: 14px;
    color: #555;
    line-height: 1.6;
}

/* Tombol kembali ke home yang lebih menarik */
.btn-back-home {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-top: 22px;
    padding: 10px 22px;
    border-radius: 999px;
    background: linear-gradient(135deg, #ff9f43, #ff6f61);
    color: #fff;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    box-shadow: 0 6px 15px rgba(255, 111, 97, 0.4);
    transition: transform 0.15s ease, box-shadow 0.15s ease, opacity 0.15s ease;
}

.btn-back-home span.icon {
    font-size: 16px;
}

.btn-back-home:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(255, 111, 97, 0.5);
    opacity: 0.95;
}

.btn-back-home:active {
    transform: translateY(0);
    box-shadow: 0 4px 10px rgba(255, 111, 97, 0.4);
}

.success-small-note {
    margin-top: 18px;
    font-size: 12px;
    color: #888;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(15px); }
    to   { opacity: 1; transform: translateY(0); }
}

@keyframes pop {
    0%   { transform: scale(0.6); opacity: 0; }
    100% { transform: scale(1);   opacity: 1; }
}
</style>

<div class="success-box">
    <div class="success-icon">✔</div>

    <h2 class="success-title">Pembayaran Berhasil!</h2>

    <p class="success-text">
        Terima kasih telah berbelanja di toko kami.<br>
        Pesanan Anda sedang diproses dan akan segera dikonfirmasi.
    </p>

    <!-- Tombol kembali ke home yang lebih menarik -->
    <a href="<?= BASEURL ?>" class="btn-back-home">
        <span class="icon">🏠</span>
        <span>Kembali jelajahi beranda</span>
    </a>

    <p class="success-small-note">
        Anda akan menerima notifikasi konfirmasi pesanan selanjutnya.
    </p>
</div>

<br><br><br><br><br>

<?php include_once APPROOT . "/views/templates/footer.php"; ?>
