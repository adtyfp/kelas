<?php
session_start(); // Memulai session

// Cek apakah user sudah login (opsional, tergantung kebutuhan)
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, arahkan ke halaman login atau tampilkan pesan
    header("Location: login.php");
    exit();
}
// koneksi
$koneksi = new mysqli("localhost", "root", "", "apkkelasvirtual");

$tugas = [];
$kuis = [];

// Ambil hanya tugas dari sistem (bukan hasil upload user)
$tugasResult = $koneksi->query("SELECT * FROM tugashome WHERE is_uploaded = 0 ORDER BY deadline ASC");
while ($row = $tugasResult->fetch_assoc()) {
    $tugas[] = $row;
}

$kuisResult = $koneksi->query("SELECT * FROM kuis ORDER BY id DESC");
while ($row = $kuisResult->fetch_assoc()) {
    $kuis[] = $row;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas - Edukasi Mobile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f5f5f5;
            padding-bottom: 70px;
        }

        .header {
            background-color: #9c27b0;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-title {
            font-weight: 700;
            font-size: 18px;
            flex-grow: 1;
            text-align: center;
        }

        .header-icon {
            font-size: 20px;
            cursor: pointer;
            padding: 5px;
        }

        .tab-menu {
            display: flex;
            background-color: white;
            border-bottom: 1px solid #e0e0e0;
            position: relative;
            overflow: hidden;
        }

        .tab {
            flex: 1;
            text-align: center;
            padding: 15px 0;
            font-weight: 500;
            cursor: pointer;
            position: relative;
            color: #7f8c8d;
            z-index: 1;
            transition: color 0.3s ease;
        }

        .tab.active {
            color: #9c27b0;
        }

        .tab-indicator {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            width: 50%;
            background-color: #9c27b0;
            border-radius: 3px 3px 0 0;
            transition: all 0.3s ease;
        }

        .content-container {
            position: relative;
            overflow: hidden;
            min-height: 300px;
        }

        .content {
            position: absolute;
            width: 100%;
            padding: 15px;
            transition: all 0.4s ease;
            top: 0;
            left: 0;
            opacity: 0;
            pointer-events: none;
        }

        .content.active {
            opacity: 1;
            pointer-events: auto;
            position: relative;
        }

        .task-card {
            background-color: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .task-title {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 10px;
            color: #2c3e50;
            padding-right: 80px;
        }

        .progress-container {
            margin-bottom: 15px;
        }

        .progress-bar {
            height: 6px;
            background-color: #ecf0f1;
            border-radius: 3px;
            overflow: hidden;
            margin-bottom: 5px;
        }

        .progress {
            height: 100%;
            background-color: #9c27b0;
            width: 45%;
            border-radius: 3px;
            transition: width 0.3s ease;
        }

        .status-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 12px;
            font-weight: 500;
            color: #f44336;
        }

        .submit-btn {
            display: inline-block;
            padding: 6px 12px;
            background-color: #9c27b0;
            color: white;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .submit-btn:hover {
            background-color: #8e24aa;
            transform: scale(1.05);
        }

        .due-date {
            display: flex;
            align-items: center;
            margin-top: 15px;
            font-size: 12px;
            color: #7f8c8d;
        }

        .due-date i {
            margin-right: 5px;
            color: #9c27b0;
        }

        .quiz-card {
            background-color: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .quiz-title {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .quiz-status-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 12px;
            font-weight: 500;
        }

        .quiz-status-badge.belum {
            color: #f44336;
            /* Merah */
        }

        .quiz-status-badge.selesai {
            color: #4caf50;
            /* Hijau */
        }

        .quiz-duration {
            display: flex;
            align-items: center;
            font-size: 12px;
            color: #7f8c8d;
        }

        .quiz-duration i {
            margin-right: 5px;
            color: #9c27b0;
        }

        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #F2F2F2;
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 10px 0;
            border-top: 1px solid #e0e0e0;
            z-index: 1000;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 10px;
            color: #777;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .nav-item i {
            font-size: 20px;
            margin-bottom: 3px;
        }

        .nav-item.active {
            color: #7D2AE8;
            font-weight: bold;
        }

        .nav-logo-wrapper {
            position: relative;
            top: -20px;
            z-index: 10;
        }

        .nav-logo img {
            height: 40px;
            width: auto;
            display: block;
            transition: transform 0.3s ease;
        }

        .nav-logo img:hover {
            transform: scale(1.05);
        }

        /* Slide Animations */
        .slide-in-left {
            animation: slideInLeft 0.4s forwards;
        }

        .slide-out-left {
            animation: slideOutLeft 0.4s forwards;
        }

        .slide-in-right {
            animation: slideInRight 0.4s forwards;
        }

        .slide-out-right {
            animation: slideOutRight 0.4s forwards;
        }

        @keyframes slideInLeft {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutLeft {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(-100%);
                opacity: 0;
            }
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
    </style>
</head>
<body>

<div class="header">
    <div class="header-title">Tugas</div>
    <div class="header-icon" onclick="refreshPage()"><i class="fas fa-sync-alt"></i></div>
</div>

<div class="tab-menu">
    <div class="tab active" onclick="switchTab('tugas')">Tugas</div>
    <div class="tab" onclick="switchTab('kuis')">Kuis</div>
    <div class="tab-indicator"></div>
</div>

<div class="content-container">
    <div class="content content-tugas active" id="tugasContent">
        <?php include 'konten/konten-tugas.php'; ?>
    </div>

    <div class="content content-kuis" id="kuisContent">
        <?php include 'konten/konten-kuis.php'; ?>
    </div>
</div>

<nav class="bottom-nav">
    <a href="home.php" class="nav-item"><i class="fas fa-home"></i><span>Beranda</span></a>
    <a href="tugas.php" class="nav-item active"><i class="fas fa-tasks"></i><span>Tugas</span></a>
    <div class="nav-logo-wrapper"><a href="home.php" class="nav-logo"><img src="asset/kelas.png" alt="Kelas Virtual"></a></div>
    <a href="pesan.php" class="nav-item"><i class="fas fa-comment-alt"></i><span>Pesan</span></a>
    <a href="profile.php" class="nav-item"><i class="fas fa-user"></i><span>Profil</span></a>
</nav>

<script>
    function switchTab(tabName) {
        const tabs = document.querySelectorAll('.tab');
        const tabIndicator = document.querySelector('.tab-indicator');
        const tugasContent = document.getElementById('tugasContent');
        const kuisContent = document.getElementById('kuisContent');

        tabs.forEach(tab => tab.classList.remove('active'));
        const activeTab = document.querySelector(`.tab[onclick*="${tabName}"]`);
        if (activeTab) activeTab.classList.add('active');

        tugasContent.classList.remove('active');
        kuisContent.classList.remove('active');

        if (tabName === 'tugas') {
            tabIndicator.style.transform = 'translateX(0)';
            tugasContent.classList.add('active');
        } else {
            tabIndicator.style.transform = 'translateX(100%)';
            kuisContent.classList.add('active');
        }
    }

    function goBack() {
        window.history.back();
    }

    function refreshPage() {
        location.reload();
    }

    function startQuiz(id) {
        window.location.href = 'mulai-kuis.php?id=' + id;
    }
</script>
</body>
</html>
