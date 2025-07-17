<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Ajukan Komplain</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #FAF3FC;
      color: #333;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    /* ===== HEADER ===== */
    .header {
      position: relative;
      background: linear-gradient(135deg, #9C27B0, #6A0DAD);
      color: white;
      padding: 20px 16px 80px;
      border-bottom-left-radius: 24px;
      border-bottom-right-radius: 24px;
      overflow: hidden;
    }

    .header-top {
      display: flex;
      align-items: center;
      gap: 12px;
      position: relative;
      z-index: 2;
    }

    .header-top a.back-button {
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
      font-weight: bold;
      background: transparent;
      border: none;
      color: white;
      cursor: pointer;
      padding: 6px;
    }

    .header-top h1 {
      font-size: 20px;
      font-weight: 600;
    }

    .subheader {
      margin-top: 20px;
      font-weight: 600;
      font-size: 14px;
      position: relative;
      z-index: 2;
    }

    .description {
      font-size: 13px;
      opacity: 0.9;
      margin-top: 4px;
      z-index: 2;
      position: relative;
    }

    /* ===== GEL OMBANG SVG ===== */
    .wave-shape-top,
    .wave-shape-bottom {
      position: absolute;
      width: 100%;
      height: 160px;
      pointer-events: none;
      z-index: 1;
    }

    .wave-shape-top {
      top: 0;
      right: 0;
    }

    .wave-shape-bottom {
      bottom: -20px;
      left: 0;
    }

    /* ===== KONTEN ===== */
    .content {
      padding: 24px 16px;
      position: relative;
      z-index: 1;
    }

    .content h2 {
      font-size: 16px;
      font-weight: 600;
      margin-bottom: 12px;
    }

    .menu-list {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
      overflow: hidden;
    }

    .menu-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 14px 18px;
      border-bottom: 1px solid #eee;
      font-size: 14px;
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .menu-item:last-child {
      border-bottom: none;
    }

    .menu-item:hover {
      background-color: #f5e9ff;
    }

    .menu-item span {
      transition: transform 0.3s ease;
    }

    .menu-item:hover span {
      transform: translateX(4px);
    }

    /* ===== RESPONSIF ===== */
    @media (min-width: 600px) {
      .header {
        padding: 24px 32px 100px;
      }

      .content {
        padding: 32px;
        max-width: 600px;
        margin: 0 auto;
      }

      .header-top h1 {
        font-size: 24px;
      }
    }
  </style>
</head>
<body>

  <!-- ===== HEADER ===== -->
  <div class="header">
    <!-- Gelombang SVG atas -->
    <svg class="wave-shape-top" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 300" preserveAspectRatio="none">
      <path d="M0,100 C150,200 350,0 600,100 L600,0 L0,0 Z" fill="rgba(255,255,255,0.15)"/>
    </svg>

    <!-- Gelombang SVG bawah -->
    <svg class="wave-shape-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 300" preserveAspectRatio="none">
      <path d="M0,150 C200,0 400,300 600,150 L600,300 L0,300 Z" fill="rgba(255,255,255,0.07)"/>
    </svg>

    <!-- Header Content -->
    <div class="header-top">
      <a href="home.php"><i class="fas fa-arrow-left"></i></a>
      <h1>Ajukan Komplain</h1>
    </div>
    <p class="subheader">Ada Yang Bisa Kami Bantu?</p>
    <p class="description">Sampaikan Keluhanmu Tentang Kelas Virtual di Sini</p>
  </div>

  <!-- ===== KONTEN ===== -->
  <div class="content">
    <h2>Topik yang sering ditanyakan</h2>
    <div class="menu-list">
      <a class="menu-item" href="#"><div>Paket Langganan Tidak Aktif</div><span>➤</span></a>
      <a class="menu-item" href="#"><div>Ganti Paket Langganan</div><span>➤</span></a>
      <a class="menu-item" href="#"><div>Laporan Transaksi Tidak Sah</div><span>➤</span></a>
      <a class="menu-item" href="#"><div>Laporan Bug Security</div><span>➤</span></a>
      <a class="menu-item" href="#"><div>Vidio Pembelajaran Tidak Muncul</div><span>➤</span></a>
      <a class="menu-item" href="ajukan-komplain.php"><div>Ajukan Keluhan Lainnya</div><span>➤</span></a>
    </div>
  </div>

</body>
</html>
