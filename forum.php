<?php require 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WhatsApp-like Chat</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #bd25d0;
            --secondary-color:rgb(211, 37, 179);
            --bg-color: #e5ddd5;
            --outgoing-bg: #DCF8C6;
            --incoming-bg: #FFFFFF;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .chat-header {
            background-color: var(--primary-color);
            color: white;
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .chat-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .chat-container {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
            background-image: url('https://web.whatsapp.com/img/bg-chat-tile-light_a4be512e7195b6b733d9110b408f075d.png');
            background-repeat: repeat;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .message {
            display: flex;
            flex-direction: column;
            max-width: 70%;
            padding: 8px 12px;
            border-radius: 8px;
            position: relative;
        }

        .incoming {
            align-self: flex-start;
            background-color: var(--incoming-bg);
            border-top-left-radius: 0;
        }

        .outgoing {
            align-self: flex-end;
            background-color: var(--outgoing-bg);
            border-top-right-radius: 0;
        }

        .bubble {
            word-wrap: break-word;
            margin-bottom: 5px;
        }

        .time {
            font-size: 11px;
            color: #667781;
            align-self: flex-end;
            margin-top: 2px;
        }

        .chat-image {
            max-width: 250px;
            max-height: 250px;
            border-radius: 8px;
        }

        .chat-audio {
            width: 200px;
            height: 40px;
        }

        .chat-input-bar {
            background-color: #f0f2f5;
            padding: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            position: sticky;
            bottom: 0;
        }

        .input-container {
            flex: 1;
            background-color: white;
            border-radius: 20px;
            padding: 8px 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        #message-input {
            flex: 1;
            border: none;
            outline: none;
            font-size: 15px;
            background: transparent;
        }

        .icon-btn {
            background: none;
            border: none;
            color: #54656f;
            font-size: 20px;
            cursor: pointer;
        }

        #send-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            background-color: var(--primary-color);
            color: white;
            cursor: pointer;
        }

        #emoji-picker {
            position: fixed;
            bottom: 70px;
            right: 10px;
            z-index: 1000;
            display: none;
        }

        #recording-ui {
            position: fixed;
            bottom: 70px;
            left: 0;
            right: 0;
            background-color: #f0f2f5;
            padding: 15px;
            display: none;
            justify-content: center;
        }

        .recording-container {
            background-color: white;
            border-radius: 50px;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .recording-icon {
            color: #f44336;
            font-size: 20px;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }
    </style>
</head>
<body>
    <header class="chat-header">
        <a href="home.php"><i class="fas fa-arrow-left" style="color: white;"></i></a>
        <div class="chat-user">
            <img src="<?= $_SESSION['chats']['forum']['avatar'] ?>" class="avatar">
            <div>
                <div class="name"><?= $_SESSION['chats']['forum']['name'] ?></div>
                <div class="status"><?= $_SESSION['chats']['forum']['status'] ?></div>
            </div>
        </div>
        <i class="fas fa-ellipsis-v"></i>
    </header>

    <main class="chat-container" id="chat-container">
        <!-- Pesan akan dimuat secara dinamis -->
    </main>

    <div class="chat-input-bar">
        <div class="input-container">
            <button class="icon-btn" id="emoji-btn"><i class="fas fa-smile"></i></button>
            <input type="text" id="message-input" placeholder="Ketik pesan..." autocomplete="off">
            <input type="file" id="image-input" accept="image/*" style="display:none">
            <button class="icon-btn" id="image-btn"><i class="fas fa-paperclip"></i></button>
        </div>
        <button id="send-btn"><i class="fas fa-paper-plane"></i></button>
    </div>

    <div id="emoji-picker"></div>

    <div id="recording-ui">
        <div class="recording-container">
            <i class="fas fa-microphone recording-icon"></i>
            <div class="recording-time">0:00</div>
            <button class="icon-btn" id="cancel-recording"><i class="fas fa-times"></i></button>
        </div>
    </div>
           <div id="emoji-picker" style="display:none;"></div>
    <script src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Elemen UI
        const chatContainer = document.getElementById('chat-container');
        const messageInput = document.getElementById('message-input');
        const sendBtn = document.getElementById('send-btn');
        const emojiBtn = document.getElementById('emoji-btn');
        const imageBtn = document.getElementById('image-btn');
        const imageInput = document.getElementById('image-input');
        const emojiPicker = document.getElementById('emoji-picker');
    
        // Debugging
        console.log("DOM fully loaded");
        
        try {
            // Inisialisasi EmojiPicker
            const picker = new EmojiPicker();
            const emojiContainer = document.getElementById('emoji-picker');
            
            if (picker && emojiContainer) {
                emojiContainer.appendChild(picker);
                
                document.getElementById('emoji-btn').addEventListener('click', function(e) {
                    e.stopPropagation();
                    emojiContainer.style.display = emojiContainer.style.display === 'block' ? 'none' : 'block';
                });
                
                document.addEventListener('click', function() {
                    emojiContainer.style.display = 'none';
                });
                
                console.log("EmojiPicker berhasil diinisialisasi");
            }
        } catch (e) {
            console.error("Error inisialisasi EmojiPicker:", e);
        }

        // Unggah gambar
        imageBtn.addEventListener('click', () => imageInput.click());
        imageInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                const formData = new FormData();
                formData.append('action', 'send_image');
                formData.append('image', e.target.files[0]);

                fetch('chat-api.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        addMessageToUI(data.message);
                    }
                });
            }
        });

        // Fungsi untuk menambahkan pesan ke UI
        function addMessageToUI(message) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${message.from === 'me' ? 'outgoing' : 'incoming'}`;
            
            let content = '';
            if (message.type === 'image') {
                content = `<img src="${message.content}" class="chat-image">`;
            } else {
                content = `<div class="bubble">${message.content}</div>`;
            }
            
            messageDiv.innerHTML = `
                ${content}
                <div class="time">${message.time}</div>
            `;
            
            chatContainer.appendChild(messageDiv);
            scrollToBottom();
        }

        // Auto-scroll ke bawah
        function scrollToBottom() {
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        // Fungsi untuk mengirim pesan
        async function sendMessage() {
            const message = messageInput.value.trim();
            if (!message) return;

            try {
                const response = await fetch('chat-api.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        action: 'send_message',
                        message: message
                    })
                });
                
                const data = await response.json();
                
                if (data.status === 'success') {
                    addMessageToUI(data.message);
                    messageInput.value = '';
                    messageInput.focus();
                }
            } catch (error) {
                console.error('Error:', error);
            }
        }

        // Event listeners
        sendBtn.addEventListener('click', sendMessage);
        messageInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        // Fungsi untuk memuat pesan
        async function loadMessages() {
            try {
                const response = await fetch('chat-api.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        action: 'get_messages'
                    })
                });
                
                const data = await response.json();
                
                if (data.status === 'success') {
                    chatContainer.innerHTML = '';
                    data.messages.forEach(msg => {
                        addMessageToUI(msg);
                    });
                }
            } catch (error) {
                console.error('Error:', error);
            }
        }

        // Muat pesan pertama kali
        loadMessages();

        // Polling untuk pesan baru setiap 2 detik
        setInterval(loadMessages, 2000);
    });
    </script>
</body>
</html>