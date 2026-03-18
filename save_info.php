<?php
session_start();
require_once 'db.php';
if (!isset($_SESSION['admin_logged_in'])) exit();

$action = $_GET['action'] ?? '';

// ================= จัดการประวัติหมู่บ้าน =================
if ($action == 'update_history' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = $_POST['content'];
    $old_image = $_POST['old_image'];
    $image_path = $old_image;

    // ถ้ามีการอัปโหลดรูปใหม่
    if (!empty($_FILES['image']['name'])) {
        $target = "uploads/" . time() . "_" . basename($_FILES['image']['name']);
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $image_path = basename($target);
        }
    }

    $stmt = $conn->prepare("UPDATE page_content SET content=?, image_path=? WHERE page_name='history'");
    $stmt->execute([$content, $image_path]);
    
    header("Location: admin.php?tab=history");
}

// ================= จัดการผู้นำชุมชน =================
// 1. เพิ่มผู้นำ
if ($action == 'add_leader' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $phone = $_POST['phone'];
    $image_path = "";

    if (!empty($_FILES['image']['name'])) {
        $target = "uploads/" . time() . "_" . basename($_FILES['image']['name']);
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $image_path = basename($target);
        }
    }

    $stmt = $conn->prepare("INSERT INTO leaders (name, position, phone, image_path) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $position, $phone, $image_path]);
    header("Location: admin.php?tab=leaders");
}

// 2. ลบผู้นำ
if ($action == 'delete_leader' && isset($_GET['id'])) {
    $stmt = $conn->prepare("DELETE FROM leaders WHERE id=?");
    $stmt->execute([$_GET['id']]);
    header("Location: admin.php?tab=leaders");
}

// 3. แก้ไขผู้นำ (ถ้าต้องการแก้ไข ให้ทำหน้า edit แยก หรือใช้ระบบลบแล้วเพิ่มใหม่ก็ได้เพื่อความง่าย ในที่นี้ขอทำแบบเพิ่ม/ลบ ก่อนครับ)
?>