<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelajari FAQ - Kelas Virtual</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f5f5f5;
            color: #333;
        }

        /* Header */
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
      font-size: 20px;
      flex-grow: 1;
      text-align: center;
  }

  .header-icon {
      font-size: 20px;
      cursor: pointer;
  }

        /* FAQ Container */
        .faq-container {
            max-width: 800px;
            margin: 30px auto;
            padding: 0 20px;
        }

        /* FAQ Card */
        .faq-card {
            background-color: white;
            border-radius: 12px;
            margin-bottom: 15px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .faq-header {
            padding: 18px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .faq-header:hover {
            background-color: #f9f9f9;
        }

        .faq-header span {
            font-weight: 500;
        }

        .faq-header span i {
            font-size: 22px;
            /* Ukuran lebih besar */
            margin-right: 8px;
            /* Jarak dengan teks */
            color: #6A0DAD;
            /* Warna ungu sesuai tema */
        }

        .icon-info {
            font-size: 22px;
            margin-right: 8px;
            color: #6A0DAD;
        }

        .arrow {
            transition: transform 0.3s;
        }

        .faq-dropdown {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .faq-dropdown a {
            display: block;
            padding: 12px 20px;
            text-decoration: none;
            color: #555;
            border-top: 1px solid #eee;
            transition: all 0.2s;
        }

        .faq-dropdown a:hover {
            color: #9C27B0;
            background-color: #f5f5f5;
        }

        .faq-dropdown a i {
            min-width: 20px;
            font-size: 16px;
        }

        /* Warna per ikon */
        .icon-akun {
            color: #6A0DAD;
            /* Ungu */
        }

        .icon-produk {
            color: #FF9800;
            /* Orange */
        }

        .icon-pembayaran {
            color: #2196F3;
            /* Biru */
        }

        .icon-promo {
            color: #E91E63;
            /* Pink */
        }

        .icon-program {
            color: #4CAF50;
            /* Hijau */
        }

        .faq-dropdown a i {
            min-width: 24px;
            font-size: 20px;
            /* diperbesar dari sebelumnya */
        }


        /* Special first card */
        .main-faq-card {
            background-color: #E1BEE7;
            margin-bottom: 25px;
        }

        .main-faq-card .faq-header {
            padding: 20px;
        }

        /* Footer */
        .footer {
            background-color: #3B0066;
            color: white;
            padding: 40px 20px;
            margin-top: 50px;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-top {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
        }

        .footer-logo {
            max-width: 200px;
            margin-bottom: 15px;
        }

        .footer-logo img {
            width: 100%;
            height: auto;
        }

        .footer-address {
            margin-bottom: 20px;
            line-height: 1.6;
            font-size: 0.9rem;
            text-align: center;
            max-width: 500px;
        }

        .free-trial {
            display: inline-block;
            background-color: #9C27B0;
            color: white;
            padding: 10px 15px;
            border-radius: 6px;
            text-decoration: none;
            margin-bottom: 30px;
            font-size: 0.9rem;
        }

        .footer-columns {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 30px;
        }

        .footer-column {
            flex: 1;
            min-width: 200px;
        }

        .footer-column.right {
            text-align: right;
        }

        .footer-column h3 {
            font-size: 1.1rem;
            margin-bottom: 15px;
            font-weight: 500;
        }

        .footer-column ul {
            list-style: none;
        }

        .footer-column li {
            margin-bottom: 10px;
        }

        .footer-column a {
            color: #ddd;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s;
        }

        .footer-column a:hover {
            color: white;
        }

        .footer-contact {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .footer-columns {
                flex-direction: column;
            }

            .footer-column.right {
                text-align: left;
            }

            .footer-contact {
                flex-direction: column;
                gap: 10px;
                align-items: center;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
  <div class="header">
    <div class="header-icon">
       <a href="pelajari-faq.php"><i class="fas fa-arrow-left" style="color: white;"></i></a>
    </div>
    <div class="header-title">Pelajari FAQ</div>
  </div>

    <!-- FAQ Container -->
    <div class="faq-container">
        <!-- Main FAQ Card -->
        <div class="faq-card main-faq-card">
            <div class="faq-header" onclick="toggleDropdown('infoDropdown')">
                <span><i class="fas fa-circle-info icon-info"></i> Informasi Umum</span>
                <span class="arrow" id="infoArrow">⌄</span>
            </div>
            <div class="faq-dropdown" id="infoDropdown">
                <a href="faq-akun.php"><i class="fas fa-user icon-akun"></i>Akun</a>
                <a href="faq-produk.php"><i class="fas fa-box-open icon-produk"></i> Produk</a>
                <a href="faq-pembayaran.php"><i class="fas fa-credit-card icon-pembayaran"></i> Pembayaran</a>
                <a href="faq-promo.php"><i class="fas fa-gift icon-promo"></i> Promo</a>
                <a href="faq-program.php"><i class="fas fa-handshake icon-program"></i> Program Kelas
                    Virtual</a>
            </div>
        </div>

        <!-- Regular FAQ Cards -->
        <div class="faq-card">
            <div class="faq-header" onclick="toggleDropdown('registrasiDropdown')">
                <span>Registrasi</span>
                <span class="arrow" id="registrasiArrow">⌄</span>
            </div>
            <div class="faq-dropdown" id="registrasiDropdown">
                <a href="faq-registrasi-1.php">Cara mendaftar akun</a>
                <a href="faq-registrasi-2.php">Verifikasi email</a>
                <a href="faq-registrasi-3.php">Persyaratan registrasi</a>
            </div>
        </div>

        <div class="faq-card">
            <div class="faq-header" onclick="toggleDropdown('produkDropdown')">
                <span>Rekomendasi Produk</span>
                <span class="arrow" id="produkArrow">⌄</span>
            </div>
            <div class="faq-dropdown" id="produkDropdown">
                <a href="faq-produk-1.php">Kelas terpopuler</a>
                <a href="faq-produk-2.php">Rekomendasi berdasarkan minat</a>
                <a href="faq-produk-3.php">Paket diskon</a>
            </div>
        </div>

        <div class="faq-card">
            <div class="faq-header" onclick="toggleDropdown('pesanDropdown')">
                <span>Cara Pesan</span>
                <span class="arrow" id="pesanArrow">⌄</span>
            </div>
            <div class="faq-dropdown" id="pesanDropdown">
                <a href="faq-pesan-1.php">Langkah-langkah pemesanan</a>
                <a href="faq-pesan-2.php">Metode pembayaran</a>
                <a href="faq-pesan-3.php">Konfirmasi pembayaran</a>
            </div>
        </div>

        <div class="faq-card">
            <div class="faq-header" onclick="toggleDropdown('danaDropdown')">
                <span>Pengembalian Dana</span>
                <span class="arrow" id="danaArrow">⌄</span>
            </div>
            <div class="faq-dropdown" id="danaDropdown">
                <a href="faq-dana-1.php">Syarat pengembalian dana</a>
                <a href="faq-dana-2.php">Proses refund</a>
                <a href="faq-dana-3.php">Lama proses refund</a>
            </div>
        </div>

        <div class="faq-card">
            <div class="faq-header" onclick="toggleDropdown('aduanDropdown')">
                <span>Pengaduan Konsumen</span>
                <span class="arrow" id="aduanArrow">⌄</span>
            </div>
            <div class="faq-dropdown" id="aduanDropdown">
                <a href="faq-aduan-1.php">Cara membuat pengaduan</a>
                <a href="faq-aduan-2.php">Proses penanganan</a>
                <a href="faq-aduan-3.php">Kontak pengaduan</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-top">
                <div class="footer-logo">
                    <!-- Ganti dengan path gambar logo yang sesuai -->
                    <img src="asset/kelas.png" alt="Kelas Virtual">
                </div>
                <div class="footer-address">
                    Jl. Dipatiukur No. 112-115, Lebakgede, Kecamatan Coblong, Kota Bandung, Jawa Barat 40132
                </div>
                <a href="#" class="free-trial">Coba GRATIS Aplikasi Kelas Virtual</a>
            </div>

            <div class="footer-columns">
                <div class="footer-column">
                    <h3>Produk Kelas Virtual</h3>
                    <ul>
                        <li><a href="paket-langganan.php">Paket Langganan</a></li>
                        <li><a href="kelas-individu.php">Kelas Individu</a></li>
                        <li><a href="ebook-modul.php">E-BOOK & Modul</a></li>
                        <li><a href="event-webinar.php">Event & Webinar</a></li>
                    </ul>
                </div>

                <div class="footer-column right">
                    <h3>Bantuan & Panduan</h3>
                    <ul>
                        <li><a href="#">Promo Kelas Virtual</a></li>
                        <li><a href="#">Layanan Panduan</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="bantuan.php">Kontak Kami</a></li>
                        <li><a href="bantuan.php">Bantuan</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-contact">
                <div class="contact-item">
                    <span>✉️</span>
                    <span>info@kelasvirtual.com</span>
                </div>
                <div class="contact-item">
                    <span>📞</span>
                    <span>021-2366-74342</span>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            const arrow = document.getElementById(id.replace('Dropdown', 'Arrow'));

            if (dropdown.style.maxHeight) {
                dropdown.style.maxHeight = null;
                arrow.style.transform = 'rotate(0deg)';
            } else {
                dropdown.style.maxHeight = dropdown.scrollHeight + 'px';
                arrow.style.transform = 'rotate(180deg)';
            }
        }

        // Close all dropdowns when clicking outside
        document.addEventListener('click', function (event) {
            if (!event.target.closest('.faq-header')) {
                const dropdowns = document.querySelectorAll('.faq-dropdown');
                const arrows = document.querySelectorAll('.arrow');

                dropdowns.forEach(dropdown => {
                    dropdown.style.maxHeight = null;
                });

                arrows.forEach(arrow => {
                    arrow.style.transform = 'rotate(0deg)';
                });
            }
        });
    </script>
</body>

</html>