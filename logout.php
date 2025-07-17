<?php
session_start();

// Menghapus session yang ada
session_unset();
session_destroy();

// Menghapus cookie
if (isset($_COOKIE['nama_cookie'])) {
    setcookie('nama_cookie', '', time() - 3600, '/'); // Menghapus cookie dengan nama 'nama_cookie'
}

// Arahkan ke halaman login atau halaman lain setelah logout
header('Location: login.php');
exit();
?>
