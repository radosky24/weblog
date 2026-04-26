<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ - ข่าวสารสำนักทะเบียน</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Sarabun:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 3rem;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 420px;
            transform: translateY(0);
            transition: transform 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: -2px; left: -2px; right: -2px; bottom: -2px;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            border-radius: 26px;
            z-index: -1;
            opacity: 0.3;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .login-header h1 {
            font-size: 1.75rem;
            color: var(--dark);
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .login-header p {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--dark);
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            padding: 0.85rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.2s ease;
            outline: none;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(30, 58, 138, 0.1);
        }

        .btn-login {
            width: 100%;
            margin-top: 1rem;
            padding: 1rem;
            font-size: 1.1rem;
        }

        .alert {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            text-align: center;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        /* Decorative circles */
        .circle {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            z-index: 0;
            opacity: 0.2;
            filter: blur(40px);
        }
        .circle-1 { width: 300px; height: 300px; top: -100px; left: -100px; }
        .circle-2 { width: 250px; height: 250px; bottom: -50px; right: -50px; background: var(--secondary); }
    </style>
</head>
<body>
    <div class="circle circle-1"></div>
    <div class="circle circle-2"></div>

    <div class="login-card">
        <div class="login-header">
            <h1>เข้าสู่ระบบ</h1>
            <p>ระบบจัดการข่าวสารสำนักทะเบียน</p>
        </div>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง
            </div>
        <?php endif; ?>

        <form action="auth_action.php" method="POST">
            <input type="hidden" name="action" value="login">
            <div class="form-group">
                <label for="username">ชื่อผู้ใช้งาน</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="กรอกชื่อผู้ใช้" required autofocus>
            </div>
            <div class="form-group">
                <label for="password">รหัสผ่าน</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="กรอกรหัสผ่าน" required>
            </div>
            <button type="submit" class="btn btn-primary btn-login">เข้าสู่ระบบ</button>
        </form>

        <div style="text-align: center; margin-top: 2rem;">
            <a href="index.php" style="color: var(--gray); text-decoration: none; font-size: 0.85rem;">← กลับสู่หน้าหลัก</a>
        </div>
    </div>
</body>
</html>
