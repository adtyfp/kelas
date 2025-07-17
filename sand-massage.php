<?php
// TAMPILKAN ERROR PHP
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'koneksi.php';

// CEK SESSION LOGIN
if (!isset($_SESSION['user_id']) || !isset($_SESSION['nama'])) {
    die("❌ ERROR: User belum login!");
}

$user_id = $_SESSION['user_id'];
$nama = $_SESSION['nama'];
$isi_pesan = $_POST['message'] ?? '';
$jenis_pesan = 'text';
$file_path = null;

// LOG INPUTAN UNTUK CEK
file_put_contents('log.txt', print_r([
    'POST' => $_POST,
    'FILES' => $_FILES,
    'SESSION' => $_SESSION
], true));

// CEK FILE GAMBAR/AUDIO
if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
    $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $isAudio = in_array(strtolower($ext), ['mp3', 'wav', 'ogg']);
    $folder = $isAudio ? 'upload/audio/' : 'upload/image/';

    if (!is_dir($folder)) mkdir($folder, 0777, true);

    $filename = time() . '_' . basename($_FILES['file']['name']);
    $targetPath = $folder . $filename;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
        $file_path = $targetPath;
        $jenis_pesan = $isAudio ? 'audio' : 'image';
        $isi_pesan = '';
    } else {
        die("❌ Gagal upload file.");
    }
}

// CEK FILE AUDIO KHUSUS
if (isset($_FILES['audio']) && $_FILES['audio']['error'] === 0) {
    $folder = 'upload/audio/';
    if (!is_dir($folder)) mkdir($folder, 0777, true);

    $filename = time() . '_' . basename($_FILES['audio']['name']);
    $targetPath = $folder . $filename;

    if (move_uploaded_file($_FILES['audio']['tmp_name'], $targetPath)) {
        $file_path = $targetPath;
        $jenis_pesan = 'audio';
        $isi_pesan = '';
    } else {
        die("❌ Gagal upload audio.");
    }
}

// PASTIKAN ADA ISI ATAU FILE
if (empty($isi_pesan) && empty($file_path)) {
    die("❌ Tidak ada pesan atau file dikirim.");
}

// === SIMPAN KE DATABASE ===
try {
    $stmt = $pdo->prepare("INSERT INTO messages (user_id, nama_pengirim, isi_pesan, jenis_pesan, file_path) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $nama, $isi_pesan, $jenis_pesan, $file_path]);
    echo "✅ Pesan berhasil disimpan.";
} catch (PDOException $e) {
    echo "❌ ERROR DB: " . $e->getMessage();
}
