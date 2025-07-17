<?php
session_start();
require_once 'koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ambil data user dari database
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("User tidak ditemukan");
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("User tidak ditemukan");
}

// Proses update jika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $name = $_POST['name'];
    $note = $_POST['note'];

    // Handle upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $filename = uniqid() . '_' . basename($_FILES['profile_picture']['name']);
        $targetPath = $uploadDir . $filename;

        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetPath)) {
            if ($user['profile_picture'] !== 'default.jpg') {
                @unlink($uploadDir . $user['profile_picture']);
            }
            $profilePicture = $filename;
        }
    } else {
        $profilePicture = $user['profile_picture'];
    }

    $stmt = $pdo->prepare("UPDATE users SET name = ?, note = ?, profile_picture = ? WHERE id = ?");
    $stmt->execute([$name, $note, $profilePicture, $_SESSION['user_id']]);

    // Refresh data
    header("Location: profile.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Pengguna</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="css/profile.css">
  <style>
    /* CSS dari sebelumnya tetap sama */
  </style>
</head>
<body>
  <div class="profile-container">
    <!-- Header Gradient -->
    <div class="profile-header"></div>
    
    <!-- Foto Profil -->
    <div class="profile-picture">
      <?php if ($user['profile_picture'] && file_exists('uploads/'.$user['profile_picture'])): ?>
        <img src="uploads/<?= htmlspecialchars($user['profile_picture']) ?>" alt="Profile Picture">
      <?php else: ?>
        <i class="fas fa-user"></i>
      <?php endif; ?>
    </div>
    
    <!-- Info Pengguna -->
    <div class="profile-info">
      <h1><?= htmlspecialchars($user['name']) ?></h1>
      <p><?= htmlspecialchars($user['email']) ?></p>
    </div>
    
    <!-- Tombol Aksi -->
    <div class="action-buttons">
<button class="btn-edit" onclick="openModal()">Edit Profile</button>
      <button class="btn-activity" onclick="location.href='aktivitas.php'">Aktivitas</button>
      <button class="btn-logout" onclick="logout()">Log Out</button>
    </div>
    
    <!-- Section Note -->
    <div class="note-section">
      <h2>Note</h2>
      <p><?= $user['note'] ? nl2br(htmlspecialchars($user['note'])) : 'Tidak ada catatan' ?> 
      </p>
    </div>
  </div>

  <!-- Modal Edit Profile -->
<div id="editModal" class="modal" style="display:none;">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <h2>Edit Profil</h2>
    <form method="POST" enctype="multipart/form-data">
      <input type="hidden" name="update_profile" value="1">
      <div class="form-group">
        <label for="name">Nama</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
      </div>
      <div class="form-group">
        <label for="profile_picture">Foto Profil</label>
        <input type="file" id="profile_picture" name="profile_picture">
      </div>
      <div class="form-group">
        <label for="note">Catatan</label>
        <textarea id="note" name="note" rows="4"><?= htmlspecialchars($user['note']) ?></textarea>
      </div>
      <button type="submit" class="btn-submit">Simpan</button>
    </form>
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
  
  <script>
    function logout() {
      if (confirm("Apakah Anda yakin ingin keluar?")) {
        window.location.href = 'logout.php';
      }
    }


  function openModal() {
    document.getElementById("editModal").style.display = "flex";
  }

  function closeModal() {
    document.getElementById("editModal").style.display = "none";
  }

  // Optional: Tutup modal jika klik di luar kontennya
  window.onclick = function(event) {
    const modal = document.getElementById("editModal");
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
  const currentPage = window.location.pathname.split("/").pop();

document.querySelectorAll(".bottom-nav .nav-item").forEach((link) => {
  if (link.getAttribute("href").includes(currentPage)) {
    link.classList.add("active");
  } else {
    link.classList.remove("active");
  }
});


  </script>
</body>
</html>