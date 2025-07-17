<?php
// Ambil nama paket dari URL
$paket = $_GET['paket'] ?? '';

// Mapping semua paket
$paketMap = [
    // Bulanan
    'regular'         => ['harga' => 150000,  'tier' => 'Regular',  'jenis' => 'bulanan'],
    'premium'         => ['harga' => 199000,  'tier' => 'Premium',  'jenis' => 'bulanan'],
    'elite'           => ['harga' => 299000,  'tier' => 'Elite',    'jenis' => 'bulanan'],

    // Tahunan
    'reguler-tahunan' => ['harga' => 799000,  'tier' => 'Regular',  'jenis' => 'tahunan'],
    'premium-tahunan' => ['harga' => 1099000, 'tier' => 'Premium',  'jenis' => 'tahunan'],
    'elite-tahunan'   => ['harga' => 1499000, 'tier' => 'Elite',    'jenis' => 'tahunan'],

    // Kursus Individu
    'desain-grafis-dasar' => ['harga' => 600000, 'tier' => 'Desain Grafis Dasar',           'jenis' => 'kursus'],
    'public-speaking'     => ['harga' => 750000, 'tier' => 'Public Speaking & Komunikasi',  'jenis' => 'kursus'],

    // E-Book & Modul
    'tematik'   => ['harga' => 600000, 'tier' => 'E-Book Tematik',   'jenis' => 'ebook'],
    'kursus'    => ['harga' => 600000, 'tier' => 'Modul Lengkap Kursus', 'jenis' => 'modul'],

    // Event & Webinar
    'workshop'    => ['harga' => 60000, 'tier' => 'Mini Workshop', 'jenis' => 'event'],
    'umum'    => ['harga' => 80000, 'tier' => 'Webinar Umum', 'jenis' => 'webinar'],
];

// Validasi paket
if (!isset($paketMap[$paket])) {
    header("Location: paket-langganan.php"); // fallback kalau slug salah
    exit;
}

// Ambil detail paket
$harga = $paketMap[$paket]['harga'];
$tier  = $paketMap[$paket]['tier'];
$jenis = $paketMap[$paket]['jenis'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metode Pembayaran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
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

        .container {
            max-width: 450px;
            margin: 0 auto;
            background: white;
            min-height: 100vh;
        }

        .header {
            background-color: #9C27B0;
            color: white;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-title {
            font-size: 18px;
            font-weight: 600;
            text-align: center;
            flex-grow: 1;
        }

        .back-button {
            color: white;
            text-decoration: none;
            font-size: 20px;
        }

        .content {
            padding: 20px;
        }

        .payment-section {
            background: #FFFFFF;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 12px;
            color: #333;
        }

        .payment-options {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .payment-option {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: calc(33.33% - 8px);
            padding: 8px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .payment-option:hover {
            background: #F9F5FF;
        }

        .payment-icon {
            width: 48px;
            height: 48px;
            object-fit: contain;
            margin-bottom: 8px;
            border-radius: 8px;
        }

        .payment-name {
            font-size: 12px;
            text-align: center;
            color: #555;
        }

        .payment-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 24px;
            padding: 16px;
            background: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .total-price {
            display: flex;
            flex-direction: column;
        }

        .total-label {
            font-size: 12px;
            color: #777;
            margin-bottom: 4px;
        }

        .total-amount {
            font-size: 18px;
            font-weight: 700;
            color:rgb(254, 59, 0);
        }

        .confirm-button {
            padding: 12px 24px;
            background-color: #9C27B0;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            line-height: 1.2;
        }

        .confirm-button:hover {
            background-color: #7B1FA2;
        }

        .payment-option.selected {
            border: 2px solid #9C27B0;
            background-color: #F3E5F5;
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="header">
            <a href="<?= $jenis === 'kursus' ? 'kelas-individu.php' : 'paket-langganan.php' ?>" class="back-button">
    <i class="fas fa-arrow-left"></i>
</a>

            <h1 class="header-title">
                <?= $jenis === 'kursus' ? 'Pembayaran Kursus' : 'Metode Pembayaran' ?>
            </h1>
            <div style="width: 20px;"></div>
        </header>

        <form action="proses-pembayaran.php" method="POST" id="payment-form">
            <input type="hidden" name="metode_pembayaran" id="metodeInput" required>
            <input type="hidden" name="total_harga" value="<?= $harga ?>">
            <input type="hidden" name="nama_paket" value="<?= htmlspecialchars($paket) ?>">
            <input type="hidden" name="jenis_paket" value="<?= $jenis ?>">
            <input type="hidden" name="paket_tier" value="<?= $tier ?>">

            <div class="content">
                <!-- Virtual Account -->
                <div class="payment-section">
                    <h2 class="section-title">Transfer Virtual Account</h2>
                    <div class="payment-options">
                        <?php foreach (['BCA', 'BNI', 'BRI', 'Mandiri'] as $v): ?>
                            <div class="payment-option" data-metode="<?= $v ?>">
                                <img src="assets/img/metode/<?= strtolower($v) ?>.png" class="payment-icon" alt="<?= $v ?>">
                                <span class="payment-name"><?= $v ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- E-Money -->
                <div class="payment-section">
                    <h2 class="section-title">E-Money</h2>
                    <div class="payment-options">
                        <?php foreach (['LinkAja', 'Dana', 'OVO', 'Gopay'] as $e): ?>
                            <div class="payment-option" data-metode="<?= $e ?>">
                                <img src="assets/img/metode/<?= strtolower($e) ?>.png" class="payment-icon" alt="<?= $e ?>">
                                <span class="payment-name"><?= $e ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Minimarket -->
                <div class="payment-section">
                    <h2 class="section-title">Minimarket</h2>
                    <div class="payment-options">
                        <?php foreach (['Alfamart', 'Indomart'] as $m): ?>
                            <div class="payment-option" data-metode="<?= $m ?>">
                                <img src="assets/img/metode/<?= strtolower($m) ?>.png" class="payment-icon" alt="<?= $m ?>">
                                <span class="payment-name"><?= $m ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Footer -->
                <div class="payment-footer">
                    <div class="total-price">
                        <span class="total-label">Paket Dipilih</span>
                        <span class="total-amount" style="font-size: 14px; font-weight: 500; color: #444;">
                            <?= htmlspecialchars($tier) ?>
                        </span>
                        <span class="total-label" style="margin-top: 8px;">Total Harga</span>
                        <span class="total-amount">Rp<?= number_format($harga, 0, ',', '.') ?></span>
                    </div>
                    <button type="submit" class="confirm-button">
                        <span>Lanjutkan</span>
                        <span>Pembayaran</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        const options = document.querySelectorAll('.payment-option');
        const metodeInput = document.getElementById('metodeInput');

        options.forEach(opt => {
            opt.addEventListener('click', () => {
                metodeInput.value = opt.dataset.metode;
                options.forEach(o => o.classList.remove('selected'));
                opt.classList.add('selected');
            });
        });

        document.getElementById('payment-form').addEventListener('submit', function (e) {
            if (!metodeInput.value) {
                e.preventDefault();
                alert('Pilih metode pembayaran terlebih dahulu!');
            }
        });
    </script>
</body>

</html>
