<?php
session_start(); // Memulai session

// Jika session tidak ada, coba ambil dari cookie
if (!isset($_SESSION['user_id']) && isset($_COOKIE['user_id'])) {
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    $_SESSION['user_name'] = $_COOKIE['user_name'];
}

// Cek apakah user sudah login (opsional, tergantung kebutuhan)
if (!isset($_SESSION['user_id'])) {
  // Jika belum login, arahkan ke halaman login atau tampilkan pesan
  header("Location: login.php");
  exit();
}

require 'koneksi.php';

// Ambil data user dari database
$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT name FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

// Cek jika user tidak ditemukan
$namaUser = $user ? htmlspecialchars($user['name']) : 'Pengguna';

// Ambil data folder dari database
$stmt = $pdo->query("SELECT * FROM folder ORDER BY created_at DESC");

// Fungsi waktu lalu
function waktuLalu($tanggal)
{
  if (empty($tanggal))
    return "Waktu tidak tersedia";

  $timestamp = strtotime($tanggal);
  if (!$timestamp)
    return "Format tanggal salah";

  $selisih = time() - $timestamp;

  $detik = $selisih;
  $menit = round($selisih / 60);
  $jam = round($selisih / 3600);
  $hari = round($selisih / 86400);

  if ($detik <= 60)
    return "$detik detik yang lalu";
  else if ($menit <= 60)
    return "$menit menit yang lalu";
  else if ($jam <= 24)
    return "$jam jam yang lalu";
  else
    return "$hari hari yang lalu";
}

?>



<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kelas Saya</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link rel="stylesheet" href="css/home.css">

</head>

