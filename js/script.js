// ===== ELEMENTS =====
const overlay = document.getElementById("overlay");
const kelasSheet = document.getElementById("kelas-sheet");
const materiSheet = document.getElementById("materi-sheet");
const diskusiSheet = document.getElementById("Diskusi-sheet");
const tokoSheet = document.getElementById("toko-sheet");
const activityTags = document.getElementById("activity-tags");
const seeAllLink = document.getElementById("see-all-link");
const sheets = [kelasSheet, materiSheet, diskusiSheet, tokoSheet];

// ===== AKTIVITAS MASTER =====
const aktivitasMaster = {
  "Beranda": { id: 0, judul: "Beranda", waktu: "Baru saja", icon: "home", color: "teal" },
  "Kelas Saya": { id: 1, judul: "Kelas Saya", waktu: "Baru saja", icon: "chalkboard-teacher", color: "pink" },
  "Materi Kuliah": { id: 2, judul: "Materi Kuliah", waktu: "Baru saja", icon: "book", color: "purple" },
  "Diskusi Kelas": { id: 3, judul: "Diskusi Kelas", waktu: "Baru saja", icon: "comments", color: "blue" },
  "Toko": { id: 4, judul: "Toko", waktu: "Baru saja", icon: "shopping-cart", color: "orange" },
  "Tugas": { id: 5, judul: "Tugas", waktu: "Baru saja", icon: "tasks", color: "green" },
  "Pesan": { id: 6, judul: "Pesan", waktu: "Baru saja", icon: "comment-alt", color: "indigo" },
  "Profil": { id: 7, judul: "Profil", waktu: "Baru saja", icon: "user", color: "gray" },
};

// ===== DATA KELAS HARIAN =====
const kelasHarian = {
  sen: { badge: "Baru saja", title: "Kelas online: Komunikasi Politik", date: "7 Jul 2025", time: "07.30 - 10.00", dosen: "Dr. Maya Fitriani" },
  sel: { badge: "1 Jam Lagi", title: "Kelas online: Sosiologi Politik", date: "8 Jul 2025", time: "09.00 - 11.30", dosen: "Dr. Wahyu Sasmita" },
  rab: { badge: "Besok", title: "Kelas online: Psikologi Organisasi", date: "9 Jul 2025", time: "08.15 - 11.00", dosen: "Dr. Linda Kusuma" },
  kam: { badge: "7 Jam Yang Lalu", title: "Kelas online: Ekonomi Politik Internasional", date: "10 Jul 2025", time: "09.15 - 14.50", dosen: "Prof. Dr. Ahmad Budiman" },
  jum: { badge: "2 Jam Lagi", title: "Kelas online: Manajemen Bisnis", date: "11 Jul 2025", time: "08.00 - 12.00", dosen: "Dr. Rina Susanti" },
  sab: { badge: "Besok", title: "Kelas online: Teknologi Informasi", date: "12 Jul 2025", time: "10.00 - 13.00", dosen: "Ir. Dedy Hartono, M.T." },
  min: { badge: "Libur", title: "Tidak ada kelas hari Minggu", date: "13 Jul 2025", time: "-", dosen: "-" }
};

// ===== LINK HALAMAN KELAS PER HARI =====
const halamanKelas = {
  sen: 'komunikasi-politik.php',
  sel: 'sosiologi-politik.php',
  rab: 'psikologi-organisasi.php',
  kam: 'ekonomi-politik.php',
  jum: 'manajemen-bisnis.php',
  sab: 'teknologi-informasi.php',
  min: '#' // tidak ada kelas
};

let hariAktif = 'sen'; // Default

// ===== TAMPILKAN KELAS BERDASARKAN HARI =====
function tampilkanKelas(hari) {
  const data = kelasHarian[hari];
  if (!data) return;
  hariAktif = hari; // Simpan hari yang aktif

  document.getElementById("class-badge").textContent = data.badge;
  document.getElementById("class-title").textContent = data.title;
  document.getElementById("class-date").textContent = data.date;
  document.getElementById("class-time").textContent = data.time;
  document.getElementById("class-dosen").textContent = data.dosen;
}

