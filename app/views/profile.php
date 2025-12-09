<?php
$user = $data['user'] ?? [];
$role = isset($user['role']) ? strtolower($user['role']) : 'user';

$roleLabel = $role === 'admin' ? 'Administrator' : 'Member';
$roleColor = $role === 'admin' ? '#ff6b6b' : '#4caf50';

// Inisial untuk avatar (huruf pertama nama)
$initial = !empty($user['nama']) ? mb_strtoupper(mb_substr($user['nama'], 0, 1, 'UTF-8')) : 'U';
?>

<style>
/* Container utama */
.profile-wrapper {
    max-width: 1100px;
    margin: 30px auto 60px;
    padding: 0 15px;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
}

/* Layout: kiri info akun, kanan form */
.profile-grid {
    display: grid;
    grid-template-columns: minmax(260px, 340px) minmax(260px, 1fr);
    gap: 24px;
}

/* Card umum */
.profile-card {
    background: #ffffff;
    border-radius: 14px;
    padding: 20px 22px;
    box-shadow: 0 8px 25px rgba(15, 23, 42, 0.06);
    border: 1px solid #f1f5f9;
}

/* Header judul halaman */
.profile-title {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 18px;
}
.profile-title h2 {
    margin: 0;
    font-size: 22px;
    font-weight: 600;
    color: #111827;
}
.profile-breadcrumb {
    font-size: 13px;
    color: #6b7280;
}

/* Avatar & basic info */
.profile-header {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 16px;
}
.profile-avatar {
    width: 64px;
    height: 64px;
    border-radius: 999px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    font-weight: 700;
    color: #ffffff;
    background: linear-gradient(135deg, #ff8a00, #ff5c5c);
    box-shadow: 0 8px 20px rgba(248, 113, 113, 0.4);
}
.profile-main-name {
    font-size: 18px;
    font-weight: 600;
    color: #111827;
}
.profile-main-email {
    font-size: 13px;
    color: #6b7280;
    margin-top: 2px;
}

/* Badge role */
.profile-role-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 600;
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    margin-top: 6px;
}
.profile-role-dot {
    width: 7px;
    height: 7px;
    border-radius: 999px;
}

/* Info list */
.profile-info-list {
    margin-top: 4px;
    font-size: 13px;
}
.profile-info-item {
    display: flex;
    gap: 8px;
    margin-top: 6px;
}
.profile-info-label {
    width: 80px;
    color: #9ca3af;
}
.profile-info-value {
    color: #374151;
}

/* Card admin notice */
.profile-admin-card {
    margin-top: 14px;
    padding: 10px 12px;
    border-radius: 10px;
    background: #fef3c7;
    border: 1px solid #fde68a;
    font-size: 12px;
    color: #92400e;
}

/* Form profil */
.profile-form h4 {
    margin: 0 0 10px;
    font-size: 16px;
    font-weight: 600;
    color: #111827;
}
.profile-form-desc {
    font-size: 13px;
    color: #6b7280;
    margin-bottom: 14px;
}

/* Flash message */
.flash-success, .flash-error {
    padding: 8px 10px;
    border-radius: 8px;
    font-size: 13px;
    margin-bottom: 10px;
}
.flash-success {
    background: #ecfdf3;
    color: #166534;
    border: 1px solid #bbf7d0;
}
.flash-error {
    background: #fef2f2;
    color: #b91c1c;
    border: 1px solid #fecaca;
}

/* Input */
.profile-form-group {
    margin-bottom: 12px;
}
.profile-form-group label {
    display: block;
    font-size: 13px;
    font-weight: 500;
    color: #4b5563;
    margin-bottom: 4px;
}
.profile-form-group input,
.profile-form-group textarea {
    width: 100%;
    padding: 9px 10px;
    border-radius: 9px;
    border: 1px solid #d1d5db;
    font-size: 13px;
    box-sizing: border-box;
    outline: none;
    transition: border-color 0.15s ease, box-shadow 0.15s ease;
}
.profile-form-group input:focus,
.profile-form-group textarea:focus {
    border-color: #ff8a00;
    box-shadow: 0 0 0 2px rgba(255, 138, 0, 0.15);
}
.profile-form-group small {
    font-size: 11px;
    color: #9ca3af;
}

