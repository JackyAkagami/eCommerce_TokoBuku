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
}

.success-icon {
    font-size: 80px;
    color: #28a745;
    animation: pop 0.4s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes pop {
    0% { transform: scale(0.6); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
}
</style>

<div class="success-box">
    <div class="success-icon">✔</div>

    <h2 class="mt-3 text-success">Pembayaran Berhasil!</h2>
    <p class="mt-2">
        Terima kasih telah berbelanja di toko kami.  
        Pesanan Anda sedang diproses dan akan segera dikonfirmasi.
    </p>

    <a href="<?= BASEURL ?>" class="btn btn-success mt-4 px-4">
        Kembali ke Home
    </a>

    <p class="mt-3 text-muted" style="font-size: 14px;">
        Anda akan menerima notifikasi konfirmasi pesanan selanjutnya.
    </p>
</div>

<br><br><br><br><br>

<?php include_once APPROOT . "/views/templates/footer.php"; ?>
