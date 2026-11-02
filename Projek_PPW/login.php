<?php
session_start();

if (isset($_SESSION['user_login'])) {
    header('Location: afterlogin.php');
    exit;
}

$halaman = file_get_contents(__DIR__ . '/Login.html');

$pesan_html = '';

if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] === 'terdaftar') {
        $info_nama = '';
        if (!empty($_SESSION['pendaftar_terbaru'])) {
            $info_nama = ' atas nama <strong>' . htmlspecialchars($_SESSION['pendaftar_terbaru'], ENT_QUOTES, 'UTF-8') . '</strong>';
        }
        $pesan_html = '<p class="error-message" style="color: #166534; background-color: #dcfce7; padding: 10px 12px; border-radius: 8px; border: 1px solid #86efac;">
            <i class="fa-solid fa-circle-check"></i>
            <span>Pendaftaran' . $info_nama . ' berhasil! Silakan masuk.</span>
        </p>';
    } elseif ($_GET['pesan'] === 'logout') {
        $pesan_html = '<p class="error-message" style="color: #1e40af; background-color: #dbeafe; padding: 10px 12px; border-radius: 8px; border: 1px solid #93c5fd;">
            <i class="fa-solid fa-circle-info"></i>
            <span>Anda telah berhasil keluar dari akun.</span>
        </p>';
    }
}

if (isset($_GET['error'])) {
    $teks_error = 'Maaf, email/nama atau password salah!';
    if ($_GET['error'] === 'belum_terdaftar') {
        $teks_error = 'Belum ada akun terdaftar. Silakan klik "Belum Memiliki Akun" untuk mendaftar terlebih dahulu.';
    } elseif ($_GET['error'] === 'belum_login') {
        $teks_error = 'Silakan masuk terlebih dahulu untuk mengakses halaman perpustakaan.';
    }

    $pesan_html = '<p class="error-message" style="background-color: #fef2f2; padding: 10px 12px; border-radius: 8px; border: 1px solid #fecaca;">
        <i class="fa-solid fa-circle-exclamation"></i>
        <span>' . htmlspecialchars($teks_error, ENT_QUOTES, 'UTF-8') . '</span>
    </p>';
}

$halaman = str_replace('<!-- PESAN_LOGIN -->', $pesan_html, $halaman);

echo $halaman;
?>
