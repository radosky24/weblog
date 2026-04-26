<?php 
require_once 'header.php'; 

$id = $_GET['id'] ?? null;
$post = null;

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->execute([$id]);
    $post = $stmt->fetch();
}

$title_page = $post ? 'แก้ไขข่าวสาร' : 'เขียนข่าวใหม่';
?>

<div class="header-top">
    <h2><?php echo $title_page; ?></h2>
    <a href="manage_posts.php" class="btn btn-sm btn-edit"><i class="fas fa-arrow-left"></i> กลับ</a>
</div>

<div class="card">
    <form action="post_actions.php" method="POST">
        <input type="hidden" name="action" value="<?php echo $post ? 'edit' : 'add'; ?>">
        <?php if ($post): ?>
            <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
        <?php endif; ?>

        <div class="form-group">
            <label for="title">หัวข้อข่าว</label>
            <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($post['title'] ?? ''); ?>" required placeholder="ระบุหัวข้อข่าว...">
        </div>

        <div class="form-group">
            <label for="excerpt">เรื่องย่อ (Excerpt)</label>
            <textarea id="excerpt" name="excerpt" class="form-control" rows="3" placeholder="สรุปเนื้อหาข่าวสั้นๆ..."><?php echo htmlspecialchars($post['excerpt'] ?? ''); ?></textarea>
        </div>

        <div class="form-group">
            <label for="content">เนื้อหาข่าว (HTML)</label>
            <textarea id="content" name="content" class="form-control" rows="10" placeholder="ระบุเนื้อหาข่าวทั้งหมด..."><?php echo htmlspecialchars($post['content'] ?? ''); ?></textarea>
        </div>

        <div class="form-group">
            <label for="thumbnail">URL รูปภาพหน้าปก</label>
            <input type="text" id="thumbnail" name="thumbnail" class="form-control" value="<?php echo htmlspecialchars($post['thumbnail'] ?? ''); ?>" placeholder="https://example.com/image.jpg">
        </div>

        <div style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> <?php echo $post ? 'บันทึกการแก้ไข' : 'บันทึกข่าวสาร'; ?>
            </button>
        </div>
    </form>
</div>

</main>
</body>
</html>
