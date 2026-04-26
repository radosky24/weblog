<?php 
require_once 'header.php'; 

$posts = $pdo->query("SELECT posts.*, users.username as author FROM posts JOIN users ON posts.author_id = users.id ORDER BY created_at DESC")->fetchAll();
?>

<div class="header-top">
    <h2>จัดการข่าวสาร</h2>
    <a href="post_editor.php" class="btn btn-primary"><i class="fas fa-plus"></i> เขียนข่าวใหม่</a>
</div>

<div class="card">
    <table>
        <thead>
            <tr>
                <th width="50">ID</th>
                <th>หัวข้อข่าว</th>
                <th>ผู้เขียน</th>
                <th>วันที่สร้าง</th>
                <th width="150">การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post): ?>
            <tr>
                <td><?php echo $post['id']; ?></td>
                <td style="font-weight: 600; color: var(--dark);"><?php echo htmlspecialchars($post['title']); ?></td>
                <td><?php echo htmlspecialchars($post['author']); ?></td>
                <td><?php echo date('d/m/Y H:i', strtotime($post['created_at'])); ?></td>
                <td>
                    <div class="action-btns">
                        <a href="post_editor.php?id=<?php echo $post['id']; ?>" class="btn btn-sm btn-edit" title="แก้ไข"><i class="fas fa-edit"></i></a>
                        <a href="post_actions.php?action=delete&id=<?php echo $post['id']; ?>" class="btn btn-sm btn-delete" title="ลบ" onclick="return confirm('ยืนยันการลบข่าวสารนี้?')"><i class="fas fa-trash"></i></a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($posts)): ?>
            <tr>
                <td colspan="5" style="text-align: center; color: var(--gray); padding: 3rem;">
                    <i class="fas fa-folder-open" style="font-size: 2rem; margin-bottom: 1rem; display: block;"></i>
                    ยังไม่มีข่าวสารในระบบ
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</main>
</body>
</html>
