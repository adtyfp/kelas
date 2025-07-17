<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Tahunan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #F9E9F7;
            color: #333;
        }

        .header {
            background-color: #9C27B0;
            color: white;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header-title {
            font-size: 18px;
            font-weight: 600;
            text-align: center;
            flex-grow: 1;
        }

        .back-button,
        .search-icon {
            color: white;
            font-size: 20px;
        }

        .container {
            max-width: 450px;
            margin: 0 auto;
            padding: 20px 15px;
        }

        .pricing-card {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .pricing-card:hover {
            transform: scale(1.02);
        }

        .card-thumbnail {
            height: 150px;
            background-color: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #555;
            font-size: 14px;
            position: relative;
        }

        .card-thumbnail::after {
            content: "Thumbnail Produk";
            position: absolute;
        }

        .card-content {
            padding: 15px;
        }

        .package-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #514F4F;
        }

        .features-list {
            list-style: none;
            margin-bottom: 15px;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 8px;
            font-size: 14px;
            color: #555;
        }

        .feature-icon {
            margin-right: 10px;
            color: #4CAF50;
            min-width: 18px;
        }

        .price-action-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-top: 1px solid #eee;
        }

        .price-container {
            display: flex;
            flex-direction: column;
        }

        .price-label {
            font-size: 12px;
            color: #555;
        }

        .price-amount {
            font-size: 18px;
            font-weight: 700;
            color: #D13704;
        }

        .buy-button {
            padding: 10px 50px;
            background-color: #9C27B0;
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            white-space: nowrap;
        }

        .buy-button:hover {
            background-color: #7B1FA2;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <a href="paket-langganan.php" class="back-button"><i class="fas fa-arrow-left"></i></a>
        <h1 class="header-title">Paket Tahunan</h1>
        <i class="fas fa-search search-icon"></i>
    </header>

    <!-- Main Container -->
    <main class="container">
        <!-- Paket Reguler -->
        <div class="pricing-card">
            <div class="card-thumbnail">
                <!-- Image would go here -->
                 <img src="paket-reguler.jpg" alt="Reguler Package">
            </div>
            <div class="card-content">
                <h2 class="package-title">Reguler</h2>
                <ul class="features-list">
                    <li class="feature-item">
                        <span class="feature-icon"><i class="fas fa-check-square"></i></span>
                        <span>Akses semua kursus selama 12 bulan</span>
                    </li>
                    <li class="feature-item">
                        <span class="feature-icon"><i class="fas fa-check-square"></i></span>
                        <span>Sertifikat digital tanpa batas</span>
                    </li>
                    <li class="feature-item">
                        <span class="feature-icon"><i class="fas fa-check-square"></i></span>
                        <span>Update materi otomatis</span>
                    </li>
                    <li class="feature-item">
                        <span class="feature-icon"><i class="fas fa-check-square"></i></span>
                        <span>Grup komunitas dan webinar umum</span>
                    </li>
                </ul>
                <div class="price-action-container">
                    <div class="price-container">
                        <span class="price-label">Mulai dari</span>
                        <span class="price-amount">Rp799.000</span>
                    </div>
                    <a href="metode-pembayaran.php?paket=reguler-tahunan" class="buy-button">Beli</a>
                </div>
            </div>
        </div>

        <!-- Paket Premium -->
        <div class="pricing-card">
            <div class="card-thumbnail">
                <!-- Image would go here -->
             <img src="paket-premium.jpg" alt="Premium Package">
            </div>
            <div class="card-content">
                <h2 class="package-title">Premium</h2>
                <ul class="features-list">
                    <li class="feature-item">
                        <span class="feature-icon"><i class="fas fa-check-square"></i></span>
                        <span>12 sesi mentoring (1x per bulan)</span>
                    </li>
                    <li class="feature-item">
                        <span class="feature-icon"><i class="fas fa-check-square"></i></span>
                        <span>Sertifikat cetak 2x per tahun</span>
                    </li>
                    <li class="feature-item">
                        <span class="feature-icon"><i class="fas fa-check-square"></i></span>
                        <span>Akses eksklusif ke pelatihan tematik tahunan</span>
                    </li>
                    <li class="feature-item">
                        <span class="feature-icon"><i class="fas fa-check-square"></i></span>
                        <span>Diskon 20% untuk kelas individu dan produk digital</span>
                    </li>
                </ul>
                <div class="price-action-container">
                    <div class="price-container">
                        <span class="price-label">Mulai dari</span>
                        <span class="price-amount">Rp1.099.000</span>
                    </div>
                    <a href="metode-pembayaran.php?paket=premium-tahunan" class="buy-button">Beli</a>
                </div>
            </div>
        </div>

        <!-- Paket Elite -->
        <div class="pricing-card">
            <div class="card-thumbnail">
                <!-- Image would go here -->
                <img src="paket-elite.jpg" alt="Elite Package"> 
            </div>
            <div class="card-content">
                <h2 class="package-title">Elite</h2>
                <ul class="features-list">
                    <li class="feature-item">
                        <span class="feature-icon"><i class="fas fa-check-square"></i></span>
                        <span>36 sesi mentoring privat (3x per bulan)</span>
                    </li>
                    <li class="feature-item">
                        <span class="feature-icon"><i class="fas fa-check-square"></i></span>
                        <span>Sertifikat digital & fisik + laporan portofolio belajar</span>
                    </li>
                    <li class="feature-item">
                        <span class="feature-icon"><i class="fas fa-check-square"></i></span>
                        <span>Webinar dan pelatihan eksklusif setiap kuartal</span>
                    </li>
                    <li class="feature-item">
                        <span class="feature-icon"><i class="fas fa-check-square"></i></span>
                        <span>Akses VIP ke semua event & grup elit</span>
                    </li>
                </ul>
                <div class="price-action-container">
                    <div class="price-container">
                        <span class="price-label">Mulai dari</span>
                        <span class="price-amount">Rp1.499.000</span>
                    </div>
                    <a href="metode-pembayaran.php?paket=elite-tahunan" class="buy-button">Beli</a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>