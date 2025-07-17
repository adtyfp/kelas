<?php
// Mulai session jika perlu autentikasi
session_start();

// Konfigurasi koneksi database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "apkkelasvirtual";

// Buat koneksi
$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek jika request-nya POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ambil data dari form
    $namaTugas   = trim($_POST['nama_tugas'] ?? '');
    $mataKuliah  = trim($_POST['mata_kuliah'] ?? '');
    $deadline    = trim($_POST['deadline'] ?? '');
    $namaFile    = '';

    // Validasi wajib isi
    if (empty($namaTugas) || empty($mataKuliah) || empty($deadline)) {
        die("❌ Semua field wajib diisi.");
    }

    // Validasi dan proses file upload jika ada
    if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Amankan nama file dan validasi ekstensi
        $allowedExtensions = ['pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg', 'ppt', 'pptx'];
        $originalName = $_FILES['file']['name'];
        $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        if (!in_array($ext, $allowedExtensions)) {
            die("❌ Ekstensi file tidak diizinkan.");
        }

        $namaFile = uniqid() . '_' . preg_replace("/[^a-zA-Z0-9\._-]/", "", $originalName);
        $targetPath = $uploadDir . $namaFile;

        // Pindahkan file
        if (!move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
            die("❌ Gagal mengupload file.");
        }
    }

    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO tugas (nama_tugas, mata_kuliah, deadline, file, is_uploaded) VALUES (?, ?, ?, ?, 1)");

    if ($stmt) {
        $stmt->bind_param("ssss", $namaTugas, $mataKuliah, $deadline, $namaFile);

        if ($stmt->execute()) {
            // Redirect ke halaman tugas/kumpulkan
            header("Location: kumpulkan.php?status=berhasil");
            exit;
        } else {
            echo "❌ Gagal menyimpan ke database: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "❌ Gagal menyiapkan query: " . $conn->error;
    }
} else {
    echo "❌ Method tidak valid.";
}

$conn->close();
?>
