<?php if (empty($kuis)): ?>
    <p style="text-align:center;color:#aaa;">Belum ada kuis.</p>
<?php else: ?>
    <?php foreach ($kuis as $k): ?>
        <div class="quiz-card">
            <div class="quiz-title"><?= htmlspecialchars($k['judul']) ?></div>
            <span class="quiz-status-badge belum">Belum Dikerjakan</span>
            <div class="quiz-duration">
                <i class="far fa-clock"></i>
                <span>Durasi: <?= $k['durasi'] ?> menit</span>
            </div>
            <button class="submit-btn" onclick="window.location.href='kuis.php?id=<?= $t['id'] ?>'">Mulai Kuis</button>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
