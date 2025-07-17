<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Bulanan</title>
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
            overflow:
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
            padding: 10px 40px;
            background-color: #9C27B0;
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
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
        <h1 class="header-title">Paket Bulanan</h1>
        <i class="fas fa-search search-icon"></i>
    </header>

    <!-- Main Container -->
    <main class="container">

        <!-- Paket Regular -->
        <div class="pricing-card">
            <div class="card-thumbnail">
                <img src="paket-regular.jpg" alt="Regular Package">
            </div>
            <div class="card-content">
                <h2 class="package-title">Regular</h2>
                <ul class="features-list">
                    <li class="feature-item"><span class="feature-icon"><i class="fas fa-check-square"></i></span>Akses
                        semua kursus & materi</li>
                    <li class="feature-item"><span class="feature-icon"><i
                                class="fas fa-check-square"></i></span>Komunitas diskusi online</li>
                    <li class="feature-item"><span class="feature-icon"><i
                                class="fas fa-check-square"></i></span>Event/webinar umum gratis</li>
                    <li class="feature-item"><span class="feature-icon"><i class="fas fa-check-square"></i></span>Update
                        materi otomatis</li>
                </ul>
                <div class="price-action-container">
                    <div class="price-container">
                        <span class="price-label">Mulai dari</span>
                        <span class="price-amount">Rp150.000</span>
                    </div>
                    <a href="metode-pembayaran.php?paket=regular" class="buy-button">Beli</a>
                </div>
            </div>
        </div>

        <!-- Paket Premium -->
        <div class="pricing-card">
            <div class="card-thumbnail">
                <img src="paket-premium.jpg" alt="Premium Package">
            </div>
            <div class="card-content">
                <h2 class="package-title">Premium</h2>
                <ul class="features-list">
                    <li class="feature-item"><span class="feature-icon"><i class="fas fa-check-square"></i></span>1 sesi
                        konsultasi pribadi</li>
                    <li class="feature-item"><span class="feature-icon"><i class="fas fa-check-square"></i></span>Akses
                        konten premium</li>
                    <li class="feature-item"><span class="feature-icon"><i class="fas fa-check-square"></i></span>E-book
                        eksklusif bulanan</li>
                    <li class="feature-item"><span class="feature-icon"><i class="fas fa-check-square"></i></span>Diskon
                        15% kelas individu</li>
                </ul>
                <div class="price-action-container">
                    <div class="price-container">
                        <span class="price-label">Mulai dari</span>
                        <span class="price-amount">Rp199.000</span>
                    </div>
                    <a href="metode-pembayaran.php?paket=premium" class="buy-button">Beli</a>
                </div>
            </div>
        </div>

        <!-- Paket Elite -->
        <div class="pricing-card">
            <div class="card-thumbnail">
                <img src="paket-elite.jpg" alt="Elite Package">
            </div>
            <div class="card-content">
                <h2 class="package-title">Elite</h2>
                <ul class="features-list">
                    <li class="feature-item"><span class="feature-icon"><i class="fas fa-check-square"></i></span>2 sesi
                        mentoring / bulan</li>
                    <li class="feature-item"><span class="feature-icon"><i
                                class="fas fa-check-square"></i></span>Prioritas layanan</li>
                    <li class="feature-item"><span class="feature-icon"><i
                                class="fas fa-check-square"></i></span>Sertifikat cetak gratis</li>
                    <li class="feature-item"><span class="feature-icon"><i
                                class="fas fa-check-square"></i></span>Webinar eksklusif elite</li>
                </ul>
                <div class="price-action-container">
                    <div class="price-container">
                        <span class="price-label">Mulai dari</span>
                        <span class="price-amount">Rp299.000</span>
                    </div>
                    <a href="metode-pembayaran.php?paket=elite" class="buy-button">Beli</a>
                </div>
            </div>
        </div>

    </main>
</body>

</html>