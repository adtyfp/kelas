<?php
$servername = "localhost";
$database = "apkkelasvirtual";
$username = "root";
$password = "";

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $database);

// Cek koneksi
if (!$conn) {
    // Menampilkan pesan jika koneksi gagal
    die("Koneksi Gagal : " . mysqli_connect_error());
} else {
    // Koneksi berhasil, tidak menampilkan pesan apapun
    // Tidak ada kode yang ditampilkan di sini
}

try {
    $pdo = new PDO("mysql:host=localhost;dbname=apkkelasvirtual", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>
