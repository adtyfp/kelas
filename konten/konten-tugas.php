<?php if (empty($tugas)): ?>
    <p style="text-align:center;color:#aaa;">Belum ada tugas.</p>
<?php else: ?>
    <?php foreach ($tugas as $t): ?>
        <div class="task-card">
            <div class="task-title"><?= htmlspecialchars($t['nama_tugas']) ?></div>
            <span class="status-badge">Belum Selesai</span>
            <div class="progress-container">
                <div class="progress-bar">
                    <div class="progress" style="width: 40%;"></div>
                </div>
            </div>
            <button class="submit-btn" onclick="window.location.href='kumpulkan.php?id=<?= $t['id'] ?>'">Kumpulkan</button>
            <div class="due-date">
                <i class="far fa-calendar-alt"></i>
                <span>Selesai Pada <?= date('d M Y H:i', strtotime($t['deadline'])) ?></span>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
