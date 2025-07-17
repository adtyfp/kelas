<?php
session_start();
require 'koneksi.php';

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header("Location: login.php");
    exit;
}

// Ambil notifikasi umum + milik user
$stmt = $pdo->prepare("SELECT * FROM notifikasi WHERE user_id IS NULL OR user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$notifikasiList = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0; padding: 0; box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background-color: #f6f6f6;
            color: #333;
        }
        .header {
            background-color: #9C27B0;
            color: white;
            padding: 15px 20px;
            display: flex;
            align-items: center;
        }
        .header i {
            font-size: 20px;
            margin-right: 10px;
            cursor: pointer;
        }
        .header h1 {
            font-size: 18px;
            font-weight: 600;
        }
        .container {
            padding: 15px;
            max-width: 600px;
            margin: 0 auto;
        }
        .notifikasi {
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.06);
        }
        .judul {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .isi {
            font-size: 14px;
            color: #555;
        }
        .tanggal {
            font-size: 12px;
            color: #999;
            margin-top: 10px;
            text-align: right;
        }
        .poster-diskon {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
            object-fit: cover;
        }

        /* Mobile */
        @media (max-width: 480px) {
            .header h1 {
                font-size: 16px;
            }
            .judul {
                font-size: 15px;
            }
            .isi {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <a href="home.php"><i class="fas fa-arrow-left" style="color: white;"></i></a>
        <h1>Notifikasi</h1>
    </header>

    <!-- Content -->
    <main class="container">
        <?php if (count($notifikasiList) === 0): ?>
            <p>Tidak ada notifikasi saat ini.</p>
        <?php else: ?>
            <?php foreach ($notifikasiList as $notif): ?>
                <div class="notifikasi">
                    <div class="judul"><?= htmlspecialchars($notif['judul']) ?></div>

                    <?php
                    // Tampilkan gambar jika notifikasi adalah diskon
                    $judul = strtolower($notif['judul']);
                    if (strpos($judul, 'diskon') !== false):
                        // Ganti dengan poster dinamis jika kamu punya kolom gambar di DB
                        $poster = 'assets/poster-diskon.jpg'; // <- Gambar default
                    ?>
                        <img src="<?= $poster ?>" alt="Poster Diskon" class="poster-diskon">
                    <?php endif; ?>

                    <div class="isi"><?= nl2br(htmlspecialchars($notif['isi'])) ?></div>
                    <div class="tanggal"><?= date('d M Y, H:i', strtotime($notif['created_at'])) ?></div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </main>
</body>
</html>
