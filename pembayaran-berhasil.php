<?php
session_start();
require 'koneksi.php';

// Pastikan user sudah login
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    header("Location: login.php");
    exit;
}

// Ambil transaksi terakhir berdasarkan waktu
$stmt = $pdo->prepare("SELECT id_transaksi FROM transaksi_pembayaran WHERE user_id = ? ORDER BY created_at DESC LIMIT 1");
$stmt->execute([$user_id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

// Ambil ID Transaksi
$id_transaksi = $data['id_transaksi'] ?? '-';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0; padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #F3E5F5;
            color: #4A148C;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            min-height: 100vh;
            padding: 20px;
        }

        i {
            font-size: 72px;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        p {
            font-size: 14px;
            margin-bottom: 30px;
            color: #555;
        }

        .buttons {
            display: flex;
            flex-direction: column;
            gap: 12px;
            width: 100%;
            max-width: 300px;
        }

        .btn {
            background-color: #9C27B0;
            color: white;
            text-decoration: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            transition: background 0.2s ease;
            display: block;
            text-align: center;
        }

        .btn:hover {
            background-color: #7B1FA2;
        }

        .btn.secondary {
            background-color: transparent;
            color: #9C27B0;
            border: 2px solid #9C27B0;
        }

        .btn.secondary:hover {
            background-color: #F3E5F5;
        }
    </style>
</head>
<body>

    <i class="fas fa-check-circle"></i>
    <h1>Pembayaran Berhasil</h1>
    <p>Terima kasih! Transaksi Anda telah berhasil.<br><strong>ID Transaksi:</strong> <?= htmlspecialchars($id_transaksi) ?></p>

    <div class="buttons">
        <a href="riwayat-transaksi.php" class="btn">Lihat Transaksi</a>
        <a href="home.php" class="btn secondary">Kembali ke Beranda</a>
    </div>

</body>
</html>
