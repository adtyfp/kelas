<?php
session_start();

// Konfigurasi dasar
define('UPLOAD_DIR', 'uploads/');

// Buat folder upload jika belum ada
if (!file_exists(UPLOAD_DIR)) {
    mkdir(UPLOAD_DIR, 0777, true);
}

// Inisialisasi data chat
if (!isset($_SESSION['chats'])) {
    $_SESSION['chats'] = [
        'forum' => [
            'id' => 'forum',
            'name' => 'Forum Tanya Jawab',
            'avatar' => 'https://i.pravatar.cc/150?img=5',
            'status' => 'Online',
            'messages' => [
                [
                    'id' => uniqid(),
                    'from' => 'system',
                    'type' => 'text',
                    'content' => 'Selamat datang di Forum Tanya Jawab!',
                    'time' => date('H:i'),
                    'date' => date('Y-m-d')
                ]
            ]
        ]
    ];
}
?>