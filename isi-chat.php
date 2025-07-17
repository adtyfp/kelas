<?php
// Contoh data user dari database/array
$chatUsers = [
    1 => [
        "name" => "John Doe",
        "status" => "Online",
        "avatar" => "https://i.pravatar.cc/150?img=1",
        "messages" => [
            ["from" => "other", "text" => "Hai, bagaimana kabarmu?", "time" => "10:30"],
            ["from" => "me", "text" => "Baik, kamu sendiri?", "time" => "10:32"]
        ]
    ],
    2 => [
        "name" => "Jane Smith",
        "status" => "Sedang Mengetik...",
        "avatar" => "https://i.pravatar.cc/150?img=2",
        "messages" => [
            ["from" => "other", "text" => "Jangan lupa meeting besok jam 9", "time" => "14:00"]
        ]
    ],
    3 => [
        "name" => "Tim Project",
        "status" => "Offline",
        "avatar" => "https://i.pravatar.cc/150?img=3",
        "messages" => [
            ["from" => "other", "text" => "Sarah: Saya sudah upload dokumennya", "time" => "Senin"]
        ]
    ],
    4 => [
        "name" => "Dosen Matematika",
        "status" => "Online",
        "avatar" => "https://i.pravatar.cc/150?img=4",
        "messages" => [
            ["from" => "other", "text" => "Tugas sudah saya nilai, silakan dicek", "time" => "12 Jul"]
        ]
    ],
    5 => [
        "name" => "Support Akademik",
        "status" => "Online",
        "avatar" => "https://i.pravatar.cc/150?img=5",
        "messages" => [
            ["from" => "other", "text" => "Pemberitahuan: Jadwal ujian telah diupdate", "time" => "10 Jul"]
        ]
    ]
];

// Ambil ID dari URL
$id = $_GET['id'] ?? null;
$user = $chatUsers[$id] ?? null;
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chat Detail</title>
    <link rel="stylesheet" href="css/isi-chat.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body>

<?php if ($user): ?>
    <!-- 🟪 Header Chat -->
    <header class="chat-header">
        <a href="pesan.php"><i class="fas fa-arrow-left back-btn"></i></a>
        <div class="chat-user">
            <img src="<?= htmlspecialchars($user['avatar']) ?>" class="avatar" />
            <div class="user-info">
                <div class="name"><?= htmlspecialchars($user['name']) ?></div>
                <div class="status"><?= htmlspecialchars($user['status']) ?></div>
            </div>
        </div>
        <i class="fas fa-ellipsis-v more-icon"></i>
    </header>

    <!-- 🗨️ Chat Area -->
    <main class="chat-container" id="chat-container">
        <?php foreach ($user['messages'] as $msg): ?>
            <div class="message <?= $msg['from'] === 'me' ? 'outgoing' : 'incoming' ?>">
                <div class="bubble"><?= htmlspecialchars($msg['text']) ?></div>
                <div class="time"><?= htmlspecialchars($msg['time']) ?></div>
            </div>
        <?php endforeach; ?>
    </main>

    <!-- 📝 Input Area -->
    <div class="chat-input-bar">
        <div class="input-container">
            <i class="fas fa-smile emoji-icon"></i>
            <input type="text" id="message-input" placeholder="Ketik Pesan" />
            <i class="fas fa-paperclip attach-icon"></i>
            <i class="fas fa-camera camera-icon"></i>
        </div>
        <button class="mic-button" id="send-btn">
            <i class="fas fa-microphone" id="mic-icon"></i>
        </button>
    </div>
<?php else: ?>
    <p style="text-align:center; margin-top: 50px;">Pengguna tidak ditemukan.</p>
<?php endif; ?>

    <script src="js/isi-chat.js"></script>
</body>

</html>
