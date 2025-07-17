<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $folder_id = $_POST['folder_id'];
    $nama_materi = $_POST['nama_materi'];
    $file = $_FILES['file'];

    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true); // <- Tambahkan permission 0777

    $nama_file = uniqid() . '_' . basename($file['name']);
    $targetPath = $uploadDir . $nama_file;

    // Debug jika gagal upload
    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        echo "Gagal upload file. Coba periksa permission folder uploads atau ukuran file.";
        echo "<br><b>From:</b> " . $file['tmp_name'];
        echo "<br><b>To:</b> " . $targetPath;
        exit;
    }

    $pdo->prepare("INSERT INTO materi (folder_id, nama_file, nama_materi, created_at) VALUES (?, ?, ?, NOW())")
        ->execute([$folder_id, $nama_file, $nama_materi]);

    header("Location: materi.php?id_folder=$folder_id");
    exit;
}
