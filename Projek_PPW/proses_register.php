<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}

$email               = trim($_POST['email'] ?? '');
$password            = $_POST['password'] ?? '';
$konfirmasi_password = $_POST['konfirmasi_password'] ?? '';
$nama_lengkap        = trim($_POST['nama_lengkap'] ?? '');
$no_ponsel           = trim($_POST['no_ponsel'] ?? '');
$alamat              = trim($_POST['alamat'] ?? '');

if ($email === '' || $password === '' || $konfirmasi_password === '' || $nama_lengkap === '' || $no_ponsel === '' || $alamat === '') {
    header('Location: register.php?error=kosong');
    exit;
}

if ($password !== $konfirmasi_password) {
    header('Location: register.php?error=password_beda');
    exit;
}

if (!isset($_SESSION['daftar_akun'])) {
    $_SESSION['daftar_akun'] = [];
}

$kunci_email = strtolower($email);

if (isset($_SESSION['daftar_akun'][$kunci_email])) {
    header('Location: register.php?error=email_terdaftar');
    exit;
}

$akun_baru = [
    'email'        => $email,
    'password'     => $password,
    'nama_lengkap' => $nama_lengkap,
    'no_ponsel'    => $no_ponsel,
    'alamat'       => $alamat
];

$_SESSION['daftar_akun'][$kunci_email] = $akun_baru;
$_SESSION['pendaftar_terbaru'] = $nama_lengkap;

header('Location: login.php?pesan=terdaftar');
exit;


?>
