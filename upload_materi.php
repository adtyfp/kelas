<?php
$id_folder = $_GET['id_folder'] ?? 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Upload Materi</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #fbeeff;
      padding: 20px;
      max-width: 500px;
      margin: auto;
    }

    h2 {
      color: #9c27b0;
      text-align: center;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    label {
      display: block;
      font-weight: 600;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="file"] {
      width: 100%;
      padding: 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    .submit-btn {
      background: #9c27b0;
      color: white;
      padding: 12px;
      width: 100%;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      margin-top: 10px;
    }

    .submit-btn:hover {
      background: #7b1fa2;
    }
  </style>
</head>
<body>

  <div class="input-materi-container">
    <h2>Upload Materi</h2>

    <form action="proses_upload.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="folder_id" value="<?= $id_folder ?>">

      <div class="form-group">
        <label for="namaMateri">Nama Materi</label>
        <input type="text" id="namaMateri" name="nama_materi" required placeholder="Contoh: Modul Ekonomi Dasar" />
      </div>

      <div class="form-group">
        <label for="uploadFile">Upload File</label>
        <input type="file" id="uploadFile" name="file" required />
      </div>

      <button type="submit" class="submit-btn"><i class="fas fa-upload"></i> Upload Materi</button>
    </form>
  </div>
</body>
</html>
