<?php
session_start();

echo "<h3>Isi Seluruh Data Session:</h3>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
?>