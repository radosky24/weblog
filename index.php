<?php 
require_once 'config.php'; 

$posts = $pdo->query("SELECT posts.*, users.full_name as author FROM posts JOIN users ON posts.author_id = users.id ORDER BY created_at DESC LIMIT 10")->fetchAll();
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข่าวสารสำนักทะเบียน - หน้าแรก</title>
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

        .hero {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: white;
            padding: 5rem 0;
            text-align: center;
            margin-bottom: 4rem;
            border-radius: 0 0 50px 50px;
        }
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            font-weight: 800;
        }
        .hero p {
            font-size: 1.25rem;
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto;
        }

        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2.5rem;
            margin-bottom: 5rem;
        }

        .news-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            border: 1px solid #f1f5f9;
        }
        .news-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .news-image {
            height: 220px;
            background-color: #f1f5f9;
            background-size: cover;
            background-position: center;
            position: relative;
        }
        .news-category {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: var(--secondary);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .news-content {
            padding: 1.5rem;
            flex-grow: 1;
        }
        .news-date {
            font-size: 0.85rem;
            color: var(--gray);
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .news-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 1rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .news-summary {
            font-size: 0.95rem;
            color: var(--gray);
            margin-bottom: 1.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .news-footer {
            padding: 1.5rem;
            border-top: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        footer {
            background: var(--dark);
            color: white;
            padding: 4rem 0;
            text-align: center;
        }
        .footer-logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 1.5rem;
            display: inline-block;
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

    <section class="hero">
        <div class="container">
            <h1>ข่าวสารสำนักทะเบียน</h1>
            <p>ติดตามข่าวสาร ประกาศ และความเคลื่อนไหวล่าสุดจากสำนักทะเบียน เพื่อความสะดวกและรวดเร็วในการรับบริการ</p>
        </div>
    </section>

    <main class="container">
        <div class="news-grid">
            <?php foreach ($posts as $post): ?>
            <article class="news-card">
                <div class="news-image" style="background-image: url('<?php echo htmlspecialchars($post['thumbnail'] ?: 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&q=80&w=800'); ?>')">
                    <span class="news-category">ข่าวประกาศ</span>
                </div>
                <div class="news-content">
                    <div class="news-date">
                        <i class="far fa-calendar-alt"></i>
                        <?php echo date('d M Y', strtotime($post['created_at'])); ?>
                    </div>
                    <h2 class="news-title"><?php echo htmlspecialchars($post['title']); ?></h2>
                    <p class="news-summary"><?php echo htmlspecialchars($post['excerpt']); ?></p>
                </div>
                <div class="news-footer">
                    <span style="font-size: 0.85rem; color: var(--gray);">โดย <?php echo htmlspecialchars($post['author']); ?></span>
                    <a href="post_view.php?id=<?php echo $post['id']; ?>" style="color: var(--primary); text-decoration: none; font-weight: 600; font-size: 0.9rem;">อ่านเพิ่มเติม <i class="fas fa-arrow-right"></i></a>
                </div>
            </article>
            <?php endforeach; ?>

            <?php if (empty($posts)): ?>
            <div style="grid-column: 1/-1; text-align: center; padding: 5rem 0;">
                <i class="fas fa-newspaper" style="font-size: 4rem; color: #e2e8f0; margin-bottom: 1.5rem;"></i>
                <p style="color: var(--gray); font-size: 1.2rem;">ยังไม่มีข่าวสารในขณะนี้</p>
            </div>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <div class="container">
            <span class="footer-logo">สำนักทะเบียน</span>
            <p style="opacity: 0.7; font-size: 0.9rem;">© 2026 ข่าวสารสำนักทะเบียน. สงวนลิขสิทธิ์ทั้งหมด.</p>
            <div style="margin-top: 1.5rem; display: flex; justify-content: center; gap: 1.5rem;">
                <a href="#" style="color: white; opacity: 0.7;"><i class="fab fa-facebook-f"></i></a>
                <a href="#" style="color: white; opacity: 0.7;"><i class="fab fa-twitter"></i></a>
                <a href="#" style="color: white; opacity: 0.7;"><i class="fab fa-line"></i></a>
            </div>
        </div>
    </footer>
</body>
</html>
