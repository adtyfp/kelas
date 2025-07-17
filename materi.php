<?php
require 'koneksi.php';

$id_folder = $_GET['id_folder'] ?? null;
if (!$id_folder) {
    die("Folder tidak ditemukan.");
}

// Bookmark toggle logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bookmark_id'])) {
    $id = $_POST['bookmark_id'];
    $stmt = $pdo->prepare("SELECT is_bookmarked FROM materi WHERE id = ?");
    $stmt->execute([$id]);
    $current = $stmt->fetchColumn();
    $new = $current ? 0 : 1;
    $update = $pdo->prepare("UPDATE materi SET is_bookmarked = ? WHERE id = ?");
    $update->execute([$new, $id]);
    header("Location: materi.php?id_folder=$id_folder");
    exit;
}

// Upload logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload_materi'])) {
    $nama_materi = $_POST['nama_materi'] ?? '';
    $folder_id = $_POST['folder_id'] ?? 0;

    if (!empty($nama_materi) && isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newName = uniqid() . '.' . $ext;
        $dest = 'uploads/' . $newName;

        if (!is_dir('uploads'))
            mkdir('uploads');
        if (move_uploaded_file($file['tmp_name'], $dest)) {
            $stmt = $pdo->prepare("INSERT INTO materi (folder_id, nama_materi, nama_file, created_at) VALUES (?, ?, ?, NOW())");
            $stmt->execute([$folder_id, $nama_materi, $newName]);
            header("Location: materi.php?id_folder=$folder_id");
            exit;
        } else {
            echo "<script>alert('Gagal upload file');</script>";
        }
    }
}

// Ambil info folder
$stmt = $pdo->prepare("SELECT * FROM folder WHERE id = ?");
$stmt->execute([$id_folder]);
$folder = $stmt->fetch();

$stmtMateri = $pdo->prepare("SELECT * FROM materi WHERE folder_id = ? ORDER BY is_bookmarked DESC, created_at DESC");
$stmtMateri->execute([$id_folder]);
$materiList = $stmtMateri->fetchAll();

function waktuLalu($datetime)
{
    $selisih = time() - strtotime($datetime);
    if ($selisih < 60)
        return $selisih . " detik lalu";
    elseif ($selisih < 3600)
        return floor($selisih / 60) . " menit lalu";
    elseif ($selisih < 86400)
        return floor($selisih / 3600) . " jam lalu";
    else
        return floor($selisih / 86400) . " hari lalu";
}


if (isset($_GET['download'])) {
    $filename = basename($_GET['download']);
    $filepath = __DIR__ . '/uploads/' . $filename;

    if (!file_exists($filepath)) {
    die("File tidak ditemukan.");
}

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        readfile($filepath);
        exit;
    } else {
        echo "<script>alert('File tidak ditemukan!'); window.location.href = 'materi.php?id_folder=" . $_GET['id_folder'] . "';</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Materi: <?= htmlspecialchars($folder['nama_folder']) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f5f2f8;
            color: #333;
        }

        header {
            background: #9C27B0;
            color: white;
            padding: 16px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            font-size: 18px;
            font-weight: 600;
        }

        .material-list {
            padding: 15px;
        }

        .material-card {
            background: white;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .material-badge {
            font-size: 12px;
            background: #9C27B0;
            color: white;
            padding: 4px 8px;
            border-radius: 50px;
            display: inline-block;
            margin-bottom: 6px;
        }

        .material-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .material-type,
        .material-date {
            font-size: 13px;
            color: #555;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 2px;
        }

        .bookmark-btn {
            position: absolute;
            top: 12px;
            right: 12px;
            background: none;
            border: none;
            color: gold;
            font-size: 18px;
            cursor: pointer;
        }

        .download-btn {
            display: inline-block;
            margin-top: 10px;
            width: 100%;
            padding: 10px;
            background: transparent;
            border: 1.5px solid #9C27B0;
            color: #9C27B0;
            border-radius: 30px;
            font-size: 14px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
        }

        .download-btn:hover {
            background: #9C27B0;
            color: white;
        }


        .fab-add {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #9C27B0;
            color: white;
            font-size: 24px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            border: none;
        }

        .form-popup {
            display: none;
            position: fixed;
            bottom: 80px;
            right: 20px;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 9999;
            width: 300px;
        }

        .form-popup input,
        .form-popup button {
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .form-popup button {
            background: #9C27B0;
            color: white;
            border: none;
            font-weight: 600;
        }

        .form-popup.show {
            display: block;
        }

        .empty-message {
            text-align: center;
            color: #aaa;
            padding: 40px 0;
        }
    </style>
</head>

<body>

    <header>
        <a href="home.php" style="color:white; text-decoration:none; margin-right:10px;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1 style="flex:1"><?= htmlspecialchars($folder['nama_folder']) ?></h1>
    </header>

    <div class="material-list">
        <?php if (empty($materiList)): ?>
            <p class="empty-message">Belum ada materi di folder ini.</p>
        <?php else: ?>
            <?php foreach ($materiList as $m): ?>
                <div class="material-card" data-materi-id="<?= $m['id'] ?>">
                    <form method="POST" style="position:absolute; top:12px; right:12px;">
                        <input type="hidden" name="bookmark_id" value="<?= $m['id'] ?>">
                        <button class="bookmark-btn" title="Bookmark">
                            <i class="<?= $m['is_bookmarked'] ? 'fas' : 'far' ?> fa-star"></i>
                        </button>
                    </form>
                    <span class="material-badge"><?= waktuLalu($m['created_at']) ?></span>
                    <div class="material-title"><?= htmlspecialchars($m['nama_materi']) ?></div>
                    <div class="material-type">
                        <i
                            class="fas fa-file-<?= pathinfo($m['nama_file'], PATHINFO_EXTENSION) === 'pdf' ? 'pdf' : 'image' ?>"></i>
                        <?= strtoupper(pathinfo($m['nama_file'], PATHINFO_EXTENSION)) ?>
                    </div>
                    <div class="material-date">
                        <i class="far fa-calendar"></i> <?= date('d M Y', strtotime($m['created_at'])) ?>
                    </div>
                    <a href="materi.php?id_folder=<?= $id_folder ?>&download=<?= urlencode($m['nama_file']) ?>"
                        class="download-btn">
                        Download
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Tombol "+" -->
    <button type="button" class="fab-add" id="fabAddBtn">
        <i class="fas fa-plus"></i>
    </button>

    <!-- Form Upload (hidden by default) -->
    <div class="form-popup" id="popupForm">
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="folder_id" value="<?= $id_folder ?>">
            <input type="text" name="nama_materi" placeholder="Judul Materi" required>
            <input type="file" name="file" required>
            <button type="submit" name="upload_materi">Upload</button>
        </form>
    </div>
    >

    <script>
        const fabBtn = document.getElementById('fabAddBtn');
        const popup = document.getElementById('popupForm');

        // Toggle popup saat tombol "+" ditekan
        fabBtn.addEventListener('click', () => {
            popup.classList.toggle('show');
        });

        // Tutup popup jika klik di luar popup & tombol "+"
        window.addEventListener('click', (e) => {
            const isClickInside = popup.contains(e.target) || fabBtn.contains(e.target);
            if (!isClickInside) {
                popup.classList.remove('show');
            }
        });
    </script>



</body>

</html>