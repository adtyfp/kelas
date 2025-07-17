<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Langganan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background-color: #f9edf8;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 450px;
            margin: 0 auto;
            padding: 0 16px;
        }
        
        .header {
            background-color: #9C27B0;
            color: white;
            padding: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 10;
            width: 100%;
        }
        
        .header h1 {
            font-size: 18px;
            font-weight: 600;
            flex: 1;
            text-align: center;
        }
        
        .header i {
            font-size: 18px;
            cursor: pointer;
        }
        
        .header-icons {
            width: 24px; /* Maintain space for alignment */
        }
        
        .subscription-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin: 24px 0;
            padding: 0 16px;
        }
        
        .subscription-card {
            background-color: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .thumbnail {
            background-color: #D9D9D9;
            height: 120px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .thumbnail-placeholder {
            position: absolute;
            font-weight: 500;
            color: #555;
            z-index: 1;
        }
        
        .card-content {
            padding: 16px;
        }
        
        .card-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #333;
        }
        
        .card-description {
            font-size: 14px;
            color: #555;
            text-align: justify;
            margin-bottom: 20px;
            line-height: 1.5;
        }
        
        .select-btn {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #9C27B0;
            color: white;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        
        .select-btn:hover {
            background-color: #7B1FA2;
        }
        
        .divider {
            height: 1px;
            background-color: #eee;
            margin: 16px 0;
        }
    </style>
</head>
<body>
    <header class="header">
        <a href="home.php"><i class="fas fa-arrow-left"></i></a>
        <h1>Paket Langganan</h1>
        <div class="header-icons">
            <i class="fas fa-search"></i>
        </div>
    </header>
    
    <div class="container">
        <div class="subscription-container">
            <div class="subscription-card">
                <div class="thumbnail">
                    <img src="https://via.placeholder.com/450x120" alt="Paket Bulanan">
                    <div class="thumbnail-placeholder">Thumbnail Produk</div>
                </div>
                <div class="card-content">
                    <h2 class="card-title">Paket Bulanan</h2>
                    <p class="card-description">
                        Paket Bulanan dirancang untuk kamu yang ingin mencoba belajar dengan bebas tanpa komitmen jangka panjang. Mendapatkan akses penuh ke semua kursus, komunitas, dan event edukatif selama 30 hari.
                    </p>
                    <div class="divider"></div>
                    <a href="paket-bulanan.php?paket=bulanan" class="select-btn">Pilih</a>
                </div>
            </div>
            
            <div class="subscription-card">
                <div class="thumbnail">
                    <img src="https://via.placeholder.com/450x120" alt="Paket Tahunan">
                    <div class="thumbnail-placeholder">Thumbnail Produk</div>
                </div>
                <div class="card-content">
                    <h2 class="card-title">Paket Tahunan</h2>
                    <p class="card-description">
                        Paket Tahunan memberikan akses tanpa batas selama 12 bulan penuh untuk seluruh materi, fitur premium, dan pendampingan dari mentor. Lebih hemat hingga 60% dibanding langganan bulanan, dengan banyak bonus tambahan.
                    </p>
                    <div class="divider"></div>
                    <a href="paket-tahunan.php?paket=tahunan" class="select-btn">Pilih</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = "home.php";
            }
        }
        
        // Add click event to back button
        document.querySelector('.fa-arrow-left').addEventListener('click', goBack);
    </script>
</body>
</html>