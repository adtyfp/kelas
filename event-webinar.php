<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Event & Webinar</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-color: #f9e9f7;
      color: #333;
    }

    .header {
      background-color: #9c27b0;
      color: white;
      padding: 15px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 100;
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

    .product-card {
      background-color: white;
      border-radius: 16px;
      overflow: hidden;
      margin-bottom: 20px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .thumbnail {
      background-color: #D9D9D9;
      height: 120px;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      overflow: hidden;
    }

    .thumbnail img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .thumbnail-placeholder {
      position: absolute;
      font-weight: 500;
      color: #555;
      z-index: 1;
    }

    .card-content {
      padding: 20px;
    }

    .product-title {
      font-size: 18px;
      font-weight: 700;
      margin-bottom: 15px;
      color: #000;
    }

    .features-list {
      list-style: none;
      margin-bottom: 20px;
    }

    .feature-item {
      display: flex;
      align-items: flex-start;
      margin-bottom: 10px;
      font-size: 14px;
      color: #444;
    }

    .feature-icon {
      color: green;
      margin-right: 8px;
      margin-top: 2px;
    }

    .price-action-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-top: 10px;
      border-top: 1px solid #eee;
    }

    .price-label {
      font-size: 12px;
      color: #666;
    }

    .price-amount {
      font-size: 16px;
      font-weight: bold;
      color: #d13704;
    }

    .buy-button {
      padding: 8px 24px;
      background-color: #9c27b0;
      color: white;
      border: none;
      border-radius: 50px;
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
    }

    .buy-button:hover {
      background-color: #7b1fa2;
    }
  </style>
</head>

<body>
  <header class="header">
    <a href="home.php" class="back-button"><i class="fas fa-arrow-left"></i></a>
    <h1 class="header-title">Event & Webinar</h1>
    <i class="fas fa-search search-icon"></i>
  </header>

  <main class="container">

    <!-- Mini Workshop -->
    <div class="product-card">
      <div class="thumbnail">
        <img src="https://via.placeholder.com/450x120" alt="Mini Workshop">
        <div class="thumbnail-placeholder">Thumbnail Produk</div>
      </div>
      <div class="card-content">
        <h2 class="product-title">Mini Workshop</h2>
        <ul class="features-list">
          <li class="feature-item"><i class="fas fa-check-circle feature-icon"></i>Topik kekinian: karier, teknologi, personal branding, dll</li>
          <li class="feature-item"><i class="fas fa-check-circle feature-icon"></i>Interaktif: sesi tanya jawab & kuis</li>
          <li class="feature-item"><i class="fas fa-check-circle feature-icon"></i>Sertifikat kehadiran (digital)</li>
        </ul>
        <div class="price-action-container">
          <div>
            <div class="price-label">Mulai dari</div>
            <div class="price-amount">Rp60.000</div>
          </div>
          <a href="metode-pembayaran.php?paket=workshop" class="buy-button">Beli</a>
        </div>
      </div>
    </div>

    <!-- Webinar Umum -->
    <div class="product-card">
      <div class="thumbnail">
        <img src="https://via.placeholder.com/450x120" alt="Desain Grafis Dasar">
        <div class="thumbnail-placeholder">Thumbnail Produk</div>
      </div>
      <div class="card-content">
        <h2 class="product-title">Webinar Umum</h2>
        <ul class="features-list">
          <li class="feature-item"><i class="fas fa-check-circle feature-icon"></i>Lebih intensif, durasi 90–120 menit</li>
          <li class="feature-item"><i class="fas fa-check-circle feature-icon"></i>Tugas praktik & review langsung</li>
          <li class="feature-item"><i class="fas fa-check-circle feature-icon"></i>Bonus: e-book atau modul praktis.</li>
        </ul>
        <div class="price-action-container">
          <div>
            <div class="price-label">Mulai dari</div>
            <div class="price-amount">Rp80000</div>
          </div>
          <a href="metode-pembayaran.php?paket=umum" class="buy-button">Beli</a>
        </div>
      </div>
    </div>

  </main>
</body>

</html>