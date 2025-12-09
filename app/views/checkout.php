<?php include_once APPROOT . "/views/templates/header.php"; ?>

<?php
// DETEKSI MODE: cart biasa atau single product (Buy now)
$isSingleMode = isset($data['mode']) && $data['mode'] === 'single';

// AMBIL DATA ITEM + HITUNG TOTAL
$items = [];
$grand_total = 0;
$total_diskon = 0;

if ($isSingleMode && isset($data['item'])) {
    // MODE SINGLE: dari Buy now
    $single_item = [
        'nama' => $data['item']['nama'],
        'harga' => $data['item']['harga'],
        'qty' => $data['item']['qty'],
        'gambar' => $data['item']['gambar'] ?? null,
        'diskon' => $data['item']['diskon'] ?? 0,
        'diskon_persen' => $data['item']['diskon_persen'] ?? 0,
        'harga_asli' => $data['item']['harga_asli'] ?? $data['item']['harga']
    ];
    $items[] = $single_item;
    $grand_total = $data['item']['harga'] * $data['item']['qty'];
} else {
    // MODE CART: dari $_SESSION['cart']
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $items[] = $item;
            $grand_total += $item['harga'] * $item['qty'];
        }
    }
}
?>

<style>
    body { background: #FAF8EF; }
    .checkout-container {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 40px;
        max-width: 1200px;
        margin: 30px auto;
    }
    .section-box {
        background: #fff;
        padding: 20px 25px;
        border-radius: 10px;
        margin-bottom: 35px;
        border: 1px solid #eee;
    }
    h4 { margin-bottom: 15px; font-weight: bold; }
    input, select {
        width: 100%;
        padding: 10px 12px;
        border-radius: 6px;
        border: 1px solid #ccc;
        margin-bottom: 12px;
        box-sizing: border-box;
    }
    .contact-checkbox {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 5px;
    }
    .contact-checkbox input[type="checkbox"] { width: auto; margin: 0; }

    .option-box {
        padding: 14px 15px;
        background: #FFE2CC;
        border-radius: 10px;
        margin-bottom: 15px;
        cursor: pointer;
        border: 2px solid transparent;
        display: grid;
        grid-template-columns: 1fr auto;
        align-items: center;
        column-gap: 16px;
        transition: all 0.2s;
    }
    .option-box:hover { border-color: #FF8A00; }
    .option-left { display: flex; flex-direction: column; }
    .option-right { display: flex; align-items: center; gap: 10px; }
    .option-box input[type="radio"] { margin: 0; transform: scale(1.1); }

    /* PAYMENT FORMS */
    .payment-forms { display: none; margin-top: 15px; padding: 15px; background: #f8f9fa; border-radius: 8px; border-left: 4px solid #FF8A00; }
    .payment-forms.active { display: block; animation: slideDown 0.3s ease; }
    @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    
    .card-row { display: flex; gap: 10px; }
    .card-row input { flex: 1; }
    .card-expiry { display: flex; gap: 10px; }
    .card-expiry input { width: 60px; }
    .cvv-input { width: 80px; }
    
    .bank-select { display: flex; gap: 10px; margin-bottom: 12px; }
    .bank-select select { flex: 1; }
    
    .qris-container { text-align: center; padding: 20px; background: #f0f8ff; border-radius: 10px; }
    .qris-code { 
        width: 200px; height: 200px; 
        margin: 0 auto 15px; 
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 12px; color: #333; background: repeating-linear-gradient(
            0deg,
            #fff 0 2px,
            #000 2px 4px
        );
    }
    .instruction-text { font-size: 14px; color: #666; margin-bottom: 10px; }
    
    .half-input { width: 48%; }
    .bank-info { background: #e8f5e8; padding: 12px; border-radius: 6px; margin-bottom: 12px; font-size: 14px; }
    .bank-info strong { color: #28a745; }
    
    @media (max-width: 768px) { 
        .card-row, .card-expiry, .bank-select { flex-direction: column; gap: 0; } 
        .half-input { width: 100%; } 
    }

    /* SUMMARY + DISKON */
    .order-summary {
        background: #fff;
        border-radius: 10px;
        padding: 20px;
        border: 1px solid #eee;
        position: sticky;
        top: 20px;
    }
    .order-item {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }
    .order-item:last-child { border-bottom: none; margin-bottom: 0; }
    .order-item img {
        width: 70px;
        height: 90px;
        border-radius: 8px;
        object-fit: cover;
        background: #f8f8f8;
    }
    
    /* INFO DISKON DI ITEM */
    .item-price-normal { color: #333; }
    .item-price-diskon {
        color: #FFD700 !important;
        font-weight: 700;
    }
    .item-price-asli {
        text-decoration: line-through;
        opacity: 0.6;
        font-size: 11px;
        margin-right: 5px;
    }
    .diskon-badge-item {
        background: #FF4444;
        color: white;
        padding: 2px 6px;
        border-radius: 10px;
        font-size: 9px;
        font-weight: 600;
        margin-left: 5px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin: 6px 0;
    }
    .discount-summary {
        background: rgba(255,215,0,0.1);
        padding: 8px 12px;
        border-radius: 6px;
        border-left: 4px solid #FFD700;
        margin: 8px 0;
    }
    .total-price {
        font-size: 22px;
        font-weight: bold;
        margin-top: 10px;
    }
    .btn-pay {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        background: #FF8A00;
        border: none;
        color: white;
        font-weight: bold;
        font-size: 16px;
        cursor: pointer;
        margin-top: 15px;
        transition: background 0.2s;
    }
    .btn-pay:hover { background: #e47900; }
    .btn-pay:disabled {
        background: #ccc;
        cursor: not-allowed;
    }
    .mode-badge {
        background: <?= $isSingleMode ? '#FF8A00' : '#28a745' ?>;
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 15px;
        text-align: center;
    }
    @media (max-width: 900px) {
        .checkout-container {
            grid-template-columns: 1fr;
            padding: 0 15px;
            gap: 20px;
        }
        .order-summary { position: static; }
    }
</style>

<div class="checkout-container">
    <!-- LEFT: FORM CHECKOUT -->
    <form action="<?= BASEURL ?>/checkout/process" method="POST" id="checkout-form" novalidate>
        <input type="hidden" name="mode" value="<?= $isSingleMode ? 'single' : 'cart'; ?>">
        <input type="hidden" name="grand_total" value="<?= $grand_total ?>">
        <input type="hidden" name="items_count" value="<?= count($items) ?>">

        <!-- CONTACT -->
        <div class="section-box">
            <h4>Contact</h4>
            <input type="email" name="email" placeholder="Email" required>
            <div class="contact-checkbox">
                <input type="checkbox" id="news" name="subscribe_news">
                <label for="news">Email me with news and offers</label>
            </div>
        </div>

        <!-- DELIVERY -->
        <div class="section-box">
            <h4>Delivery</h4>
            <select name="country" required>
                <option value="">Pilih negara</option>
                <option value="ID">Indonesia</option>
                <option value="MY">Malaysia</option>
                <option value="SG">Singapura</option>
                <option value="TH">Thailand</option>
                <option value="VN">Vietnam</option>
                <option value="BN">Brunei Darussalam</option>
                <option value="KH">Kamboja</option>
                <option value="TL">Timorleste</option>
                <option value="LA">Laos</option>
            </select>
            <div style="display: flex; gap:10px;">
                <input type="text" name="first_name" placeholder="Nama Depan" required>
                <input type="text" name="last_name" placeholder="Nama Belakang" required>
            </div>
            <input type="text" name="address" placeholder="Alamat Lengkap" required>
            <input type="text" name="city" placeholder="Kota / Kecamatan" required>
            <input type="text" name="province" placeholder="Provinsi" required>
            <input type="text" name="postcode" placeholder="Kode Pos" required>
            <input type="text" name="phone" placeholder="No Telepon" required>
        </div>

        <!-- SHIPPING -->
        <div class="section-box">
            <h4>Shipping Method <span id="shipping-error" style="color:red;font-size:12px;display:none;">* Wajib dipilih</span></h4>
            <label class="option-box">
                <div class="option-left">
                    <b>DHL Express Worldwide</b>
                    <small>Estimasi 3–5 hari</small>
                </div>
                <div class="option-right">
                    <span>Rp 150.000</span>
                    <input type="radio" name="shipping" value="150000">
                </div>
            </label>
            <label class="option-box">
                <div class="option-left">
                    <b>J&T Express</b>
                    <small>Estimasi 2–4 hari</small>
                </div>
                <div class="option-right">
                    <span>Rp 25.000</span>
                    <input type="radio" name="shipping" value="25000">
                </div>
            </label>
            <label class="option-box">
                <div class="option-left">
                    <b>SiCepat</b>
                    <small>Estimasi 2–3 hari</small>
                </div>
                <div class="option-right">
                    <span>Rp 20.000</span>
                    <input type="radio" name="shipping" value="20000">
                </div>
            </label>
        </div>

        <!-- PAYMENT -->
        <div class="section-box">
            <h4>Payment Method <span id="payment-error" style="color:red;font-size:12px;display:none;">* Wajib dipilih</span></h4>
            <label class="option-box">
                <div class="option-left">
                    <b>Kartu Kredit / Debit</b>
                </div>
                <div class="option-right">
                    <input type="radio" name="metode_pembayaran" value="card">
                </div>
            </label>
            <label class="option-box">
                <div class="option-left">
                    <b>PayPal</b>
                </div>
                <div class="option-right">
                    <input type="radio" name="metode_pembayaran" value="paypal">
                </div>
            </label>
            <label class="option-box">
                <div class="option-left">
                    <b>QRIS</b>
                </div>
                <div class="option-right">
                    <input type="radio" name="metode_pembayaran" value="qris">
                </div>
            </label>
            <label class="option-box">
                <div class="option-left">
                    <b>Transfer Bank</b>
                </div>
                <div class="option-right">
                    <input type="radio" name="metode_pembayaran" value="TF">
                </div>
            </label>

            <!-- CARD FORM -->
            <div id="card-form" class="payment-forms">
                <div class="card-row">
                    <input type="text" name="card_number" placeholder="1234 5678 9012 3456" maxlength="19" required>
                </div>
                <div class="card-expiry">
                    <input type="text" name="card_exp_month" placeholder="MM (01-12)" maxlength="2" required>
                    <input type="text" name="card_exp_year" placeholder="YY (25-30)" maxlength="2" required>
                    <input type="text" name="card_cvv" class="cvv-input" placeholder="CVV (3-4 digit)" maxlength="4" required>
                </div>
                <div class="bank-select">
                    <select name="card_bank" required>
                        <option value="">Pilih Bank Kartu</option>
                        <option value="BCA">BCA</option>
                        <option value="Mandiri">Mandiri</option>
                        <option value="BNI">BNI</option>
                        <option value="BRI">BRI</option>
                        <option value="CIMB">CIMB Niaga</option>
                    </select>
                </div>
                <input type="text" name="card_holder" placeholder="Nama Pemilik Kartu (sesuai kartu)" required>
            </div>

            <!-- PAYPAL FORM -->
            <div id="paypal-form" class="payment-forms">
                <input type="email" name="paypal_email" placeholder="Email PayPal Anda" required>
                <input type="text" name="paypal_phone" placeholder="No. Telepon (opsional)">
            </div>

            <!-- QRIS FORM -->
            <div id="qris-form" class="payment-forms">
                <div class="qris-container">
                    <div class="qris-code">SCAN QRIS INI</div>
                    <div class="instruction-text">
                        Buka aplikasi e-wallet/banking Anda (OVO, GoPay, DANA, ShopeePay, LinkAja, 
                        atau Mobile Banking) lalu scan kode QRIS di atas
                    </div>
                    <div style="font-weight:bold; color:#FF8A00; font-size:16px; margin:10px 0;">
                        Rp <?= number_format($grand_total,0,',','.'); ?>
                    </div>
                </div>
                <input type="text" name="qris_notes" placeholder="Catatan pembayaran QRIS (opsional)">
            </div>

            <!-- BANK TRANSFER FORM -->
            <div id="TF-form" class="payment-forms">
                <div class="bank-info">
                    <strong>Transfer ke salah satu rekening berikut:</strong><br>
                    <div style="font-weight:bold; color:#FF8A00; margin-top:5px;">
                        Total: Rp <?= number_format($grand_total,0,',','.'); ?>
                    </div>
                </div>
                
                <div class="bank-select">
                    <select name="bank_tujuan" id="bank_tujuan" required>
                        <option value="">Pilih Bank Tujuan</option>
                        <option value="BCA">BCA - 1234 5678 90 (a/n PT Toko Online Indonesia)</option>
                        <option value="Mandiri">Mandiri - 9876 5432 10 (a/n PT Toko Online Indonesia)</option>
                        <option value="BNI">BNI - 4567 8901 23 (a/n PT Toko Online Indonesia)</option>
                        <option value="BRI">BRI - 3210 9876 54 (a/n PT Toko Online Indonesia)</option>
                    </select>
                </div>
                
                <div id="bank_details" style="background: #f0f8ff; padding: 12px; border-radius: 6px; margin-bottom: 12px; display: none;">
                    <strong>Rekening Tujuan Terpilih:</strong><br>
                    <span id="rek_tujuan"></span>
                </div>

                <div class="card-row">
                    <input type="text" class="half-input" name="bank_pengirim" placeholder="Bank Pengirim Anda" required>
                    <input type="text" class="half-input" name="no_rek_pengirim" placeholder="No. Rekening Pengirim" required>
                </div>
                <input type="text" name="nama_pengirim" placeholder="Nama Lengkap Pemilik Rekening" required>
                <input type="text" name="tf_notes" placeholder="Catatan (contoh: INV-20251209-001)">
                
                <div style="background: #fff3cd; padding: 10px; border-radius: 6px; font-size: 13px; margin-top: 10px;">
                    <strong>⚠️ Penting:</strong> Simpan bukti transfer & masukkan nomor invoice di catatan.
                </div>
            </div>

            <button class="btn-pay" type="submit" id="btn-submit">
                <?= $isSingleMode ? 'Bayar Sekarang Rp ' . number_format($grand_total,0,',','.') : 'Pay now' ?>
            </button>
        </div>
    </form>

    <!-- RIGHT SUMMARY -->
    <div class="order-summary">
        <h4>Your Order</h4>
        <div class="mode-badge">
            <?= $isSingleMode ? 'Pembelian 1 Produk' : count($items) . ' Item di Keranjang' ?>
        </div>

        <?php foreach ($items as $item): ?>
            <div class="order-item">
                <?php if (!empty($item['gambar'])): ?>
                    <img src="<?= BASEURL ?>/img/<?= htmlspecialchars($item['gambar']); ?>" alt="<?= htmlspecialchars($item['nama']); ?>">
                <?php else: ?>
                    <div style="width:70px;height:90px;border-radius:8px;background:#f0f0f0;"></div>
                <?php endif; ?>
                <div style="flex:1;">
                    <b><?= htmlspecialchars($item['nama']); ?></b><br>
                    <?php 
                    $diskon_aktif = isset($item['diskon']) && $item['diskon'] == 1;
                    $diskon_persen = $diskon_aktif ? intval($item['diskon_persen']) : 0;
                    $harga_asli = $item['harga_asli'] ?? $item['harga'];
                    ?>
                    <?php if ($diskon_aktif): ?>
                        <small>
                            <span class="item-price-asli">Rp <?= number_format($harga_asli,0,',','.'); ?></span>
                            <span class="item-price-diskon">Rp <?= number_format($item['harga'],0,',','.'); ?> × <?= $item['qty']; ?></span>
                            <span class="diskon-badge-item"><?= $diskon_persen ?>%</span>
                        </small>
                    <?php else: ?>
                        <small class="item-price-normal">Rp <?= number_format($item['harga'],0,',','.'); ?> × <?= $item['qty']; ?></small>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="summary-row">
            <span>Subtotal</span>
            <span id="subtotal">Rp <?= number_format($grand_total,0,',','.'); ?></span>
        </div>

        <?php if (isset($total_diskon) && $total_diskon > 0): ?>
            <div class="summary-row discount-summary">
                <span>Total Diskon:</span>
                <span>- Rp <?= number_format($total_diskon,0,',','.'); ?></span>
            </div>
        <?php endif; ?>

        <div class="summary-row">
            <span>Shipping</span>
            <span id="shipping-price">Rp 0</span>
        </div>
        <hr>
        <div class="total-price">
            Total: <span id="total-all">Rp <?= number_format($grand_total,0,',','.'); ?></span>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const shippingInputs = document.querySelectorAll("input[name='shipping']");
    const shippingLabel = document.getElementById("shipping-price");
    const totalLabel = document.getElementById("total-all");
    const btnSubmit = document.getElementById("btn-submit");
    const form = document.getElementById("checkout-form");
    let subtotal = <?= $grand_total ?>;

    // Shipping calculation
    shippingInputs.forEach(radio => {
        radio.addEventListener("change", function() {
            let shipCost = parseInt(this.value) || 0;
            shippingLabel.textContent = "Rp " + shipCost.toLocaleString("id-ID");
            let newTotal = subtotal + shipCost;
            totalLabel.textContent = "Rp " + newTotal.toLocaleString("id-ID");
            document.getElementById("shipping-error").style.display = "none";
        });
    });

    // Bank transfer details
    function showBankDetails() {
        const select = document.getElementById("bank_tujuan");
        const details = document.getElementById("bank_details");
        const rekTujuan = document.getElementById("rek_tujuan");
        
        if (select.value) {
            rekTujuan.textContent = select.options[select.selectedIndex].text;
            details.style.display = "block";
        } else {
            details.style.display = "none";
        }
    }

    // Payment method toggle
    const paymentRadios = document.querySelectorAll("input[name='metode_pembayaran']");
    const paymentForms = document.querySelectorAll(".payment-forms");
    
    paymentRadios.forEach(radio => {
        radio.addEventListener("change", function() {
            paymentForms.forEach(form => form.classList.remove("active"));
            const targetForm = document.getElementById(this.value + "-form");
            if (targetForm) {
                targetForm.classList.add("active");
                if (this.value === "TF") {
                    showBankDetails();
                }
            }
            document.getElementById("payment-error").style.display = "none";
            updateButtonState();
        });
    });

    // Card number formatting
    const cardNumberInput = document.querySelector("input[name='card_number']");
    if (cardNumberInput) {
        cardNumberInput.addEventListener("input", function(e) {
            let value = e.target.value.replace(/\s/g, '').replace(/[^0-9]/gi, '');
            let parts = [];
            for (let i = 0, len = value.length; i < len; i += 4) {
                parts.push(value.substring(i, i + 4));
            }
            e.target.value = parts.join(' ').substring(0, 19);
        });
    }

    // Update button state
    function updateButtonState() {
        const shippingChecked = document.querySelector("input[name='shipping']:checked");
        const paymentChecked = document.querySelector("input[name='metode_pembayaran']:checked");
        const activeForm = document.querySelector(".payment-forms.active");
        
        let isValid = shippingChecked && paymentChecked;
        
        if (activeForm && isValid) {
            const requiredInputs = activeForm.querySelectorAll("[required]");
            for (let input of requiredInputs) {
                if (!input.value.trim()) {
                    isValid = false;
                    break;
                }
            }
        }
        
        btnSubmit.disabled = !isValid;
    }

    // Input change monitoring
    form.addEventListener("input", updateButtonState);
    form.addEventListener("change", updateButtonState);

    // Form submission
    form.addEventListener("submit", function(e) {
        e.preventDefault();
        
        const shippingChecked = document.querySelector("input[name='shipping']:checked");
        if (!shippingChecked) {
            document.getElementById("shipping-error").style.display = "inline";
            return false;
        }
        
        const paymentChecked = document.querySelector("input[name='metode_pembayaran']:checked");
        if (!paymentChecked) {
            document.getElementById("payment-error").style.display = "inline";
            return false;
        }
        
        const activeForm = document.querySelector(".payment-forms.active");
        if (activeForm) {
            const requiredInputs = activeForm.querySelectorAll("[required]");
            for (let input of requiredInputs) {
                if (!input.value.trim()) {
                    alert("Lengkapi semua field wajib pada metode pembayaran yang dipilih!");
                    input.focus();
                    return false;
                }
            }
        }
        
        // All validations passed - submit form
        btnSubmit.disabled = true;
        btnSubmit.textContent = "Memproses...";
        form.submit();
    });

    // Initial button state
    updateButtonState();
});
</script>

<?php include_once APPROOT . "/views/templates/footer.php"; ?>
