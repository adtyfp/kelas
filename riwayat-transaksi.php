<?php
session_start();
require 'koneksi.php';

// Simulasi user login jika belum login
$user_id = $_SESSION['user_id'] ?? 1;

// Ambil data transaksi user
$stmt = $pdo->prepare("SELECT * FROM transaksi_pembayaran WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Format mata uang
function formatRupiah($angka) {
    return 'Rp' . number_format($angka ?? 0, 0, ',', '.');
}

// Format tanggal
function formatTanggal($tanggal) {
    if (!$tanggal) return '-';
    return date('d M Y H:i', strtotime($tanggal));
}

// Fungsi aman untuk output teks
function esc($string) {
    return htmlspecialchars($string ?? '-', ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pembelian</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: #f9edf8; color: #333; }
        .container { max-width: 450px; margin: 0 auto; min-height: 100vh; }
        .header {
            background-color: #9C27B0; color: white;
            padding: 15px 20px; display: flex; align-items: center;
        }
        .back-button {
            color: white; font-size: 20px; margin-right: 15px; text-decoration: none;
        }
        .header-title { font-size: 18px; font-weight: 600; }
        .content { padding: 20px; }

        .transaction-card {
            background: white;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 12px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }
        .transaction-title {
            font-size: 16px;
            font-weight: 600;
            color: #9C27B0;
            margin-bottom: 12px;
        }
        .transaction-tier { color: #555; }

        .transaction-meta {
            display: flex;
            flex-direction: column;
            gap: 6px;
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }
        .transaction-meta span {
            display: flex;
            align-items: center;
        }
        .transaction-meta i {
            margin-right: 5px;
            color: #9C27B0;
            font-size: 13px;
        }
        .transaction-date {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }
        .transaction-total {
            font-size: 14px;
            color: #333;
            font-weight: 600;
        }
        .transaction-amount {
            color: rgb(254, 59, 0);
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <a href="home.php" class="back-button"><i class="fas fa-arrow-left"></i></a>
            <h1 class="header-title">Riwayat Pembelian</h1>
        </header>

        <div class="content">
            <?php if (count($transactions) > 0): ?>
                <?php foreach ($transactions as $t): ?>
                    <div class="transaction-card">
                        <h3 class="transaction-title">
                            <?= esc($t['produk']) ?>
                            <?php if (!empty($t['paket_tier'])): ?>
                                <span class="transaction-tier">(<?= esc($t['paket_tier']) ?>)</span>
                            <?php endif; ?>
                        </h3>
                        <div class="transaction-meta">
                            <span><i class="fas fa-receipt"></i> <?= esc($t['id_transaksi']) ?></span>
                            <span><i class="fas fa-barcode"></i> <?= esc($t['no_seri_produk']) ?></span>
                            <span><i class="fas fa-wallet"></i> <?= esc($t['metode_pembayaran']) ?></span>
                        </div>
                        <p class="transaction-date"><?= formatTanggal($t['created_at']) ?></p>
                        <p class="transaction-total">Total Pembelian:
                            <span class="transaction-amount"><?= formatRupiah($t['total_harga']) ?></span>
                        </p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Tidak ada transaksi ditemukan.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
