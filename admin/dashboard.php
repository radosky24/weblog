<?php 
require_once 'header.php'; 

// Fetch stats
$post_count = $pdo->query("SELECT COUNT(*) FROM posts")->fetchColumn();
$user_count = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$recent_posts = $pdo->query("SELECT posts.*, users.full_name as author FROM posts JOIN users ON posts.author_id = users.id ORDER BY created_at DESC LIMIT 5")->fetchAll();
?>

<div class="header-top">
    <h2>แผงควบคุม (Dashboard)</h2>
    <a href="../index.php" target="_blank" class="btn btn-primary btn-sm"><i class="fas fa-external-link-alt"></i> ดูหน้าเว็บ</a>
</div>

<div class="stats-grid">
    <div class="card stat-card">
        <div class="stat-icon" style="background-color: #dcfce7; color: #15803d;">
            <i class="fas fa-newspaper"></i>
        </div>
        <div class="stat-info">
            <h3>ข่าวสารทั้งหมด</h3>
            <p><?php echo $post_count; ?></p>
        </div>
    </div>
    <div class="card stat-card">
        <div class="stat-icon" style="background-color: #e0f2fe; color: #0369a1;">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-info">
            <h3>ผู้ใช้งาน</h3>
            <p><?php echo $user_count; ?></p>
        </div>
    </div>
    <div class="card stat-card">
        <div class="stat-icon" style="background-color: #fef3c7; color: #b45309;">
            <i class="fas fa-eye"></i>
        </div>
        <div class="stat-info">
            <h3>ยอดเข้าชมรวม</h3>
            <p>1,234</p> <!-- Static for now -->
        </div>
    </div>
</div>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h3 style="font-size: 1.1rem; font-weight: 600;">ข่าวสารล่าสุด</h3>
        <a href="manage_posts.php" style="font-size: 0.85rem; color: var(--primary); text-decoration: none;">ดูทั้งหมด</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>หัวข้อข่าว</th>
                <th>ผู้เขียน</th>
                <th>วันที่</th>
                <th>สถานะ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recent_posts as $post): ?>
            <tr>
                <td style="font-weight: 600; color: var(--dark);"><?php echo htmlspecialchars($post['title']); ?></td>
                <td><?php echo htmlspecialchars($post['author']); ?></td>
                <td><?php echo date('d/m/Y', strtotime($post['created_at'])); ?></td>
                <td><span style="padding: 0.25rem 0.5rem; background: #dcfce7; color: #15803d; border-radius: 6px; font-size: 0.75rem;">เผยแพร่แล้ว</span></td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($recent_posts)): ?>
            <tr>
                <td colspan="4" style="text-align: center; color: var(--gray); padding: 2rem;">ยังไม่มีข่าวสารในระบบ</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</main>
</body>
</html>
