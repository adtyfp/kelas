<?php
require_once 'koneksi.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Ambil data user
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Proses form update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $note = $_POST['note'];
    
    // Handle file upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $filename = uniqid() . '_' . basename($_FILES['profile_picture']['name']);
        $targetPath = $uploadDir . $filename;
        
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetPath)) {
            // Hapus foto lama jika bukan default
            if ($user['profile_picture'] !== 'default.jpg') {
                @unlink($uploadDir . $user['profile_picture']);
            }
            $profilePicture = $filename;
        }
    } else {
        $profilePicture = $user['profile_picture'];
    }
    
    // Update database
    $stmt = $pdo->prepare("UPDATE users SET name = ?, note = ?, profile_picture = ? WHERE id = ?");
    $stmt->execute([$name, $note, $profilePicture, $_SESSION['user_id']]);
    
    $_SESSION['success_message'] = "Profil berhasil diperbarui";
    header('Location: profile.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profil</title>
    <style>
        /* Tambahkan styling untuk form edit */
        .edit-form {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .btn-submit {
            background: #9c27b0;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="edit-form">
        <h1>Edit Profil</h1>
        <form method="POST" enctype="multipart/form-data">
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
                <textarea id="note" name="note" rows="5"><?= htmlspecialchars($user['note']) ?></textarea>
            </div>
            
            <button type="submit" class="btn-submit">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>