// ===== EVENT TAB HARI KLIK =====
document.querySelectorAll('.day-tab').forEach(tab => {
  tab.addEventListener('click', function () {
    // Ubah tab aktif
    document.querySelectorAll('.day-tab').forEach(t => t.classList.remove('active'));
    this.classList.add('active');

    // Ambil dan tampilkan data
    const day = this.getAttribute('data-day');
    tampilkanKelas(day);
  });
});

// ===== TOMBOL MULAI KELAS =====
function mulaiKelas() {
  const link = halamanKelas[hariAktif];
  if (link && link !== '#') {
    window.location.href = link;
  } else {
    alert("Tidak ada kelas hari ini.");
  }
}

//=== Buka produk ===
function bukaProduk(namaProduk) {
  switch(namaProduk) {
    case 'Paket Langganan':
      window.location.href = 'paket-langganan.php';
      break;
    case 'Kelas Individu':
      window.location.href = 'kelas-individu.php';
      break;
    case 'E Book & Modul':
      window.location.href = 'ebook-modul.php';
      break;
    case 'Event & Webinar':
      window.location.href = 'event-webinar.php';
      break;
    default:
      alert('Halaman belum tersedia untuk: ' + namaProduk);
  }
}
// ===== SHEET HANDLER =====
function showSheet(sheetToShow) {
  const sheetActive = sheets.find(sheet => sheet.classList.contains("show"));
  if (sheetActive && sheetActive !== sheetToShow) {
    sheetActive.classList.remove("show", "no-animation");
    sheetToShow.classList.add("no-animation", "show");
    requestAnimationFrame(() => sheetToShow.classList.remove("no-animation"));
  } else if (!sheetActive) {
    overlay.classList.add("show");
    sheetToShow.classList.add("show");
    document.body.classList.add("no-scroll");
  }
}

function closeSheet() {
  overlay.classList.remove("show");
  sheets.forEach(sheet => sheet.classList.remove("show"));
  document.body.classList.remove("no-scroll");
}

overlay.addEventListener('click', (e) => {
  if (e.target === overlay) {
    closeSheet();
  }
});

// ===== AKTIVITAS LOCALSTORAGE =====
function tambahAktivitas(namaAktivitas) {
  let data = [];

  try {
    data = JSON.parse(localStorage.getItem("aktivitasTags")) || [];
  } catch (e) {
    data = [];
  }

  // Hindari duplikat
  const sudahAda = data.some(item => item.judul === namaAktivitas);
  if (!sudahAda && aktivitasMaster[namaAktivitas]) {
    data.unshift(aktivitasMaster[namaAktivitas]);

    // Batasi maksimal 10 aktivitas
    if (data.length > 10) data = data.slice(0, 10);

    localStorage.setItem("aktivitasTags", JSON.stringify(data));
  }

  tampilkanAktivitasHome(); // Update tampilan
}

function tampilkanAktivitasHome() {
  if (!activityTags) return;

  activityTags.innerHTML = "";
  let semuaAktivitas = [];

  try {
    semuaAktivitas = JSON.parse(localStorage.getItem("aktivitasTags")) || [];
  } catch (e) {
    semuaAktivitas = [];
  }

  const aktivitasHome = semuaAktivitas.slice(0, 4);

  aktivitasHome.forEach(item => {
    const tag = document.createElement("a");
    tag.classList.add("tag");
    tag.textContent = item.judul;
    tag.style.backgroundColor = "rgba(255, 66, 211, 0.23)";

    tag.addEventListener("click", (e) => {
      e.preventDefault();
      const sheet = document.getElementById(`${item.judul.toLowerCase().replace(/\s/g, "-")}-sheet`);
      if (sheet) {
        overlay.classList.add("show");
        sheet.classList.add("show");
        document.body.classList.add("no-scroll");
      }
    });

    activityTags.appendChild(tag);
  });

  if (seeAllLink) {
    seeAllLink.style.display = semuaAktivitas.length > 4 ? "inline" : "none";
  }
}

