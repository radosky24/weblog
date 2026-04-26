<?php
require_once '../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($action === 'add') {
    $title = $_POST['title'] ?? '';
    $excerpt = $_POST['excerpt'] ?? '';
    $content = $_POST['content'] ?? '';
    $thumbnail = $_POST['thumbnail'] ?? '';
    $author_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO posts (title, excerpt, content, thumbnail, author_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $excerpt, $content, $thumbnail, $author_id]);

    header("Location: manage_posts.php?success=added");
    exit;
}

if ($action === 'edit') {
    $id = $_POST['id'] ?? '';
    $title = $_POST['title'] ?? '';
    $excerpt = $_POST['excerpt'] ?? '';
    $content = $_POST['content'] ?? '';
    $thumbnail = $_POST['thumbnail'] ?? '';

    $stmt = $pdo->prepare("UPDATE posts SET title = ?, excerpt = ?, content = ?, thumbnail = ? WHERE id = ?");
    $stmt->execute([$title, $excerpt, $content, $thumbnail, $id]);

    header("Location: manage_posts.php?success=updated");
    exit;
}

if ($action === 'delete') {
    $id = $_GET['id'] ?? '';
    
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: manage_posts.php?success=deleted");
    exit;
}
?>
