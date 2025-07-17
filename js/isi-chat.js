const input = document.getElementById('message-input');
const sendBtn = document.getElementById('send-btn');
const micIcon = document.getElementById('mic-icon');
const chatContainer = document.getElementById('chat-container');

// Ganti ikon mic ↔ kirim saat user mengetik
input.addEventListener('input', () => {
  if (input.value.trim() !== '') {
    micIcon.classList.remove('fa-microphone');
    micIcon.classList.add('fa-paper-plane');
  } else {
    micIcon.classList.remove('fa-paper-plane');
    micIcon.classList.add('fa-microphone');
  }
});

// Ketika tombol diklik
sendBtn.addEventListener('click', () => {
  const message = input.value.trim();
  if (message === '') return;

  // Tambah pesan pengguna
  appendMessage(message, 'outgoing');

  // Reset input dan ikon
  input.value = '';
  input.dispatchEvent(new Event('input'));

  // Simulasi balasan bot (opsional)
  setTimeout(() => {
    appendMessage('Oke, noted!', 'incoming');
  }, 1000);
});

/**
 * Fungsi untuk menambahkan pesan baru ke tampilan
 * @param {string} text - Isi pesan
 * @param {string} type - 'incoming' atau 'outgoing'
 */
function appendMessage(text, type) {
  const msg = document.createElement('div');
  msg.classList.add('message', type);

  const bubble = document.createElement('div');
  bubble.classList.add('bubble');
  bubble.textContent = text;

  const time = document.createElement('div');
  time.classList.add('time');
  time.textContent = getCurrentTime();

  msg.appendChild(bubble);
  msg.appendChild(time);
  chatContainer.appendChild(msg);

  // Scroll ke bawah otomatis
  chatContainer.scrollTop = chatContainer.scrollHeight;
}

/**
 * Mendapatkan waktu saat ini dalam format HH:MM
 */
function getCurrentTime() {
  const now = new Date();
  const hours = now.getHours().toString().padStart(2, '0');
  const minutes = now.getMinutes().toString().padStart(2, '0');
  return `${hours}:${minutes}`;
}
