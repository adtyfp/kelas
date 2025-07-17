<?php
require 'config.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Tangani preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    exit(0);
}

$input = json_decode(file_get_contents('php://input'), true) ?? $_REQUEST;
$action = $input['action'] ?? '';
$chatId = 'forum';

try {
    switch ($action) {
        case 'send_message':
            $message = trim($input['message'] ?? '');
            if (empty($message)) throw new Exception('Pesan tidak boleh kosong');
            
            $newMsg = [
                'id' => uniqid(),
                'from' => 'me',
                'type' => 'text',
                'content' => $message,
                'time' => date('H:i'),
                'date' => date('Y-m-d')
            ];
            
            $_SESSION['chats'][$chatId]['messages'][] = $newMsg;
            echo json_encode(['status' => 'success', 'message' => $newMsg]);
            break;

        case 'send_image':
            if (empty($_FILES['image'])) {
                throw new Exception('File gambar tidak ditemukan');
            }

            $file = $_FILES['image'];
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $filename = uniqid() . '.' . $ext;
            $filepath = UPLOAD_DIR . $filename;

            if (!move_uploaded_file($file['tmp_name'], $filepath)) {
                throw new Exception('Gagal mengunggah gambar');
            }

            $newMsg = [
                'id' => uniqid(),
                'from' => 'me',
                'type' => 'image',
                'content' => $filepath,
                'time' => date('H:i'),
                'date' => date('Y-m-d')
            ];

            $_SESSION['chats'][$chatId]['messages'][] = $newMsg;
            echo json_encode(['status' => 'success', 'message' => $newMsg]);
            break;

        case 'get_messages':
            echo json_encode([
                'status' => 'success',
                'messages' => $_SESSION['chats'][$chatId]['messages'] ?? []
            ]);
            break;

        default:
            throw new Exception('Aksi tidak valid');
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>