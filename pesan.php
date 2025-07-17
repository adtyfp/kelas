<?php
session_start();
require_once 'koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pesan</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/pesan.css">
</head>

<body>
  <!-- Header -->
  <div class="header">
    <div class="header-icon"><i class="fas fa-user"></i></div>
    <div class="header-title">Pesan</div>
    <div class="header-icons">
      <div class="header-icon"><i class="fas fa-sync-alt"></i></div>
      <div class="header-icon"><i class="fas fa-search"></i></div>
    </div>
  </div>

  <!-- Search Bar -->
  <div class="search-container" id="searchContainer" style="display: none;">
    <i class="fas fa-search search-icon"></i>
    <input type="text" class="search-bar" placeholder="Cari pesan atau kontak..." id="searchInput">
    <i class="fas fa-times close-search" onclick="hideSearch()"></i>
  </div>

  <!-- Chat List -->
  <div class="chat-list" id="chatList">
    <a href="isi-chat.php?id=1" class="chat-item">
      <div class="profile-pic"><i class="fas fa-user"></i></div>
      <div class="chat-content">
        <div class="chat-header">
          <div class="contact-name">John Doe</div>
          <div class="chat-time">10:30</div>
        </div>
        <div class="message-preview">Hai, bagaimana kabarmu?</div>
      </div>
    </a>

    <a href="isi-chat.php?id=2" class="chat-item">
      <div class="profile-pic"><i class="fas fa-user"></i></div>
      <div class="chat-content">
        <div class="chat-header">
          <div class="contact-name">Jane Smith</div>
          <div class="chat-time">Kemarin</div>
        </div>
        <div class="message-preview">Jangan lupa meeting besok jam 9</div>
      </div>
    </a>

    <a href="isi-chat.php?id=3" class="chat-item">
      <div class="profile-pic"><i class="fas fa-user"></i></div>
      <div class="chat-content">
        <div class="chat-header">
          <div class="contact-name">Tim Project</div>
          <div class="chat-time">Senin</div>
        </div>
        <div class="message-preview">Sarah: Saya sudah upload dokumennya</div>
      </div>
    </a>

    <a href="isi-chat.php?id=4" class="chat-item">
      <div class="profile-pic"><i class="fas fa-user"></i></div>
      <div class="chat-content">
        <div class="chat-header">
          <div class="contact-name">Dosen Matematika</div>
          <div class="chat-time">12 Jul</div>
        </div>
        <div class="message-preview">Tugas sudah saya nilai, silakan dicek</div>
      </div>
    </a>

    <a href="isi-chat.php?id=5" class="chat-item">
      <div class="profile-pic"><i class="fas fa-user"></i></div>
      <div class="chat-content">
        <div class="chat-header">
          <div class="contact-name">Support Akademik</div>
          <div class="chat-time">10 Jul</div>
        </div>
        <div class="message-preview">Jadwal ujian telah diupdate</div>
      </div>
    </a>
  </div>

  <!-- Bottom Navigation -->
  <nav class="bottom-nav">
    <a href="home.php" class="nav-item"><i class="fas fa-home"></i><span>Beranda</span></a>
    <a href="tugas.php" class="nav-item"><i class="fas fa-tasks"></i><span>Tugas</span></a>
    <div class="nav-logo-wrapper">
      <a href="home.php" class="nav-logo"><img src="asset/kelas.png" alt="Kelas Virtual"></a>
    </div>
    <a href="pesan.php" class="nav-item active"><i class="fas fa-comment-alt"></i><span>Pesan</span></a>
    <a href="profile.php" class="nav-item"><i class="fas fa-user"></i><span>Profil</span></a>
  </nav>

  <script src="js/pesan.js"></script>
</body>
</html>