<body>

  <!-- Header -->
  <div class="header">
    <div class="header-top">
      <h2>Kelas Saya</h2>
      <div class="header-icons">
        <a href="bantuan.php"><i class="fas fa-headset" style="color: white";></i></a>
        <a href="kalender.php"><i class="far fa-calendar" style="color: white";></i></a>
        <a href="#" id="search-icon"><i class="fas fa-search" style="color: white";></i></a>
        <a href="notifikasi.php"><i class="far fa-bell" style="color: white";></i></a>
        <a href="profile.php"><i class="far fa-user-circle" style="color: white";></i></a>
      </div>
    </div>
    <div class="greeting">Halo! <span><?= $namaUser ?></span></div>
  </div>

  <div class="task-card">
    <div class="task-title">Tugas Selesai</div>
    <div class="progress-bar">
      <div class="progress"></div>
    </div>
    <div class="schedule">
      <div>Jadwal kelas Terdekat</div>
      <div class="schedule-date">15 Jun 2025</div>
    </div>
    <a href="jadwal.html" class="view-all">Lihat Semua Jadwal</a>
    <img src="asset/mikroskop.png" alt="Microscope" class="microscope-img" />
  </div>



  <!-- Shortcut Menu -->
  <div class="shortcut-menu">
    <a href="#" class="shortcut-item" id="kelas-saya-btn">
      <div class="shortcut-icon red"><i class="fas fa-book-open"></i></div>
      <div class="shortcut-label">Kelas Saya</div>
    </a>
    <a href="#" class="shortcut-item" id="materi-kuliah-btn">
      <div class="shortcut-icon yellow"><i class="fas fa-book"></i></div>
      <div class="shortcut-label">Materi Kuliah</div>
    </a>
    <a href="#" class="shortcut-item" id="diskusi-kelas-btn">
      <div class="shortcut-icon blue"><i class="fas fa-comments"></i></div>
      <div class="shortcut-label">Diskusi Kelas</div>
    </a>
    <a href="#" class="shortcut-item" id="toko-btn">
      <div class="shortcut-icon green"><i class="fas fa-shopping-cart"></i></div>
      <div class="shortcut-label">Toko</div>
    </a>
  </div>

  <!-- Activity Section -->
  <div class="activity-section">
    <div class="section-header">
      <div class="section-title">Aktivitas</div>
      <a href="aktivitas.php" class="see-all-link">Lihat Semua</a>
    </div>
    <div class="tags" id="activity-tags">
      <!-- Tag ditampilkan maksimal 3 -->
    </div>
  </div>



  <!-- Announcement -->
  <div class="announcement">
    <h3>Pengumuman</h3>
    <div class="announcement-header">
      <div class="avatar"><i class="fas fa-user"></i></div>
      <strong>Pa Mamat</strong>
    </div>
    <div class="announcement-content">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
      veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
      commodo consequat.
    </div>
  </div>

  <!-- Profile Dosen Section -->
  <div class="profile-dosen-section">
    <h3>Profile Dosen</h3>
    <div class="dosen-cards">
      <a href="dosen-detail.html?id=1" class="dosen-card">
        <img src="https://via.placeholder.com/300x100?text=Dosen+1" alt="">
      </a>
      <a href="dosen-detail.html?id=2" class="dosen-card">
        <img src="https://via.placeholder.com/300x100?text=Dosen+2" alt="">
      </a>
      <a href="dosen-detail.html?id=3" class="dosen-card">
        <img src="https://via.placeholder.com/300x100?text=Dosen+3" alt="">
      </a>
    </div>
  </div>


  <!-- bottom nav -->
  <nav class="bottom-nav">
    <a href="home.php" id="nav-beranda" class="nav-item">
      <i class="fas fa-home"></i>
      <span>Beranda</span>
    </a>
    <a href="tugas.php" id="nav-tugas" class="nav-item">
      <i class="fas fa-tasks"></i>
      <span>Tugas</span>
    </a>

    <div class="nav-logo-wrapper">
      <a href="home.php" class="nav-logo">
        <img src="asset/kelas.png" alt="Kelas Virtual">
      </a>
    </div>

    <a href="pesan.php" id="nav-pesan" class="nav-item">
      <i class="fas fa-comment-alt"></i>
      <span>Pesan</span>
    </a>
    <a href="profile.php" id="nav-profil" class="nav-item">
      <i class="fas fa-user"></i>
      <span>Profile</span>
    </a>
  </nav>



  <!-- Bottom Sheet Overlay -->
  <div class="overlay" id="overlay"></div>

  <!-- Bottom Sheet Kelas Saya -->
  <div class="bottom-sheet" id="kelas-sheet">
    <div class="handle-bar"></div>
    <!-- Category Menu kelas saya-->
    <div class="category-menu">
      <a href="#" class="category-item">
        <div class="category-icon pink">
          <i class="fas fa-book-open"></i>
        </div>
        <div class="category-label">Kelas Saya</div>
      </a>
      <a href="#" class="category-item">
        <div class="category-icon yellow">
          <i class="fas fa-book"></i>
        </div>
        <div class="category-label">Materi Kuliah</div>
      </a>
      <a href="#" class="category-item">
        <div class="category-icon blue">
          <i class="fas fa-comments"></i>
        </div>
        <div class="category-label">Diskusi Kelas</div>
      </a>
      <a href="#" class="category-item">
        <div class="category-icon green">
          <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="category-label">Toko</div>
      </a>
    </div>

    <!-- Dropdown -->
    <div class="dropdown-container">
      <label for="course-select" class="dropdown-label">Pilih Mata Kuliah</label>
      <select id="course-select" class="dropdown">
        <option>Ekonomi Politik Internasional</option>
        <option>Manajemen Bisnis</option>
        <option>Teknologi Informasi</option>
      </select>
    </div>


    <!-- Day Tabs -->
    <div class="day-tabs">
      <button class="day-tab" data-day="sen">Sen 7 Jul</button>
      <button class="day-tab" data-day="sel">Sel 8 Jul</button>
      <button class="day-tab" data-day="rab">Rab 9 Jul</button>
      <button class="day-tab" data-day="kam">Kam 3 Jul</button>
      <button class="day-tab" data-day="jum">Jum 4 Jul</button>
      <button class="day-tab" data-day="sab">Sab 5 Jul</button>
      <button class="day-tab" data-day="min">Min 6 Jul</button>
    </div>


    <!-- Class Card -->
    <div class="class-card">
      <span class="class-badge" id="class-badge">-</span>
      <h3 class="class-title" id="class-title">-</h3>

      <div class="class-info">
        <div class="info-item">
          <i class="far fa-calendar"></i>
          <span id="class-date">-</span>
        </div>
        <div class="info-item">
          <i class="far fa-clock"></i>
          <span id="class-time">-</span>
        </div>
        <div class="info-item">
          <i class="fas fa-user-tie"></i>
          <span id="class-dosen">-</span>
        </div>
      </div>

      <button class="start-btn" onclick="mulaiKelas()">Mulai Kelas</button>
    </div>

  </div>

  <!-- Bottom Sheet Materi Kuliah -->
  <div class="bottom-sheet" id="materi-sheet">
    <div class="handle-bar"></div>
    <!-- Category Menu -->
    <div class="category-menu">
      <a href="#" class="category-item">
        <div class="category-icon pink">
          <i class="fas fa-book-open"></i>
        </div>
        <div class="category-label">Kelas Saya</div>
      </a>
      <a href="#" class="category-item active">
        <div class="category-icon yellow">
          <i class="fas fa-book"></i>
        </div>
        <div class="category-label">Materi Kuliah</div>
      </a>
      <a href="#" class="category-item">
        <div class="category-icon blue">
          <i class="fas fa-comments"></i>
        </div>
        <div class="category-label">Diskusi Kelas</div>
      </a>
      <a href="#" class="category-item">
        <div class="category-icon green">
          <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="category-label">Toko</div>
      </a>
    </div>

    <?php
    require 'koneksi.php';
    $stmt = $pdo->query("SELECT * FROM folder ORDER BY created_at DESC");
    ?>

    <!-- Folder Section -->
    <div class="folder-section">
      <div class="folder-header">
        <form action="tambah_folder.php" method="POST" class="folder-form">
          <input type="text" name="nama_folder" placeholder="Tambah Folder Baru..." required />
          <button type="submit" class="new-folder-btn">+</button>
        </form>
      </div>

      <div class="material-list">
        <?php while ($row = $stmt->fetch()): ?>
          <div class="material-card" data-folder-id="<?= $row['id'] ?>">
            <button class="bookmark-btn" data-folder-id="<?= $row['id'] ?>">
              <i class="fas fa-star"></i>
            </button>

            <span class="material-badge">
              <?= !empty($row['created_at']) ? waktuLalu($row['created_at']) : '-' ?>
            </span>

            <h3 class="material-title"><?= htmlspecialchars($row['nama_folder']) ?></h3>

            <div class="material-date">
              <i class="far fa-calendar"></i>
              <span><?= date('d M Y', strtotime($row['created_at'])) ?></span>
            </div>

            <a href="materi.php?id_folder=<?= $row['id'] ?>" class="view-all-btn">Lihat Semua Materi</a>
          </div>
        <?php endwhile; ?>
      </div>
    </div>


  </div>
  </div>

  <!-- Bottom Sheet Diskusi Kelas -->
  <div class="bottom-sheet" id="Diskusi-sheet">
    <div class="handle-bar"></div>
    <!-- Category Menu -->
    <div class="category-menu">
      <a href="#" class="category-item">
        <div class="category-icon pink">
          <i class="fas fa-book-open"></i>
        </div>
        <div class="category-label">Kelas Saya</div>
      </a>
      <a href="#" class="category-item active">
        <div class="category-icon yellow">
          <i class="fas fa-book"></i>
        </div>
        <div class="category-label">Materi Kuliah</div>
      </a>
      <a href="#" class="category-item">
        <div class="category-icon blue">
          <i class="fas fa-comments"></i>
        </div>
        <div class="category-label">Diskusi Kelas</div>
      </a>
      <a href="#" class="category-item">
        <div class="category-icon green">
          <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="category-label">Toko</div>
      </a>
    </div>
    <!-- Discussion Content -->
    <a href="forum.php" style="text-decoration: none; color: inherit;">
      <div class="discussion-card">
        <div class="card-title">Forum Tanya Jawab</div>
        <div class="card-content">
          <span class="card-user">Admin:</span> Jadi tugas yang tadi dikumpulin kapan bu?
        </div>
      </div>
    </a>


    <div class="discussion-card">
      <div class="card-title">Tugas – Kerja kelompok</div>
      <div class="card-time">Hari ini 09.00</div>
      <div class="card-content">
        Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor ut...
        <a href="#" class="card-link">Selengkapnya</a>
      </div>
      <div class="card-deadline">Dikumpulkan Sebelum 12 Jul 17.00</div>
    </div>
  </div>

  <!-- Bottom Sheet toko Kelas -->
  <div class="bottom-sheet" id="toko-sheet">
    <div class="handle-bar"></div>
    <!-- Category Menu -->
    <div class="category-menu">
      <a href="#" class="category-item">
        <div class="category-icon pink">
          <i class="fas fa-book-open"></i>
        </div>
        <div class="category-label">Kelas Saya</div>
      </a>
      <a href="#" class="category-item active">
        <div class="category-icon yellow">
          <i class="fas fa-book"></i>
        </div>
        <div class="category-label">Materi Kuliah</div>
      </a>
      <a href="#" class="category-item">
        <div class="category-icon blue">
          <i class="fas fa-comments"></i>
        </div>
        <div class="category-label">Diskusi Kelas</div>
      </a>
      <a href="#" class="category-item">
        <div class="category-icon green">
          <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="category-label">Toko</div>
      </a>
    </div>

    <!-- Content Toko -->
    <div class="toko-content">
      <button class="riwayat-btn">
        <a href="riwayat-transaksi.php"><i class="fas fa-receipt"></i>Riwayat Pembelian</a>
        <span class="arrow-icon">→</span>
      </button>

      <h3 class="section-title">Produk Yang Sering Dibeli</h3>

      <div class="produk-grid">
        <div class="produk-item red" onclick="bukaProduk('Paket Langganan')">
          <h4>Paket Langganan</h4>
          <p>Dapatkan akses penuh ke semua materi kursus kami dengan berlangganan paket pilihanmu!</p>
        </div>
        <div class="produk-item blue" onclick="bukaProduk('Kelas Individu')">
          <h4>Kelas Individu</h4>
          <p>Dapatkan bimbingan 1-on-1 langsung dari mentor profesional sesuai kebutuhanmu.</p>
        </div>
        <div class="produk-item pink" onclick="bukaProduk('E Book & Modul')">
          <h4>E Book & Modul</h4>
          <p>Kelas private belajar semua bidang bersama dosen terbaik.</p>
        </div>
        <div class="produk-item green" onclick="bukaProduk('Event & Webinar')">
          <h4>Event & Webinar</h4>
          <p>Belajar langsung dari praktisi & mentor lewat sesi interaktif dan inspiratif!</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Search Pop-up -->
  <div class="search-popup" id="search-popup">
    <input type="text" id="floating-search-input" />
    <div id="search-result-box"></div>
  </div>

  <!-- Di akhir body -->
  <script src="js/script.js"></script>
</body>

</html>