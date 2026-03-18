<?php
session_start();
require_once 'db.php';
if (!isset($_SESSION['admin_logged_in'])) exit();

$action = $_GET['action'] ?? '';

// เพิ่มข่าว
if ($action == 'add' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image_path = "";
    
    if (!empty($_FILES['image']['name'])) {
        $target = "uploads/" . time() . "_" . basename($_FILES['image']['name']);
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $image_path = basename($target);
        }
    }
    
    $stmt = $conn->prepare("INSERT INTO news (title, content, image_path) VALUES (?, ?, ?)");
    $stmt->execute([$title, $content, $image_path]);
}

// แก้ไขข่าว
if ($action == 'edit' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image_path = $_POST['old_image']; // ใช้รูปเดิมไปก่อน

    // ถ้ามีการอัปโหลดรูปใหม่
    if (!empty($_FILES['image']['name'])) {
        $target = "uploads/" . time() . "_" . basename($_FILES['image']['name']);
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $image_path = basename($target); // เปลี่ยนชื่อไฟล์รูปเป็นอันใหม่
        }
    }

    $stmt = $conn->prepare("UPDATE news SET title=?, content=?, image_path=? WHERE id=?");
    $stmt->execute([$title, $content, $image_path, $id]);
}

// ลบข่าว
if ($action == 'delete' && isset($_GET['id'])) {
    $stmt = $conn->prepare("DELETE FROM news WHERE id=?");
    $stmt->execute([$_GET['id']]);
}

header("Location: admin.php");
?>