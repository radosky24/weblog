<?php
require_once 'config.php';

header('Content-Type: text/html; charset=utf-8');

echo "<!DOCTYPE html>
<html lang='th'>
<head>
    <meta charset='UTF-8'>
    <title>Database Connection Test</title>
    <style>
        body { font-family: 'Sarabun', sans-serif; background: #f4f7f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); text-align: center; }
        .success { color: #2ecc71; font-weight: bold; font-size: 1.5rem; }
        .error { color: #e74c3c; font-weight: bold; font-size: 1.5rem; }
        .info { margin-top: 1rem; color: #7f8c8d; }
    </style>
</head>
<body>
    <div class='card'>";

try {
    if ($pdo) {
        echo "<div class='success'>✅ เชื่อมต่อฐานข้อมูลสำเร็จ!</div>";
        echo "<div class='info'>Host: localhost | Database: weblog | User: root</div>";
        
        // Test query
        $stmt = $pdo->query("SELECT VERSION()");
        $version = $stmt->fetchColumn();
        echo "<div class='info'>MySQL Version: " . htmlspecialchars($version) . "</div>";
    }
} catch (Exception $e) {
    echo "<div class='error'>❌ เชื่อมต่อล้มเหลว!</div>";
    echo "<div class='info'>" . htmlspecialchars($e->getMessage()) . "</div>";
}

echo "    <br><a href='index.php' style='color: #3498db; text-decoration: none;'>กลับสู่หน้าหลัก</a>
    </div>
</body>
</html>";
?>
