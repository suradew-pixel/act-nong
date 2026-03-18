<?php
session_start();
require_once 'db.php';
if (!isset($_SESSION['admin_logged_in'])) exit();

$action = $_GET['action'] ?? '';

// ================= 1. เพิ่มกิจกรรมใหม่ =================
if ($action == 'add' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    
    // อัปรูปปก
    $cover_name = "";
    if (!empty($_FILES['cover_image']['name'])) {
        $cover_name = time() . "_cover_" . basename($_FILES['cover_image']['name']);
        move_uploaded_file($_FILES['cover_image']['tmp_name'], "uploads/" . $cover_name);
    }

    $stmt = $conn->prepare("INSERT INTO activities (title, description, cover_image) VALUES (?, ?, ?)");
    $stmt->execute([$title, $desc, $cover_name]);
    $activity_id = $conn->lastInsertId();

    // อัปรูปอัลบั้ม
    uploadGalleryImages($conn, $activity_id);
    header("Location: admin.php?msg=added");
}

// ================= 2. แก้ไขข้อมูลกิจกรรม =================
if ($action == 'update' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $cover_name = $_POST['old_cover'];

    // ถ้ามีการเปลี่ยนรูปปก
    if (!empty($_FILES['cover_image']['name'])) {
        // ลบรูปเก่าทิ้งก่อน (ถ้ามี)
        if($cover_name && file_exists("uploads/".$cover_name)) {
            unlink("uploads/".$cover_name);
        }
        // อัปรูปใหม่
        $cover_name = time() . "_cover_" . basename($_FILES['cover_image']['name']);
        move_uploaded_file($_FILES['cover_image']['tmp_name'], "uploads/" . $cover_name);
    }

    $stmt = $conn->prepare("UPDATE activities SET title=?, description=?, cover_image=? WHERE id=?");
    $stmt->execute([$title, $desc, $cover_name, $id]);

    // เพิ่มรูปเข้าอัลบั้ม (ถ้ามีเลือกเพิ่ม)
    uploadGalleryImages($conn, $id);
    
    header("Location: gallery_edit.php?id=$id&msg=updated");
}

// ================= 3. ลบกิจกรรม (ลบทั้งยวง) =================
if ($action == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // 1. ลบรูปปกออกจากโฟลเดอร์
    $stmt = $conn->prepare("SELECT cover_image FROM activities WHERE id = ?");
    $stmt->execute([$id]);
    $act = $stmt->fetch();
    if($act['cover_image'] && file_exists("uploads/".$act['cover_image'])) {
        unlink("uploads/".$act['cover_image']);
    }

    // 2. ลบรูปในอัลบั้มออกจากโฟลเดอร์
    $stmt_img = $conn->prepare("SELECT image_path FROM activity_images WHERE activity_id = ?");
    $stmt_img->execute([$id]);
    while($img = $stmt_img->fetch()) {
        if(file_exists("uploads/".$img['image_path'])) {
            unlink("uploads/".$img['image_path']);
        }
    }

    // 3. ลบข้อมูลจากฐานข้อมูล (ตาราง activity_images จะถูกลบเองถ้าตั้ง ON DELETE CASCADE ไว้ แต่ถ้าไม่ตั้ง ก็ลบ manual ได้)
    $conn->prepare("DELETE FROM activity_images WHERE activity_id = ?")->execute([$id]);
    $conn->prepare("DELETE FROM activities WHERE id = ?")->execute([$id]);

    header("Location: admin.php?msg=deleted");
}

// ================= 4. ลบรูปเดียว (ในหน้าแก้ไข) =================
if ($action == 'delete_single_img' && isset($_GET['img_id'])) {
    $img_id = $_GET['img_id'];
    $act_id = $_GET['act_id']; // รับมาเพื่อให้เด้งกลับถูกหน้า

    // ลบไฟล์จริง
    $stmt = $conn->prepare("SELECT image_path FROM activity_images WHERE id = ?");
    $stmt->execute([$img_id]);
    $img = $stmt->fetch();
    if($img && file_exists("uploads/".$img['image_path'])) {
        unlink("uploads/".$img['image_path']);
    }

    // ลบจาก DB
    $conn->prepare("DELETE FROM activity_images WHERE id = ?")->execute([$img_id]);

    header("Location: gallery_edit.php?id=$act_id");
}

// ฟังก์ชันช่วยอัปโหลดรููปหลายรูป
function uploadGalleryImages($conn, $activity_id) {
    if (!empty($_FILES['gallery']['name'][0])) {
        $total = count($_FILES['gallery']['name']);
        for ($i = 0; $i < $total; $i++) {
            if ($_FILES['gallery']['tmp_name'][$i] != "") {
                $gal_name = time() . "_" . $i . "_" . basename($_FILES['gallery']['name'][$i]);
                if (move_uploaded_file($_FILES['gallery']['tmp_name'][$i], "uploads/" . $gal_name)) {
                    $sql = "INSERT INTO activity_images (activity_id, image_path) VALUES (?, ?)";
                    $conn->prepare($sql)->execute([$activity_id, $gal_name]);
                }
            }
        }
    }
}
?>