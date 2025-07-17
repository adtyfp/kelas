<?php
session_start(); // Memulai session

// Cek apakah user sudah login (opsional, tergantung kebutuhan)
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, arahkan ke halaman login atau tampilkan pesan
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aktivitas | Edukasi Mobile</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/aktivitas.css">
</head>

<body>
  <!-- Header -->
  <div class="header">
    <div class="header-icon">
       <a href="home.php"><i class="fas fa-arrow-left" style="color: white;"></i></a>
    </div>
    <div class="header-title">Aktivitas</div>
    <div class="header-icon"><i class="fas fa-search"></i></div>
  </div>

  <!-- Konten Utama -->
  <div class="container">
    <div class="hapus-semua" id="hapusSemua">Hapus Aktivitas</div>

    <div class="aktivitas-list" id="aktivitasList">
      <!-- Aktivitas akan dimuat di sini -->
    </div>
  </div>

  <!-- bottom nav -->
  <nav class="bottom-nav">
    <a href="home.php" class="nav-item">
      <i class="fas fa-home"></i>
      <span>Beranda</span>
    </a>
    <a href="tugas.php" class="nav-item">
      <i class="fas fa-tasks"></i>
      <span>Tugas</span>
    </a>

    <div class="nav-logo-wrapper">
      <a href="home.php" class="nav-logo">
        <img src="asset/kelas.png" alt="Kelas Virtual">
      </a>
    </div>

    <a href="pesan.php" class="nav-item">
      <i class="fas fa-comment-alt"></i>
      <span>Pesan</span>
    </a>
    <a href="profile.php" class="nav-item">
      <i class="fas fa-user"></i>
      <span>Profil</span>
    </a>
  </nav>

  <script src="js/aktivitasscript.js"></script>

</body>

</html>