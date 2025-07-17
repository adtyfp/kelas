<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuis Hubungan Internasional</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #2a0845, #6441a5);
            color: white;
            min-height: 100vh;
        }

        .hidden {
            display: none !important;
        }

        /* Glass Header */
        .glass-header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 0 0 16px 16px;
            padding: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .header-left,
        .header-center,
        .header-right {
            flex: 1;
        }

        .header-center {
            text-align: center;
            font-weight: 600;
        }

        .header-right {
            text-align: right;
        }

        .music-icon {
            background: rgba(0, 0, 0, 0.3);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FF9E80;
        }

        .combo {
            background: rgba(0, 0, 0, 0.3);
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .combo-icon {
            color: #FFD600;
        }

        /* Quiz Main */
        .quiz-main {
            padding: 0 16px 40px;
        }

        .question-card {
            background: rgba(0, 0, 0, 0.3);
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 24px;
        }

        .question-text {
            font-size: 18px;
            line-height: 1.5;
        }

        .options-container {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .option {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            padding: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            color: #333;
            border: none;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .option-icon {
            width: 24px;
            height: 24px;
            flex-shrink: 0;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }

        .option:nth-child(1) .option-icon {
            background: #FF9E80;
        }

        .option:nth-child(2) .option-icon {
            background: #80DEEA;
        }

        .option:nth-child(3) .option-icon {
            background: #CE93D8;
        }

        .option:nth-child(4) .option-icon {
            background: #A5D6A7;
        }

        .option:nth-child(1) {
            background: rgba(255, 154, 158, 0.9);
        }

        .option:nth-child(2) {
            background: rgba(168, 224, 99, 0.9);
        }

        .option:nth-child(3) {
            background: rgba(102, 217, 232, 0.9);
        }

        .option:nth-child(4) {
            background: rgba(198, 154, 255, 0.9);
        }

        .option:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .option.correct {
            background: #56ab2f;
            color: white;
        }

        .option.incorrect {
            background: #dd2476;
            color: white;
        }

        /* Results Page */
        .results-main {
            padding: 0 16px 40px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .summary-title {
            text-align: center;
            font-size: 32px;
            font-weight: 700;
            opacity: 0.4;
            margin: 16px 0;
        }

        /* Cards */
        .profile-card,
        .accuracy-card,
        .rank-card,
        .score-card,
        .performance-stats,
        .leaderboard {
            background: rgba(0, 0, 0, 0.5);
            border-radius: 16px;
            padding: 12px;
        }

        .profile-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .profile-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #6441a5, #2a0845);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 20px;
            color: white;
        }

        .profile-info h3 {
            font-size: 18px;
            margin-bottom: 4px;
        }

        .profile-info p {
            font-size: 14px;
            opacity: 0.7;
        }

        .share-icon {
            color: #80DEEA;
            cursor: pointer;
        }

        /* Accuracy */
        .accuracy-container {
            position: relative;
            width: 100%;
        }

        .accuracy-bar {
            flex: 1;
            height: 12px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 6px;
            overflow: hidden;
            display: flex;
            position: relative;
        }

        .correct-bar {
            background: #56ab2f;
            height: 100%;
        }

        .incorrect-bar {
            background: #dd2476;
            height: 100%;
        }

        .accuracy-percent {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            font-weight: bold;
            font-size: 12px;
            background: rgba(0, 0, 0, 0.7);
            padding: 2px 6px;
            border-radius: 10px;
            z-index: 2;
        }

        .divider-line {
            position: absolute;
            height: 16px;
            width: 2px;
            background: white;
            top: -2px;
            z-index: 1;
        }

        /* Rank & Score Cards */
        .rank-card,
        .score-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .rank-left h3,
        .score-left h3 {
            font-size: 16px;
            opacity: 0.7;
            margin-bottom: 4px;
        }

        .rank-left p,
        .score-left p {
            font-size: 24px;
            font-weight: bold;
        }

        .medal-icon {
            color: #FFD600;
            font-size: 32px;
        }

        .copy-icon {
            color: #FF9E80;
            cursor: pointer;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 12px;
            margin: 16px 0;
        }

        .btn-done,
        .btn-new-quiz {
            flex: 1;
            padding: 16px;
            border-radius: 12px;
            border: none;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-done {
            background: #6441a5;
            color: white;
        }

        .btn-new-quiz {
            background: white;
            color: #333;
        }

        .btn-done:hover,
        .btn-new-quiz:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Performance Stats */
        .performance-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            text-align: center;
        }

        .stat {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
        }

        .stat-icon {
            font-size: 24px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat:nth-child(1) .stat-icon {
            background: rgba(76, 175, 80, 0.2);
            color: #4CAF50;
        }

        .stat:nth-child(2) .stat-icon {
            background: rgba(244, 67, 54, 0.2);
            color: #F44336;
        }

        .stat:nth-child(3) .stat-icon {
            background: rgba(33, 150, 243, 0.2);
            color: #2196F3;
        }

        .stat:nth-child(4) .stat-icon {
            background: rgba(255, 193, 7, 0.2);
            color: #FFC107;
        }

        .stat p {
            font-size: 20px;
            font-weight: bold;
        }

        .stat span {
            font-size: 12px;
            opacity: 0.7;
        }

        /* Leaderboard */
        .leaderboard {
            max-height: 300px;
            overflow-y: auto;
        }

        .leaderboard h3 {
            margin-bottom: 12px;
            font-size: 18px;
            position: sticky;
            top: 0;
            background: linear-gradient(135deg, #2a0845, #6441a5);
            padding: 8px 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .leaderboard-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .leaderboard-item.current-user {
            background: rgba(100, 65, 165, 0.3);
            border-radius: 8px;
        }

        .leaderboard-item:first-child .leaderboard-avatar {
            background: linear-gradient(135deg, #FFD700, #FFCC00);
            color: #333;
        }

        .leaderboard-item:nth-child(2) .leaderboard-avatar {
            background: linear-gradient(135deg, #C0C0C0, #D3D3D3);
            color: #333;
        }

        .leaderboard-item:nth-child(3) .leaderboard-avatar {
            background: linear-gradient(135deg, #CD7F32, #B87333);
            color: #333;
        }

        .leaderboard-item:last-child {
            border-bottom: none;
        }

        .leaderboard-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .leaderboard-avatar {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .leaderboard-score {
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Scrollbar styling */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        /* Material Icons adjustments */
        .material-icons {
            font-size: 24px;
        }

        /* Loading Screen */
        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #2a0845, #6441a5);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            gap: 16px;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <!-- Loading Screen -->
    <div class="loading-screen" id="loading-screen">
        <div class="loading-spinner"></div>
        <p>Memuat data pengguna...</p>
    </div>

    <!-- Quiz Page -->
    <div class="quiz-container hidden" id="quiz-page">
        <header class="glass-header">
            <div class="header-left">
                <div class="music-icon material-icons">music_note</div>
            </div>
            <div class="header-center">
                <span id="question-counter">1/5</span>
            </div>
            <div class="header-right">
                <span class="combo">
                    <span class="combo-icon material-icons">whatshot</span>
                    <span id="combo-count">0</span>
                </span>
            </div>
        </header>

        <main class="quiz-main">
            <div class="question-card">
                <p id="question-text">Memuat pertanyaan...</p>
            </div>

            <div class="options-container" id="options-container">
                <!-- Options will be inserted here by JavaScript -->
            </div>
        </main>
    </div>

    <!-- Results Page -->
    <div class="results-container hidden" id="results-page">
        <header class="glass-header">
            <div class="header-left">
                <div class="music-icon material-icons">music_note</div>
            </div>
            <div class="header-center"></div>
            <div class="header-right"></div>
        </header>

        <main class="results-main">
            <h1 class="summary-title">Ringkasan</h1>

            <div class="profile-card">
                <div class="profile-left">
                    <div class="avatar" id="user-avatar">U</div>
                    <div class="profile-info">
                        <h3 id="username">User</h3>
                        <p>Solo Game</p>
                    </div>
                </div>
                <div class="share-icon material-icons">share</div>
            </div>

            <div class="accuracy-card">
                <div class="accuracy-container">
                    <div class="accuracy-bar">
                        <div class="correct-bar" id="correct-bar" style="width: 0%;"></div>
                        <div class="incorrect-bar" id="incorrect-bar" style="width: 0%;"></div>
                        <div class="accuracy-percent" id="accuracy-percent">0%</div>
                        <div class="divider-line" id="divider-line"></div>
                    </div>
                </div>
            </div>

            <div class="rank-card">
                <div class="rank-left">
                    <h3>Peringkat</h3>
                    <p id="rank">1/25</p>
                </div>
                <div class="medal-icon material-icons">military_tech</div>
            </div>

            <div class="score-card">
                <div class="score-left">
                    <h3>Skor</h3>
                    <p id="final-score">0/100</p>
                </div>
                <div class="copy-icon material-icons" id="copy-score">content_copy</div>
            </div>

            <div class="action-buttons">
                <button class="btn-done" id="btn-done">
                    <span class="material-icons">check_circle</span>
                    Selesai
                </button>
                <button class="btn-new-quiz" id="btn-new-quiz">
                    <span class="material-icons">search</span>
                    Temukan Kuis Baru
                </button>
            </div>

            <div class="performance-stats">
                <div class="stat">
                    <div class="stat-icon material-icons">check</div>
                    <p id="stat-correct">0</p>
                    <span>Benar</span>
                </div>
                <div class="stat">
                    <div class="stat-icon material-icons">close</div>
                    <p id="stat-wrong">0</p>
                    <span>Salah</span>
                </div>
                <div class="stat">
                    <div class="stat-icon material-icons">access_time</div>
                    <p id="stat-time">0s</p>
                    <span>Waktu</span>
                </div>
                <div class="stat">
                    <div class="stat-icon material-icons">local_fire_department</div>
                    <p id="stat-streak">0</p>
                    <span>Streak</span>
                </div>
            </div>

            <div class="leaderboard" id="leaderboard">
                <h3>
                    <span class="material-icons">leaderboard</span>
                    Leaderboard
                </h3>
                <!-- Leaderboard items will be inserted here by JavaScript -->
            </div>
        </main>
    </div>

    <script>
        // Konfigurasi API
        const API_BASE_URL = window.location.href.includes('?api')
            ? 'quiz_api.php'
            : '<?php echo $_SERVER["PHP_SELF"]; ?>';

        // Fungsi untuk memanggil API
        async function callAPI(action, data = {}) {
            try {
                const formData = new FormData();
                formData.append('action', action);
                for (const key in data) {
                    formData.append(key, data[key]);
                }

                const response = await fetch(API_BASE_URL, {
                    method: 'POST',
                    body: formData
                });

                return await response.json();
            } catch (error) {
                console.error('API Error:', error);
                return { success: false, error: 'Connection failed' };
            }
        }

        // Fungsi untuk mendapatkan data user
        async function getUserData(userId) {
            const result = await callAPI('get_user', { user_id: userId });
            if (result.success && result.data) {
                localStorage.setItem('quizUserData', JSON.stringify(result.data));
                return result.data;
            }
            return null;
        }

        // Fungsi untuk menyimpan skor
        async function saveScore(scoreData) {
            const result = await callAPI('save_score', scoreData);
            if (!result.success) {
                const scores = JSON.parse(localStorage.getItem('quizScores') || '[]');
                scores.push(scoreData);
                localStorage.setItem('quizScores', JSON.stringify(scores));
            }
            return result;
        }

        // Fungsi untuk mendapatkan leaderboard
        async function getLeaderboard() {
            const result = await callAPI('get_leaderboard');
            if (result.success) {
                localStorage.setItem('quizLeaderboard', JSON.stringify(result.data));
                return result.data;
            }
            return JSON.parse(localStorage.getItem('quizLeaderboard') || '[]');
        }

        // Data pertanyaan
        const questions = [
            {
                question: "Apa itu state sovereignty?",
                options: [
                    "Pemerintah pusat",
                    "Hak veto di PBB",
                    "Kedaulatan negara tanpa campur tangan pihak luar",
                    "Kekuasaan absolut"
                ],
                correctAnswer: 2
            },
            {
                question: "Apa isi utama Traktat Westphalia 1648?",
                options: [
                    "Membentuk Liga Bangsa-Bangsa",
                    "Menghapus koloni",
                    "Mengakui kedaulatan negara",
                    "Melarang perang"
                ],
                correctAnswer: 2
            },
            {
                question: "Siapa pelopor teori realisme dalam HI?",
                options: [
                    "John Locke",
                    "Kant",
                    "Hans Morgenthau",
                    "Keohane"
                ],
                correctAnswer: 2
            },
            {
                question: "Apa itu soft power menurut Joseph Nye?",
                options: [
                    "Kekuatan militer",
                    "Diplomasi paksa",
                    "Daya tarik budaya dan nilai",
                    "Ekonomi paksa"
                ],
                correctAnswer: 2
            },
            {
                question: "Tujuan utama PBB didirikan adalah?",
                options: [
                    "Mengatur ekonomi global",
                    "Menjaga perdamaian dunia",
                    "Menyebarkan ideologi liberal",
                    "Menghapus negara berkembang"
                ],
                correctAnswer: 1
            }
        ];

        // State kuis
        let currentQuestion = 0;
        let score = 0;
        let correctAnswers = 0;
        let wrongAnswers = 0;
        let combo = 0;
        let maxCombo = 0;
        let totalTime = 0;
        let questionStartTime = 0;
        let selectedAnswer = false;

        // Fungsi untuk memuat pertanyaan
        function loadQuestion(index) {
            if (index >= questions.length) {
                showResults();
                return;
            }

            const question = questions[index];
            document.getElementById('question-text').textContent = question.question;
            document.getElementById('question-counter').textContent = `${index + 1}/${questions.length}`;
            document.getElementById('combo-count').textContent = combo;

            const optionsContainer = document.getElementById('options-container');
            optionsContainer.innerHTML = '';

            question.options.forEach((option, i) => {
                const optionElement = document.createElement('button');
                optionElement.className = 'option';
                optionElement.innerHTML = `
                    <div class="option-icon">${String.fromCharCode(65 + i)}</div>
                    <span>${option}</span>
                `;
                optionElement.dataset.index = i;
                optionElement.addEventListener('click', selectAnswer);
                optionsContainer.appendChild(optionElement);
            });

            questionStartTime = Date.now();
            selectedAnswer = false;
        }

        // Fungsi untuk menangani jawaban
        function selectAnswer(e) {
            if (selectedAnswer) return;
            selectedAnswer = true;

            const selectedOption = e.target.closest('.option');
            const question = questions[currentQuestion];
            const isCorrect = parseInt(selectedOption.dataset.index) === question.correctAnswer;
            const answerTime = (Date.now() - questionStartTime) / 1000;
            totalTime += answerTime;

            const options = document.querySelectorAll('.option');
            options.forEach(opt => {
                opt.style.pointerEvents = 'none';
            });

            if (isCorrect) {
                selectedOption.classList.add('correct');
                score += calculateScore(answerTime, combo);
                correctAnswers++;
                combo++;
                if (combo > maxCombo) maxCombo = combo;
                document.getElementById('combo-count').textContent = combo;
            } else {
                selectedOption.classList.add('incorrect');
                wrongAnswers++;
                combo = 0;
                document.getElementById('combo-count').textContent = combo;

                options[question.correctAnswer].classList.add('correct');
            }

            setTimeout(() => {
                currentQuestion++;
                loadQuestion(currentQuestion);
            }, 1500);
        }

        // Fungsi menghitung skor
        function calculateScore(time, combo) {
            const baseScore = 20;
            const maxTimeBonus = 10;
            const idealTime = 10;
            const timeBonus = Math.max(0, maxTimeBonus - (time / idealTime * maxTimeBonus));
            const comboBonus = combo * 2;
            return baseScore + timeBonus + comboBonus;
        }

        // Fungsi menampilkan hasil
        async function showResults() {
            document.getElementById('quiz-page').classList.add('hidden');
            document.getElementById('results-page').classList.remove('hidden');

            const accuracy = correctAnswers / questions.length;
            const avgTime = (totalTime / questions.length).toFixed(1);
            const maxPossibleScore = 20 * questions.length;
            const scorePercentage = Math.round((score / maxPossibleScore) * 100);

            document.getElementById('correct-bar').style.width = `${accuracy * 100}%`;
            document.getElementById('incorrect-bar').style.width = `${(1 - accuracy) * 100}%`;
            document.getElementById('accuracy-percent').textContent = `${Math.round(accuracy * 100)}%`;
            document.getElementById('divider-line').style.left = `${accuracy * 100}%`;
            document.getElementById('final-score').textContent = `${score}/${maxPossibleScore} (${scorePercentage}%)`;
            document.getElementById('stat-correct').textContent = correctAnswers;
            document.getElementById('stat-wrong').textContent = wrongAnswers;
            document.getElementById('stat-time').textContent = `${avgTime}s`;
            document.getElementById('stat-streak').textContent = maxCombo;

            // Simpan skor ke database
            const scoreData = {
                user_id: 1, // Ganti dengan ID user yang sesuai
                score: score,
                correct_answers: correctAnswers,
                total_questions: questions.length,
                time_spent: totalTime
            };

            await saveScore(scoreData);

            // Ambil dan tampilkan leaderboard
            const leaderboardData = await getLeaderboard();
            generateLeaderboard(leaderboardData);
        }

        // Fungsi untuk menampilkan leaderboard
        function generateLeaderboard(data) {
            const leaderboardContainer = document.getElementById('leaderboard');
            leaderboardContainer.innerHTML = `
                <h3>
                    <span class="material-icons">leaderboard</span>
                    Leaderboard
                </h3>
            `;

            data.forEach((item, index) => {
                const leaderboardItem = document.createElement('div');
                leaderboardItem.className = `leaderboard-item ${item.name === document.getElementById('username').textContent ? 'current-user' : ''}`;

                let medalIcon = '';
                if (index === 0) medalIcon = '<span class="material-icons" style="color: #FFD700;">military_tech</span>';
                else if (index === 1) medalIcon = '<span class="material-icons" style="color: #C0C0C0;">military_tech</span>';
                else if (index === 2) medalIcon = '<span class="material-icons" style="color: #CD7F32;">military_tech</span>';

                leaderboardItem.innerHTML = `
                    <div class="leaderboard-left">
                        <div class="leaderboard-avatar">${item.name.charAt(0)}</div>
                        <p>${item.name}</p>
                    </div>
                    <p class="leaderboard-score">
                        ${medalIcon}
                        ${item.score}%
                    </p>
                `;

                leaderboardContainer.appendChild(leaderboardItem);
            });

            // Update peringkat user
            const userRank = data.findIndex(item =>
                item.name === document.getElementById('username').textContent) + 1;
            document.getElementById('rank').textContent =
                `${userRank > 0 ? userRank : '-'}/${data.length}`;
        }

        // Event listeners
        document.getElementById('btn-done').addEventListener('click', () => {
            // Ganti URL berikut dengan halaman tujuan Anda
            window.location.href = "tugas.php";
            // atau bisa juga menggunakan:
            // window.location.replace("menu_utama.html");
        });

        document.getElementById('btn-new-quiz').addEventListener('click', () => {
            currentQuestion = 0;
            score = 0;
            correctAnswers = 0;
            wrongAnswers = 0;
            combo = 0;
            maxCombo = 0;
            totalTime = 0;

            document.getElementById('results-page').classList.add('hidden');
            document.getElementById('quiz-page').classList.remove('hidden');
            loadQuestion(0);
        });

        document.getElementById('copy-score').addEventListener('click', () => {
            const scoreText = document.getElementById('final-score').textContent;
            navigator.clipboard.writeText(`Skor kuis saya: ${scoreText}`)
                .then(() => alert('Skor telah disalin!'))
                .catch(err => console.error('Gagal menyalin skor:', err));
        });

        // Inisialisasi kuis
        async function initQuiz() {
            try {
                // Dapatkan data user (contoh dengan ID 1)
                const userData = await getUserData(1) ||
                    JSON.parse(localStorage.getItem('quizUserData') || 'null');

                if (userData) {
                    document.getElementById('username').textContent = userData.name;
                    document.getElementById('user-avatar').textContent =
                        userData.avatar || userData.name.charAt(0).toUpperCase();
                }

                document.getElementById('loading-screen').classList.add('hidden');
                document.getElementById('quiz-page').classList.remove('hidden');
                loadQuestion(0);
            } catch (error) {
                console.error('Initialization error:', error);
                document.getElementById('loading-screen').querySelector('p').textContent =
                    'Gagal memuat data. Silakan refresh halaman.';
            }
        }

        // Jalankan kuis saat halaman dimuat
        document.addEventListener('DOMContentLoaded', initQuiz);
    </script>

    <?php
    // PHP Backend Handler
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
        header('Content-Type: application/json');

        // Database configuration
        $db_host = 'localhost';
        $db_user = 'root'; // Ganti dengan user MySQL Anda
        $db_pass = '';     // Ganti dengan password MySQL Anda
        $db_name = 'apkkelasvirtual';

        // Create connection
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

        // Check connection
        if ($conn->connect_error) {
            die(json_encode(['success' => false, 'error' => 'Database connection failed']));
        }

        // Set charset
        $conn->set_charset('utf8mb4');

        // Handle actions
        $action = $_POST['action'];
        $response = ['success' => false];

        try {
            switch ($action) {
                case 'get_user':
                    $user_id = intval($_POST['user_id']);
                    $stmt = $conn->prepare("SELECT id, name, email FROM users WHERE id = ?");
                    $stmt->bind_param('i', $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $response['success'] = true;
                        $response['data'] = $result->fetch_assoc();
                    } else {
                        $response['error'] = 'User not found';
                    }
                    break;

                case 'save_score':
                    $user_id = intval($_POST['user_id']);
                    $score = intval($_POST['score']);
                    $correct_answers = intval($_POST['correct_answers']);
                    $total_questions = intval($_POST['total_questions']);
                    $time_spent = floatval($_POST['time_spent']);

                    $stmt = $conn->prepare("INSERT INTO scores (user_id, score, correct_answers, total_questions, time_spent) VALUES (?, ?, ?, ?, ?)");
                    $stmt->bind_param('iiidi', $user_id, $score, $correct_answers, $total_questions, $time_spent);

                    if ($stmt->execute()) {
                        $response['success'] = true;
                    } else {
                        $response['error'] = $conn->error;
                    }
                    break;

                case 'get_leaderboard':
                    $query = "SELECT u.name, ROUND((s.score / (s.total_questions * 20)) * 100) as score, 
                              s.correct_answers, s.time_spent 
                              FROM scores s 
                              JOIN users u ON s.user_id = u.id 
                              ORDER BY s.score DESC 
                              LIMIT 10";
                    $result = $conn->query($query);

                    $leaderboard = [];
                    while ($row = $result->fetch_assoc()) {
                        $leaderboard[] = $row;
                    }

                    $response['success'] = true;
                    $response['data'] = $leaderboard;
                    break;

                default:
                    $response['error'] = 'Invalid action';
            }
        } catch (Exception $e) {
            $response['error'] = $e->getMessage();
        }

        $conn->close();
        echo json_encode($response);
        exit();
    }
    ?>
</body>

</html>