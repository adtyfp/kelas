<?php
session_start();
require_once 'koneksi.php';

$user_id = $_SESSION['user_id'];

$stmt = $pdo->query("SELECT * FROM messages ORDER BY created_at ASC");
$messages = $stmt->fetchAll();

foreach ($messages as $msg):
  $isMine = $msg['user_id'] == $user_id;
  $class = $isMine ? 'mine' : 'other';
  echo '<div class="bubble ' . $class . '">';

  if ($msg['jenis_pesan'] === 'image') {
    echo '<img src="' . htmlspecialchars($msg['file_path']) . '" alt="gambar">';
  } elseif ($msg['jenis_pesan'] === 'audio') {
    echo '<audio controls><source src="' . htmlspecialchars($msg['file_path']) . '" type="audio/mpeg"></audio>';
  } else {
    echo nl2br(htmlspecialchars($msg['isi_pesan']));
  }

  echo '</div>';
endforeach;
