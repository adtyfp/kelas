<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pelajari FAQ - Fullscreen</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        html,
        body {
            height: 100%;
            width: 100%;
            overflow: hidden;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .container {
            flex: 1;
            overflow-y: auto;
            background: rgb(255, 255, 255);
        }

        .header {
            position: relative;
            background: linear-gradient(to bottom right, #C065D9, #B530C1);
            height: 200px;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            overflow: hidden;
            color: white;
        }

        .header h1 {
            position: absolute;
            top: 40px;
            left: 50%;
            transform: translateX(-50%);
            font-weight: 700;
            font-size: 20px;
            z-index: 2;
            flex-grow: 1;
        }

        .header-icon {
            position: absolute;
            top: 40px;
            left: 20px;
            font-size: 20px;
            cursor: pointer;
            z-index: 2;
        }


        .header-wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            z-index: 1;
        }

        .topic-card-wrapper {
            background-color: white;
            position: relative;
            border-radius: 16px;
            padding: 20px 0;
            /* padding atas bawah saja */
            margin: -60px 0 20px 0;
            /* untuk overlap header */
            z-index: 10;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            background-image: url('uploads/3aefce82-1af0-453f-aca1-245bca418b7e.png');
            background-size: cover;
            background-position: center;
            width: 100vw;
            /* full lebar */
        }


        .topic-title {
            font-size: 18px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .topic-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 15px;
            position: relative;
            z-index: 1;
            padding: 0 6px;
            /* jarak dalam grid dari tepi */
        }

        .topic-item {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 10px;
            height: 55px;
            /* Ukuran tetap */
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 12px;
            padding: 0 16px;
            font-size: 13px;
            font-weight: 500;
            border: 1.5px solid rgba(0, 0, 0, 0.2);
            text-decoration: none;
            color: #333;
            transition: background 0.3s;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            word-break: break-word;
            /* Memastikan kata panjang pecah */
            white-space: normal;
            /* Supaya teks wrap otomatis */
            overflow-wrap: break-word;
            /* Tambahan untuk jaga-jaga */
        }

        .topic-item:hover {
            background-color: #f3e6ff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .topic-icon {
            position: absolute;
            left: 16px;
            font-size: 20px;
        }

        @media (max-width: 768px) {
            .topic-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }


        .section-title {
            font-size: 16px;
            font-weight: 600;
            text-align: center;
            margin: 20px 0 10px;
        }

        .faq-card {
            background-color: white;
            border-radius: 12px;
            margin-bottom: 15px;
            overflow: hidden;
            margin: 0 20px 15px;
            /* <- ini memberi jarak kiri-kanan 20px */
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
            /* <- lebih besar dan gelap */
        }

        .faq-header {
            padding: 18px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            opacity: 70%;
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

        .faq-item {
            background-color: white;
            border: 0.5px solid rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            padding: 16px 20px;
            margin-bottom: 12px;
            font-size: 14px;
            position: relative;
        }

        .faq-item::after {
            content: ">";
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
        }

        footer.footer {
            background-color: #3B0066;
            color: white;
            padding: 30px 20px;
        }

        .footer-container {
            max-width: 1200px;
            margin: auto;
        }

        .footer-logo {
            max-width: 200px;
            margin: 0 auto 15px auto;
            /* Tengah + jarak bawah */
            text-align: center;
        }

        .footer-logo img {
            width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
            /* Memastikan gambar di tengah */
        }


        .footer-address {
            text-align: center;
            font-size: 14px;
            margin: 10px 0 20px;
        }

        .free-trial {
            display: flex;
            justify-content: center;
            /* horizontal center */
            align-items: center;
            /* vertical center */
            background-color: #9C27B0;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }


        .footer-columns {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: space-between;
        }

        .footer-column {
            flex: 1;
            min-width: 220px;
        }

        .footer-column h3 {
            font-size: 16px;
            margin-bottom: 12px;
        }

        .footer-column ul {
            list-style: none;
        }

        .footer-column li {
            margin-bottom: 10px;
        }

        .footer-column a {
            color: #ccc;
            text-decoration: none;
            font-size: 14px;
        }

        .footer-column a:hover {
            color: #fff;
        }

        .footer-contact {
            margin-top: 25px;
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .topic-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-columns {
                flex-direction: column;
            }

            .footer-contact {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="header-icon">
                <a href="home.php"><i class="fas fa-arrow-left" style="color: white;"></i></a>
            </div>
            <h1>Pelajari FAQ</h1>
            <svg class="header-wave" viewBox="0 0 500 100" preserveAspectRatio="none">
                <path d="M0,20 C150,80 350,0 500,40 L500,0 L0,0 Z" fill="rgba(255, 255, 255, 0.05)" />
            </svg>
        </div>

        <div class="topic-card-wrapper">
            <div class="topic-title">Pilih Topik Bantuan</div>
            <div class="topic-grid">
                <a href="faq-informasi.php" class="topic-item">
                    <i class="fas fa-circle-info" style="color: #4a90e2;"></i> Informasi umum
                </a>
                <a href="faq-akun.php" class="topic-item">
                    <i class="fas fa-user" style="color: #7b61ff;"></i> Akun
                </a>
                <a href="faq-produk.php" class="topic-item">
                    <i class="fas fa-box" style="color: #f39c12;"></i> Produk
                </a>
                <a href="faq-pembayaran.php" class="topic-item">
                    <i class="fas fa-wallet" style="color: #00b894;"></i> Pembayaran
                </a>
                <a href="faq-promo.php" class="topic-item">
                    <i class="fas fa-tags" style="color: #e84393;"></i> Promo
                </a>
                <a href="faq-program.php" class="topic-item">
                    <i class="fas fa-users" style="color: #e67e22;"></i> Program Kelas Virtual
                </a>
            </div>
        </div>



        <div class="section-title">Yang sering ditanyakan</div>
        <div class="faq-card">
            <div class="faq-header" onclick="toggleDropdown('produkDropdown')">
                <span>Kenapa kode promo saya tidak bisa digunakan</span>
                <span class="arrow" id="produkArrow">⌄</span>
            </div>
            <div class="faq-dropdown" id="produkDropdown">
                <a href="#">Kode promo sudah kedaluwarsa</a>
                <a href="#">Kode hanya berlaku untuk paket tertentu</a>
                <a href="#">Sudah pernah digunakan sebelumnya</a>
                <a href="#">Kode tidak cocok dengan metode pembayaran atau wilayah tertentu</a>
            </div>
        </div>

        <div class="faq-card">
            <div class="faq-header" onclick="toggleDropdown('kontenDropdown')">
                <span>Tentang Belajar & Konten</span>
                <span class="arrow" id="kontenArrow">⌄</span>
            </div>
            <div class="faq-dropdown" id="kontenDropdown">
                <a href="#">Apakah semua mata pelajaran tersedia di aplikasi ini</a>
                <a href="#">Apakah bisa belajar offline</a>
                <a href="#">Apakah ada latihan soal setelah menonton video</a>
                <a href="#">Bagaimana cara mengikuti kelas live atau interaktif</a>
            </div>
        </div>

        <div class="faq-card">
            <div class="faq-header" onclick="toggleDropdown('aksesDropdown')">
                <span>Akses & Teknis</span>
                <span class="arrow" id="akseskArrow">⌄</span>
            </div>
            <div class="faq-dropdown" id="aksesDropdown">
                <a href="#">Saya tidak bisa login, apa yang harus saya lakukan</a>
                <a href="#">Kenapa video tidak bisa diputar / buffering terus</a>
                <a href="#">Bagaimana jika aplikasi sering keluar sendiri atau error</a>
            </div>
        </div>

        <footer class="footer">
            <div class="footer-container">
                <div class="footer-top">
                    <div class="footer-logo">
                        <img src="asset/kelas.png" alt="Kelas Virtual" />
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
                            <li><a href="#">Paket Langganan</a></li>
                            <li><a href="#">Kelas Individu</a></li>
                            <li><a href="#">E-BOOK & Modul</a></li>
                            <li><a href="#">Event & Webinar</a></li>
                        </ul>
                    </div>

                    <div class="footer-column">
                        <h3>Bantuan & Panduan</h3>
                        <ul>
                            <li><a href="#">Promo Kelas Virtual</a></li>
                            <li><a href="#">Layanan Panduan</a></li>
                            <li><a href="#">Syarat & Ketentuan</a></li>
                            <li><a href="#">Kebijakan Privasi</a></li>
                            <li><a href="#">Tentang Kami</a></li>
                            <li><a href="#">Kontak Kami</a></li>
                            <li><a href="#">Bantuan</a></li>
                        </ul>
                    </div>
                </div>

                <div class="footer-contact">
                    <div class="contact-item"><span>✉️</span><span>info@kelasvirtual.com</span></div>
                    <div class="contact-item"><span>📞</span><span>021-2366-74342</span></div>
                </div>
            </div>
        </footer>
    </div>
</body>

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

</html>