// Panggil saat DOM siap
document.addEventListener("DOMContentLoaded", () => {
  tampilkanAktivitasHome();
});


// ===== NAVBAR BOTTOM =====
const navbarAktivitas = {
  "nav-beranda": "Beranda",
  "nav-tugas": "Tugas",
  "nav-pesan": "Pesan",
  "nav-profil": "Profil",
};

Object.entries(navbarAktivitas).forEach(([id, label]) => {
  const btn = document.getElementById(id);
  if (btn) {
    btn.addEventListener("click", () => tambahAktivitas(label));
  }
});

const currentPage = window.location.pathname.split("/").pop();

document.querySelectorAll(".bottom-nav .nav-item").forEach((link) => {
  if (link.getAttribute("href").includes(currentPage)) {
    link.classList.add("active");
  } else {
    link.classList.remove("active");
  }
});


// ===== SHORTCUT MENU =====
const shortcutBtns = {
  "kelas-saya-btn": { sheet: kelasSheet, label: "Kelas Saya" },
  "materi-kuliah-btn": { sheet: materiSheet, label: "Materi Kuliah" },
  "diskusi-kelas-btn": { sheet: diskusiSheet, label: "Diskusi Kelas" },
  "toko-btn": { sheet: tokoSheet, label: "Toko" },
};

Object.entries(shortcutBtns).forEach(([btnId, { sheet, label }]) => {
  const btn = document.getElementById(btnId);
  if (btn) {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      showSheet(sheet);
      tambahAktivitas(label);

      if (label === "Kelas Saya") {
        const dayMap = ['min', 'sen', 'sel', 'rab', 'kam', 'jum', 'sab'];
        const todayKey = dayMap[new Date().getDay()];
        const todayBtn = document.querySelector(`.day-tab[data-day="${todayKey}"]`);
        if (todayBtn) todayBtn.click();
      }
    });
  }
});

// ===== KATEGORI MENU =====
document.querySelectorAll(".category-item").forEach((item) => {
  item.addEventListener("click", function (e) {
    e.preventDefault();
    document.querySelectorAll(".category-item").forEach(i => i.classList.remove("active"));
    this.classList.add("active");

    const label = this.querySelector(".category-label")?.textContent?.trim();
    switch (label) {
      case "Kelas Saya":
        showSheet(kelasSheet); tambahAktivitas("Kelas Saya"); break;
      case "Materi Kuliah":
        showSheet(materiSheet); tambahAktivitas("Materi Kuliah"); break;
      case "Diskusi Kelas":
        showSheet(diskusiSheet); tambahAktivitas("Diskusi Kelas"); break;
      case "Toko":
        showSheet(tokoSheet); tambahAktivitas("Toko"); break;
    }
  });
});

// ===== UTILITY: Ambil localStorage dengan aman =====
function getBookmarksSafe() {
  try {
    const raw = JSON.parse(localStorage.getItem('bookmarkedFolders'));
    return Array.isArray(raw) ? raw.map(String) : [];
  } catch (e) {
    return [];
  }
}

// ===== SIMPAN ke localStorage =====
function saveBookmarks(bookmarks) {
  localStorage.setItem('bookmarkedFolders', JSON.stringify(bookmarks));
}

