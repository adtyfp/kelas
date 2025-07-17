<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bantuan - Kelas Virtual</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #fff5f7;
            color: #333;
            padding-bottom: 20px;
        }

        .navbar {
            background-color: #9c27b0;
            color: white;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .navbar h1 {
            font-size: 18px;
            margin-left: 15px;
        }

        .back-arrow {
            font-size: 20px;
            cursor: pointer;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .card {
            background-color: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .card-icon {
            font-size: 24px;
            margin-right: 15px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .complain-icon {
            background-color: #e3f2fd;
            color: #2196f3;
        }

        .faq-icon {
            background-color: #e8f5e9;
            color: #4caf50;
        }

        .contact-icon {
            background-color: #e3f2fd;
            color: #2196f3;
            font-size: 20px;
        }

        .card-content {
            flex: 1;
        }

        .card-title {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .card-desc {
            font-size: 14px;
            color: #666;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin: 25px 0 15px;
            color: #333;
        }

        .contact-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .contact-info {
            display: flex;
            align-items: center;
        }

        .contact-details {
            margin-left: 15px;
        }

        .contact-number, .contact-email {
            font-weight: bold;
            font-size: 15px;
        }

        .contact-label {
            font-size: 12px;
            color: #666;
        }

        .contact-button {
            color: #2196f3;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            text-transform: uppercase;
            padding: 8px 12px;
            border-radius: 6px;
            transition: background-color 0.2s;
        }

        .contact-button:hover {
            background-color: #f5f5f5;
        }

        .divider {
            height: 1px;
            background-color: #eee;
            margin: 15px 0;
        }

        a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="home.php" class="back-button"><i class="fas fa-arrow-left"></i></a>
        <h1>Bantuan</h1>
    </div>

    <div class="container">
        <!-- Card Ajukan Komplain -->
        <a href="komplain.php">
            <div class="card">
                <div class="card-icon complain-icon">💬</div>
                <div class="card-content">
                    <div class="card-title">Ajukan Komplain</div>
                    <div class="card-desc">Beri tahu keluhanmu saat menggunakan Kelas Virtual</div>
                </div>
            </div>
        </a>

        <!-- Card Pelajari FAQ -->
        <a href="pelajari-faq.php">
            <div class="card">
                <div class="card-icon faq-icon">❓</div>
                <div class="card-content">
                    <div class="card-title">Pelajari FAQ</div>
                    <div class="card-desc">Temukan jawaban dari pertanyaan kamu seputar Kelas Virtual</div>
                </div>
            </div>
        </a>

        <!-- Bantuan Lainnya Section -->
        <div class="section-title">Bantuan lainnya</div>

        <!-- Call Center Card -->
        <div class="card contact-card">
            <div class="contact-info">
                <div class="card-icon contact-icon">📞</div>
                <div class="contact-details">
                    <div class="contact-label">Call Center</div>
                    <div class="contact-number">+62 823 5243 5486</div>
                </div>
            </div>
            <a href="tel:+6282352435486" class="contact-button">HUBUNGI</a>
        </div>

        <div class="divider"></div>

        <!-- Email Card -->
        <div class="card contact-card">
            <div class="contact-info">
                <div class="card-icon contact-icon">📧</div>
                <div class="contact-details">
                    <div class="contact-label">Email</div>
                    <div class="contact-email">kelasvirtual@gmail.com</div>
                </div>
            </div>
            <a href="mailto:kelasvirtual@gmail.com" class="contact-button">HUBUNGI</a>
        </div>
    </div>

    <script>
        // Tambahkan efek klik untuk card yang tidak memiliki link
        document.querySelectorAll('.card:not(.contact-card)').forEach(card => {
            card.addEventListener('click', function() {
                const link = this.closest('a');
                if (link) {
                    window.location.href = link.href;
                }
            });
        });

        // Navigasi tombol kembali
        document.querySelector('.back-arrow').addEventListener('click', function() {
            window.location.href = this.href;
        });
    </script>
</body>
</html>