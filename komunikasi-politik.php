<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Komunikasi Politik</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    body {
      margin: 0;
      font-family: sans-serif;
      background: #f7f7f7;
    }

    .header {
      background: #7b2cbf;
      color: white;
      padding: 1rem;
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .header i {
      font-size: 1.2rem;
      cursor: pointer;
    }

    .judul {
      font-size: 1.2rem;
      font-weight: bold;
    }

    .video-container {
      position: relative;
      padding-top: 56.25%;
      margin: 1rem;
    }

    .video-container video {
      position: absolute;
      top: 0; left: 0;
      width: 100%;
      height: 100%;
      border-radius: 10px;
    }

    .video-info {
      margin: 0 1rem 1rem;
    }

    .video-info h2 {
      margin: 0.5rem 0 0.3rem;
      font-size: 1.2rem;
    }

    .video-info p {
      color: #555;
      font-size: 0.95rem;
    }

    .toggle-komentar {
      background: none;
      border: none;
      color: #7b2cbf;
      font-weight: bold;
      font-size: 1rem;
      margin: 1rem;
      cursor: pointer;
    }

    .komentar-container {
      background: #fff;
      margin: 0 1rem 1.5rem;
      padding: 1rem;
      border-radius: 10px;
    }

    .komentar-form {
      display: flex;
      gap: 0.5rem;
      align-items: center;
      margin-bottom: 1rem;
    }

    .komentar-form img {
      width: 35px;
      border-radius: 50%;
    }

    .komentar-form input {
      flex: 1;
      padding: 0.5rem;
      border-radius: 20px;
      border: 1px solid #ccc;
    }

    .komentar-item {
      display: flex;
      gap: 0.8rem;
      margin-bottom: 1.5rem;
    }

    .komentar-item img {
      width: 35px;
      height: 35px;
      border-radius: 50%;
    }

    .komentar-content {
      flex: 1;
    }

    .komentar-nama {
      font-weight: bold;
      margin-bottom: 0.2rem;
    }

    .komentar-text {
      margin-bottom: 0.3rem;
    }

    .komentar-actions button {
      background: none;
      border: none;
      color: #555;
      font-size: 0.9rem;
      cursor: pointer;
      margin-right: 1rem;
    }

    .balasan-container {
      margin-left: 2.5rem;
      margin-top: 0.5rem;
    }

    .balasan-form input {
      width: 80%;
      padding: 0.4rem;
      border-radius: 20px;
      border: 1px solid #ccc;
      margin-top: 0.5rem;
    }
  </style>
</head>
<body>

  <div class="header">
    <i class="fas fa-arrow-left" onclick="history.back()"></i>
    <div class="judul">Kelas: Komunikasi Politik</div>
  </div>

  <div class="video-container">
    <video controls>
      <source src="video/komunikasi-politik.mp4" type="video/mp4" />
      Browser Anda tidak mendukung tag video.
    </video>
  </div>

  <div class="video-info">
    <h2>Strategi Komunikasi Politik Modern</h2>
    <p>Dalam video ini, Dr. Maya Fitriani membahas pendekatan komunikasi politik kontemporer, termasuk media digital, framing isu, dan pengaruh opini publik dalam kebijakan politik.</p>
  </div>

  <button class="toggle-komentar" onclick="toggleKomentar()">Sembunyikan Komentar</button>

  <div class="komentar-container" id="komentarBox">
    <form class="komentar-form" id="komentarForm">
      <img src="https://i.pravatar.cc/35?img=1" alt="profil" />
      <input type="text" id="inputKomentar" placeholder="Tulis komentar..." required />
    </form>

    <div id="komentarList"></div>
  </div>

  <script>
    const komentarForm = document.getElementById("komentarForm");
    const inputKomentar = document.getElementById("inputKomentar");
    const komentarList = document.getElementById("komentarList");
    const komentarBox = document.getElementById("komentarBox");
    const toggleBtn = document.querySelector(".toggle-komentar");

    let komentarVisible = true;

    const komentarAwal = [
      { nama: "Andi Saputra", teks: "Penjelasan dosennya sangat mudah dimengerti!", avatar: 12 },
      { nama: "Rika Marlina", teks: "Mohon dijelaskan lagi soal strategi komunikasi politik modern.", avatar: 24 },
      { nama: "Budi Hartono", teks: "Sangat bermanfaat. Terima kasih Bu Dosen 🙏", avatar: 6 }
    ];

    window.onload = function () {
      komentarAwal.forEach(k => tambahKomentar(k.nama, k.teks, k.avatar));
    };

    komentarForm.addEventListener("submit", function (e) {
      e.preventDefault();
      const text = inputKomentar.value.trim();
      if (text) {
        tambahKomentar("Pengguna", text);
        inputKomentar.value = "";
      }
    });

    function tambahKomentar(nama, text, avatar = Math.floor(Math.random() * 70) + 1) {
      const item = document.createElement("div");
      item.className = "komentar-item";

      item.innerHTML = `
        <img src="https://i.pravatar.cc/35?img=${avatar}" alt="profil">
        <div class="komentar-content">
          <div class="komentar-nama">${nama}</div>
          <div class="komentar-text">${text}</div>
          <div class="komentar-actions">
            <button class="like-btn"><i class="fa-regular fa-thumbs-up"></i> Suka</button>
            <button class="reply-btn">Balas</button>
          </div>
          <div class="balasan-container"></div>
        </div>
      `;

      const replyBtn = item.querySelector(".reply-btn");
      const replyContainer = item.querySelector(".balasan-container");

      replyBtn.addEventListener("click", function () {
        if (replyContainer.querySelector("input")) return;

        const input = document.createElement("input");
        input.className = "balasan-form";
        input.placeholder = "Tulis balasan...";
        replyContainer.appendChild(input);
        input.focus();

        input.addEventListener("keypress", function (e) {
          if (e.key === "Enter" && input.value.trim()) {
            const balasan = document.createElement("div");
            balasan.className = "komentar-item";
            balasan.innerHTML = `
              <img src="https://i.pravatar.cc/35?img=${Math.floor(Math.random() * 70) + 1}" alt="profil">
              <div class="komentar-content">
                <div class="komentar-nama">Pengguna</div>
                <div class="komentar-text">${input.value}</div>
              </div>
            `;
            replyContainer.appendChild(balasan);
            input.remove();
          }
        });
      });

      komentarList.appendChild(item);
    }

    function toggleKomentar() {
      komentarVisible = !komentarVisible;
      komentarBox.style.display = komentarVisible ? "block" : "none";
      toggleBtn.textContent = komentarVisible ? "Sembunyikan Komentar" : "Tampilkan Komentar";
    }
  </script>

</body>
</html>
