<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Input Tugas</title>
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
    input[type="date"],
    select,
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

  <div class="input-tugas-container">
    <h2>Input Tugas</h2>

    <form id="formTugas" action="proses-tugas.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="namaTugas">Nama Tugas</label>
        <input type="text" id="namaTugas" name="nama_tugas" required placeholder="Contoh: Makalah Ekonomi Politik" />
      </div>

      <div class="form-group">
        <label for="mataKuliah">Mata Kuliah</label>
        <select id="mataKuliah" name="mata_kuliah" required>
          <option value="">-- Pilih Mata Kuliah --</option>
          <option>Ekonomi Politik</option>
          <option>Sosiologi</option>
          <option>Manajemen Proyek</option>
          <option>Bahasa Indonesia</option>
        </select>
      </div>

      <div class="form-group">
        <label for="deadline">Deadline</label>
        <input type="date" id="deadline" name="deadline" required />
      </div>

      <div class="form-group">
        <label for="uploadFile">Upload File</label>
        <input type="file" id="uploadFile" name="file" />
      </div>

      <button type="submit" class="submit-btn">Kirim Tugas</button>
    </form>
  </div>

</body>
</html>
