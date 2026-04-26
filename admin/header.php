<?php
require_once '../config.php';

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบหลังบ้าน - ข่าวสารสำนักทะเบียน</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Sarabun:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --sidebar-width: 260px;
        }

        body {
            background-color: #f1f5f9;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--dark);
            color: white;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .sidebar-brand {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 2.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--secondary);
        }

        .sidebar-nav {
            list-style: none;
            flex-grow: 1;
        }

        .sidebar-nav li {
            margin-bottom: 0.5rem;
        }

        .sidebar-nav a {
            color: #94a3b8;
            text-decoration: none;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.2s ease;
        }

        .sidebar-nav a:hover, .sidebar-nav a.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .sidebar-nav a.active {
            background-color: var(--primary);
            color: white;
        }

        .sidebar-user {
            margin-top: auto;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background-color: var(--gray);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            flex-grow: 1;
            padding: 2rem;
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .header-top h2 {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .card {
            background: white;
            padding: 1.5rem;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin-bottom: 1.5rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .stat-info h3 {
            font-size: 0.85rem;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .stat-info p {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
        }

        /* Forms & Tables */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            text-align: left;
            padding: 1rem;
            color: var(--gray);
            font-size: 0.85rem;
            border-bottom: 1px solid #e2e8f0;
        }

        table td {
            padding: 1rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .action-btns {
            display: flex;
            gap: 0.5rem;
        }

        .btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
        }

        .btn-edit { background-color: #e2e8f0; color: var(--dark); }
        .btn-delete { background-color: #fee2e2; color: #b91c1c; }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-brand">
            <i class="fas fa-file-invoice"></i>
            <span>สำนักทะเบียน</span>
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li><a href="dashboard.php" class="<?php echo $current_page == 'dashboard.php' ? 'active' : ''; ?>"><i class="fas fa-chart-line"></i> แผงควบคุม</a></li>
                <li><a href="manage_posts.php" class="<?php echo $current_page == 'manage_posts.php' ? 'active' : ''; ?>"><i class="fas fa-newspaper"></i> จัดการข่าวสาร</a></li>
                <li><a href="post_editor.php" class="<?php echo $current_page == 'post_editor.php' ? 'active' : ''; ?>"><i class="fas fa-plus-circle"></i> เขียนข่าวใหม่</a></li>
            </ul>
        </nav>
        <div class="sidebar-user">
            <div class="user-avatar"><?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?></div>
            <div style="flex-grow: 1;">
                <p style="font-size: 0.85rem; font-weight: 600;"><?php echo $_SESSION['full_name']; ?></p>
                <a href="../auth_action.php?action=logout" style="font-size: 0.75rem; color: #94a3b8; text-decoration: none;">ออกจากระบบ</a>
            </div>
        </div>
    </aside>

    <main class="main-content">
