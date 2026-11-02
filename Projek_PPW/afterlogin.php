<?php
session_start();

if (!isset($_SESSION['user_login'])) {
    header('Location: login.php?error=belum_login');
    exit;
}

$nama_lengkap = $_SESSION['user_login']['nama_lengkap'];

$nama_tampil = htmlspecialchars(strtoupper($nama_lengkap), ENT_QUOTES, 'UTF-8');

$halaman = file_get_contents(__DIR__ . '/AfterLogin.html');

$halaman = str_replace('ATHAUR RAHMAN SAPUTRA', $nama_tampil, $halaman);

echo $halaman;
?>
