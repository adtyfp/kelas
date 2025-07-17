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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tugas UI</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: #fbeeff;
      color: #333;
      padding-bottom: 80px;
    }

    .header {
      background: #9c27b0;
      color: white;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 16px;
      position: sticky;
      top: 0;
      z-index: 10;
    }

    .header h1 {
      font-size: 18px;
      font-weight: 600;
      flex: 1;
      text-align: center;
    }

    .header i:first-child {
      font-size: 18px;
    }

    .header-icons {
      display: flex;
      gap: 15px;
    }

    .content {
      padding: 16px;
    }

    .card {
      background: white;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      margin-bottom: 16px;
    }

    .thumbnail {
      height: 120px;
      background: #ccc;
      border-radius: 8px 8px 0 0;
      overflow: hidden;
    }

    .thumbnail img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    .thumbnail-icon {
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 32px;
      color: white;
      background: #9c27b0;
    }

    .card-content {
      padding: 12px 16px;
    }

    .card-content h2 {
      font-size: 16px;
      font-weight: 600;
      margin-bottom: 6px;
    }

    .card-content p {
      font-size: 14px;
      color: #666;
      margin: 2px 0;
    }

    .deadline-bar {
      background: #ffe1bb;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 13px;
      color: #444;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 10px;
    }

    .fab {
      position: fixed;
      bottom: 80px;
      right: 20px;
      width: 50px;
      height: 50px;
      background: #9c27b0;
      color: white;
      border: none;
      border-radius: 50%;
      font-size: 22px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      z-index: 20;
      cursor: pointer;
    }
  </style>
</head>
<body>

<!-- 🟪 Header -->
<header class="header">
  <a href="tugas.php"><i class="fas fa-arrow-left"></i></a>
  <h1>Kumpulkan</h1>
  <div class="header-icons">
    <i class="fas fa-search"></i>
  </div>
</header>

<!-- 📄 Konten Tugas -->
<main class="content" id="tugas">

<?php
$conn = new mysqli("localhost", "root", "", "apkkelasvirtual");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM tugas ORDER BY id DESC");

if ($result->num_rows > 0) {
  while ($tugas = $result->fetch_assoc()) {
   $file = $tugas['file'];
$ext = '';
$isImage = false;

if (!empty($file)) {
  $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
  $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif']);
}

    echo '<div class="card">';
    echo '<div class="thumbnail">';
    if (!empty($file)) {
      if ($isImage) {
        echo '<img src="uploads/' . htmlspecialchars($file) . '" alt="Thumbnail">';
      } else {
        echo '<div class="thumbnail-icon"><i class="fas fa-file-alt"></i></div>';
      }
    }
    echo '</div>';

    echo '<div class="card-content">
            <h2>' . htmlspecialchars($tugas['nama_tugas']) . '</h2>
            <p><i class="fas fa-book"></i> ' . htmlspecialchars($tugas['mata_kuliah']) . '</p>
            <p><i class="fas fa-calendar-alt"></i> ' . date("d M Y", strtotime($tugas['deadline'])) . '</p>';
    if (!empty($file)) {
      echo '<p><i class="fas fa-file-download"></i> <a href="uploads/' . htmlspecialchars($file) . '" target="_blank">Lihat File</a></p>';
    }
    echo '<div class="deadline-bar">
            <span><i class="fas fa-calendar-check"></i> Deadline</span>
            <span>' . date("d M Y", strtotime($tugas['deadline'])) . '</span>
          </div>
        </div>
      </div>';
  }
} else {
  echo "<p style='text-align: center; color: #999;'>Belum ada tugas yang dikumpulkan.</p>";
}
$conn->close();
?>

</main>

<!-- ➕ Tombol Tambah -->
<button class="fab" onclick="window.location.href='input-tugas.php'">
  <i class="fas fa-plus"></i>
</button>

</body>
</html>