// ===== PASANG LISTENER & UPDATE TOMBOL BOOKMARK =====
function setupBookmarkButtons() {
  const buttons = document.querySelectorAll('.bookmark-btn');
  const bookmarks = getBookmarksSafe();

  buttons.forEach(btn => {
    const folderId = btn.getAttribute('data-folder-id');
    if (!folderId) return;
    const id = folderId.toString();

    // Tandai jika sudah di-bookmark
    if (bookmarks.includes(id)) {
      btn.classList.add('active');
    }

    // Pasang listener jika belum
    if (!btn.dataset.listenerAttached) {
      btn.addEventListener('click', () => {
        let current = getBookmarksSafe();

        if (current.includes(id)) {
          current = current.filter(x => x !== id);
          btn.classList.remove('active');
        } else {
          current.push(id);
          btn.classList.add('active');
        }

        saveBookmarks(current);
        sortMaterialList();
      });

      btn.dataset.listenerAttached = 'true';
    }
  });
}

// ===== URUTKAN MATERIAL CARD: bookmark dulu baru lainnya =====
function sortMaterialList() {
  const list = document.querySelector('.material-list');
  if (!list) return;

  const cards = Array.from(list.querySelectorAll('.material-card'));
  const bookmarks = getBookmarksSafe();

  const [bookmarked, others] = cards.reduce(
    ([a, b], card) => {
      const id = card.getAttribute('data-folder-id');
      (bookmarks.includes(id) ? a : b).push(card);
      return [a, b];
    },
    [[], []]
  );

  list.innerHTML = '';
  [...bookmarked, ...others].forEach(card => list.appendChild(card));
}

// ===== INISIALISASI SAAT DOM SIAP =====
document.addEventListener('DOMContentLoaded', () => {
  setupBookmarkButtons();
  sortMaterialList();
});
document.addEventListener("DOMContentLoaded", () => {
  const searchIcon = document.getElementById("search-icon");
  const searchPopup = document.getElementById("search-popup");
  const searchInput = document.getElementById("floating-search-input");
  const resultBox = document.getElementById("search-result-box");

  const dataSearch = [
    { label: "Kelas Saya", kategori: "kelas", url: "#kelas-saya-btn" },
    { label: "Hubungan Internasional", kategori: "Materi Kuliah", url: "materi.php" },
    { label: "Forum", kategori: "Diskusi Kelas", url: "forum.php" },
    { label: "Paket Langganan", kategori: "Toko", url: "paket-langganan.php" },
    { label: "Paket Bulanan", kategori: "Toko", url: "paket-bulanan.php" },
    { label: "Paket Tahunan", kategori: "Toko", url: "paket-tahunan.php" },
    { label: "Komunikasi Politik", kategori: "kelas", url: "komunikasi-politik.php" },
    { label: "Manajemen Bisnis", kategori: "materi", url: "materi.php?id_folder=2" },
    { label: "Webinar", kategori: "Toko", url: "home.php#toko-btn" }
  ];

  // Toggle popup visibility
  if (searchIcon) {
    searchIcon.addEventListener("click", function (e) {
      e.preventDefault();
      this.classList.toggle("active");

      if (searchPopup.style.display === "block") {
        searchPopup.style.display = "none";
      } else {
        searchPopup.style.display = "block";
        searchInput.focus();
      }
    });
  }

  // Close popup when clicked outside
  document.addEventListener("click", function (e) {
    if (
      !searchPopup.contains(e.target) &&
      !searchIcon.contains(e.target)
    ) {
      searchPopup.style.display = "none";
      searchIcon.classList.remove("active");
    }
  });

  // Search and display result
  searchInput.addEventListener("input", function () {
    const keyword = this.value.toLowerCase();
    resultBox.innerHTML = "";

    const filtered = dataSearch.filter(item =>
      item.label.toLowerCase().includes(keyword)
    );

    if (filtered.length === 0 && keyword !== "") {
      resultBox.innerHTML = "<p style='color:#999; padding: 12px;'>Tidak ditemukan.</p>";
    } else {
      filtered.forEach(item => {
        const link = document.createElement("a");
        link.href = item.url;
        link.className = "result-link";
        link.textContent = `${item.label} (${item.kategori})`;
        resultBox.appendChild(link);
      });
    }
  });
});