/* Tombol */
.profile-actions {
    display: flex;
    gap: 10px;
    margin-top: 8px;
}
.btn-primary {
    padding: 9px 16px;
    border-radius: 999px;
    border: none;
    background: linear-gradient(135deg, #ff8a00, #ff5c00);
    color: #ffffff;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 8px 18px rgba(249, 115, 22, 0.35);
    transition: transform 0.1s ease, box-shadow 0.1s ease, opacity 0.1s ease;
}
.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 10px 22px rgba(249, 115, 22, 0.45);
}
.btn-secondary-link {
    padding: 0;
    border: none;
    background: transparent;
    font-size: 12px;
    color: #6b7280;
    cursor: pointer;
    text-decoration: underline;
}

/* Responsive */
@media (max-width: 768px) {
    .profile-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="profile-wrapper">
    <div class="profile-title">
        <h2>Profil Akun</h2>
        <div class="profile-breadcrumb">
            Home / Akun / <strong>Profil</strong>
        </div>
    </div>

    <div class="profile-grid">

        <!-- KIRI: INFO AKUN -->
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-avatar">
                    <?= $initial; ?>
                </div>
                <div>
                    <div class="profile-main-name">
                        <?= htmlspecialchars($user['nama'] ?? 'Pengguna'); ?>
                    </div>
                    <div class="profile-main-email">
                        <?= htmlspecialchars($user['email'] ?? '-'); ?>
                    </div>
                    <div class="profile-role-badge">
                        <span class="profile-role-dot" style="background: <?= $roleColor; ?>"></span>
                        <span><?= $roleLabel; ?></span>
                    </div>
                </div>
            </div>

            <div class="profile-info-list">
                <div class="profile-info-item">
                    <div class="profile-info-label">Nama</div>
                    <div class="profile-info-value">
                        <?= htmlspecialchars($user['nama'] ?? '-'); ?>
                    </div>
                </div>
                <div class="profile-info-item">
                    <div class="profile-info-label">Email</div>
                    <div class="profile-info-value">
                        <?= htmlspecialchars($user['email'] ?? '-'); ?>
                    </div>
                </div>
                <div class="profile-info-item">
                    <div class="profile-info-label">No. HP</div>
                    <div class="profile-info-value">
                        <?= !empty($user['no_hp']) ? htmlspecialchars($user['no_hp']) : '-'; ?>
                    </div>
                </div>
                <div class="profile-info-item">
                    <div class="profile-info-label">Alamat</div>
                    <div class="profile-info-value">
                        <?= !empty($user['alamat']) ? nl2br(htmlspecialchars($user['alamat'])) : '-'; ?>
                    </div>
                </div>
            </div>

            <?php if ($role === 'admin'): ?>
                <div class="profile-admin-card">
                    Anda login sebagai <strong>Administrator</strong>.<br>
                    Kelola produk & pesanan melalui
                    <a href="<?= BASEURL; ?>/admin/dashboard" style="color:#b45309; font-weight:600;">Dashboard Admin</a>.
                </div>
            <?php endif; ?>
        </div>

        <!-- KANAN: FORM EDIT -->
        <div class="profile-card profile-form">
            <h4>Ubah Data Profil</h4>
            <div class="profile-form-desc">
                Perbarui informasi dasar akun Anda yang digunakan saat checkout dan komunikasi pesanan.
            </div>

            <?php if (!empty($_SESSION['flash_success'])): ?>
                <div class="flash-success">
                    <?= $_SESSION['flash_success']; unset($_SESSION['flash_success']); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($_SESSION['flash_error'])): ?>
                <div class="flash-error">
                    <?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?>
                </div>
            <?php endif; ?>

            <form action="<?= BASEURL; ?>/profile/update" method="POST">
                <div class="profile-form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" value="<?= htmlspecialchars($user['nama'] ?? '') ?>" required>
                </div>

                <div class="profile-form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
                    <small>Pastikan email aktif, digunakan untuk notifikasi pesanan & reset password.</small>
                </div>

                <div class="profile-form-group">
                    <label>Alamat Lengkap</label>
                    <textarea name="alamat" rows="3"><?= htmlspecialchars($user['alamat'] ?? '') ?></textarea>
                    <small>Contoh: Jalan, RT/RW, Kelurahan, Kecamatan, Kota, Kode Pos.</small>
                </div>

                <div class="profile-form-group">
                    <label>No. HP / WhatsApp</label>
                    <input type="text" name="no_hp" value="<?= htmlspecialchars($user['no_hp'] ?? '') ?>">
                    <small>Digunakan kurir dan admin untuk menghubungi Anda.</small>
                </div>

                <div class="profile-actions">
                    <button type="submit" class="btn-primary">
                        Simpan Perubahan
                    </button>
                    <button type="button" class="btn-secondary-link" onclick="window.location.href='<?= BASEURL; ?>/home'">
                        Kembali ke Beranda
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
