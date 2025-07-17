<?php
session_start();
require 'koneksi.php';

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header("Location: login.php");
    exit;
}

// Ambil data dari form
$metode     = $_POST['metode_pembayaran'] ?? '';
$paket_slug = $_POST['nama_paket'] ?? '';         // e.g. 'public-speaking' atau 'ebook-tematik'
$jenis      = $_POST['jenis_paket'] ?? 'bulanan'; // e.g. 'bulanan', 'tahunan', 'kursus'
$tier       = $_POST['paket_tier'] ?? '';         // e.g. 'regular', 'premium'
$harga      = (int) ($_POST['total_harga'] ?? 0);

// Validasi input
if (!$metode || !$paket_slug || !$tier || $harga <= 0) {
    die("Data tidak lengkap.");
}

// Format nama produk
if ($jenis === 'kursus') {
    $produk = "Kelas Individu - " . ucwords(str_replace('-', ' ', $paket_slug));
} elseif ($jenis === 'modul') {
    $produk = "Modul - " . ucwords(str_replace('-', ' ', $paket_slug));
} elseif ($jenis === 'ebook') {
    $produk = "E-Book - " . ucwords(str_replace('-', ' ', $paket_slug));
} elseif ($jenis === 'event') {
    $produk = "Mini -" . ucwords(str_replace('-', ' ', $paket_slug));
} elseif ($jenis === 'webinar') {
    $produk = "Webinar -" . ucwords(str_replace('-', ' ', $paket_slug));
}else {
    $produk = "Langganan " . ucfirst($jenis) . " Kelas Virtual";
}

// Fungsi generate ID transaksi dan nomor seri
function generateIdTransaksi() {
    return 'TRX' . date('YmdHis') . rand(1000, 9999);
}

function generateNoSeri() {
    return 'NS' . strtoupper(bin2hex(random_bytes(5)));
}

$id_transaksi = generateIdTransaksi();
$no_seri = generateNoSeri();

// Simpan transaksi ke database
$stmt = $pdo->prepare("INSERT INTO transaksi_pembayaran 
    (user_id, produk, paket_tier, metode_pembayaran, total_harga, id_transaksi, no_seri_produk, created_at) 
    VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
$stmt->execute([
    $user_id,
    $produk,
    $tier,
    $metode,
    $harga,
    $id_transaksi,
    $no_seri
]);

// Redirect ke halaman sukses
header("Location: pembayaran-berhasil.php");
exit;
?>
