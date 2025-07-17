<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_folder'];

    // Insert dan ambil ID terakhir
    $stmt = $pdo->prepare("INSERT INTO folder (nama_folder, created_at) VALUES (?, NOW())");
    $stmt->execute([$nama]);
    $folderId = $pdo->lastInsertId();

    // Redirect langsung ke materi.php
    header("Location: materi.php?id_folder=" . $folderId);
    exit;
}
?>
