<?php
// config.php
$host = '127.0.0.1';
$dbname = 'weblog';
$username = 'root';
$password = '';

try {
    // Check if we should use 127.0.0.1 if localhost fails (common on some Windows setups)
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

session_start();

// Base URL configuration (adjust if necessary)
define('BASE_URL', '/weblog/');
?>
