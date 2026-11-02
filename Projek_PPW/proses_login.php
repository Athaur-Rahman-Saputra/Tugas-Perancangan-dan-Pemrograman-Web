<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$input_user = trim($_POST['username'] ?? '');
$password   = $_POST['password'] ?? '';


if (empty($_SESSION['daftar_akun'])) {
    header('Location: login.php?error=belum_terdaftar');
    exit;
}

$akun_ditemukan = null;

foreach ($_SESSION['daftar_akun'] as $akun) {
    $cocok_email = (strtolower($input_user) === strtolower($akun['email']));
    $cocok_nama  = (strtolower($input_user) === strtolower($akun['nama_lengkap']));

    if (($cocok_email || $cocok_nama) && $password === $akun['password']) {
        $akun_ditemukan = $akun;
        break;
    }
}

if ($akun_ditemukan !== null) {
    $_SESSION['user_login'] = $akun_ditemukan;
    header('Location: afterlogin.php');
    exit;
} else {
    header('Location: login.php?error=gagal');
    exit;
}
?>
