<?php
session_start();

unset($_SESSION['user_login']);

header('Location: login.php?pesan=logout');
exit;
?>
