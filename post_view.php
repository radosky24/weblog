<?php 
require_once 'config.php'; 

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("SELECT posts.*, users.full_name as author FROM posts JOIN users ON posts.author_id = users.id WHERE posts.id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();

if (!$post) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?> - ข่าวสารสำนักทะเบียน</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Sarabun:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .navbar {
            background: white;
            padding: 1rem 0;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .post-header {
            padding: 4rem 0;
            background-color: #f8fafc;
            margin-bottom: 3rem;
        }
        .post-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }
        .post-meta {
            display: flex;
            gap: 2rem;
            color: var(--gray);
            font-size: 1rem;
        }
        .post-meta span {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .post-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .post-image-hero {
            width: 100%;
            height: 450px;
            border-radius: 24px;
            object-fit: cover;
            margin-bottom: 3rem;
            box-shadow: var(--shadow);
        }

        .post-content {
            font-size: 1.15rem;
            line-height: 1.8;
            color: #334155;
            margin-bottom: 5rem;
        }
        .post-content p {
            margin-bottom: 1.5rem;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 2rem;
            transition: transform 0.2s ease;
        }
        .back-btn:hover {
            transform: translateX(-5px);
        }

        footer {
            background: var(--dark);
            color: white;
            padding: 4rem 0;
            text-align: center;
            margin-top: 5rem;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container nav-container">
            <a href="index.php" class="brand">
                <i class="fas fa-file-invoice"></i>
                <span>สำนักทะเบียน</span>
            </a>
            <div class="nav-links">
                <a href="login.php" class="btn btn-primary btn-sm">เข้าสู่ระบบ</a>
            </div>
        </div>
    </nav>

    <header class="post-header">
        <div class="post-container">
            <a href="index.php" class="back-btn"><i class="fas fa-arrow-left"></i> กลับสู่หน้าหลัก</a>
            <h1 class="post-title"><?php echo htmlspecialchars($post['title']); ?></h1>
            <div class="post-meta">
                <span><i class="far fa-calendar-alt"></i> <?php echo date('d F Y', strtotime($post['created_at'])); ?></span>
                <span><i class="far fa-user"></i> โดย <?php echo htmlspecialchars($post['author']); ?></span>
            </div>
        </div>
    </header>

    <main class="post-container">
        <?php if ($post['thumbnail']): ?>
            <img src="<?php echo htmlspecialchars($post['thumbnail']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" class="post-image-hero">
        <?php else: ?>
            <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&q=80&w=1200" alt="Default Hero" class="post-image-hero">
        <?php endif; ?>

        <div class="post-content">
            <?php echo nl2br($post['content']); // Using nl2br for simple display, could use Markdown or HTML editor later ?>
        </div>
    </main>

    <footer>
        <div class="container">
            <p style="opacity: 0.7; font-size: 0.9rem;">© 2026 ข่าวสารสำนักทะเบียน. สงวนลิขสิทธิ์ทั้งหมด.</p>
        </div>
    </footer>
</body>
</html>
