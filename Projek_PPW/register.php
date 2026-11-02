<?php
session_start();

$halaman = file_get_contents(__DIR__ . '/Register_Page.html');

$pesan_html = '';

if (isset($_GET['error'])) {
    $teks_error = '';
    if ($_GET['error'] === 'kosong') {
        $teks_error = 'Semua kolom pendaftaran wajib diisi!';
    } elseif ($_GET['error'] === 'password_beda') {
        $teks_error = 'Password dan Konfirmasi Password tidak sama!';
    } elseif ($_GET['error'] === 'email_terdaftar') {
        $teks_error = 'Email tersebut sudah terdaftar! Silakan gunakan email lain atau langsung masuk.';
    }

    if ($teks_error !== '') {
        $pesan_html = '<div style="background-color: #fee2e2; color: #b91c1c; padding: 10px 12px; border-radius: 6px; font-size: 12.5px; margin-bottom: 14px; border: 1px solid #fca5a5;">'
                    . htmlspecialchars($teks_error, ENT_QUOTES, 'UTF-8')
                    . '</div>';
    }
}

$halaman = str_replace('<!-- PESAN_REGISTER -->', $pesan_html, $halaman);

echo $halaman;
?>
