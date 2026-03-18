<?php
session_start();
require_once 'db.php';
if (!isset($_SESSION['admin_logged_in'])) exit();

$action = $_GET['action'] ?? '';

// เพิ่มรูป
if ($action == 'add' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_FILES['image']['name'])) {
        $caption = $_POST['caption'];
        $target = "uploads/" . time() . "_" . basename($_FILES['image']['name']);
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $stmt = $conn->prepare("INSERT INTO gallery (image_path, caption) VALUES (?, ?)");
            $stmt->execute([basename($target), $caption]);
        }
    }
}

// ลบรูป
if ($action == 'delete' && isset($_GET['id'])) {
    $stmt = $conn->prepare("DELETE FROM gallery WHERE id=?");
    $stmt->execute([$_GET['id']]);
}

header("Location: admin.php");
?>