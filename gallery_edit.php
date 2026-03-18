<?php
session_start();
require_once 'db.php';
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit(); }

if (!isset($_GET['id'])) { header("Location: admin.php"); exit(); }
$id = $_GET['id'];

// ดึงข้อมูลกิจกรรม
$stmt = $conn->prepare("SELECT * FROM activities WHERE id = ?");
$stmt->execute([$id]);
$act = $stmt->fetch();

// ดึงรูปภาพในอัลบั้ม
$img_stmt = $conn->prepare("SELECT * FROM activity_images WHERE activity_id = ?");
$img_stmt->execute([$id]);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขกิจกรรม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-warning">
                        <h4 class="mb-0">แก้ไขกิจกรรม: <?php echo $act['title']; ?></h4>
                    </div>
                    <div class="card-body">
                        <form action="gallery_action_new.php?action=update" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $act['id']; ?>">
                            <input type="hidden" name="old_cover" value="<?php echo $act['cover_image']; ?>">

                            <div class="mb-3">
                                <label>ชื่องาน/กิจกรรม</label>
                                <input type="text" name="title" class="form-control" value="<?php echo $act['title']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>คำบรรยาย</label>
                                <textarea name="description" class="form-control" rows="4"><?php echo $act['description']; ?></textarea>
                            </div>
                            
                            <div class="mb-4">
                                <label class="fw-bold">รูปปกปัจจุบัน</label>
                                <div class="d-flex align-items-center mt-2">
                                    <img src="uploads/<?php echo $act['cover_image']; ?>" width="120" class="rounded me-3 border">
                                    <div>
                                        <label class="form-label small text-muted">เปลี่ยนรูปปกใหม่ (ถ้าต้องการ)</label>
                                        <input type="file" name="cover_image" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="mb-4 p-3 bg-light rounded border">
                                <label class="fw-bold text-success"><i class="fas fa-plus-circle"></i> เพิ่มรูปภาพเข้าอัลบั้ม</label>
                                <input type="file" name="gallery[]" class="form-control mt-2" multiple>
                                <small class="text-muted">* เลือกได้หลายรูปพร้อมกัน</small>
                            </div>

                            <button type="submit" class="btn btn-warning w-100 btn-lg">บันทึกการแก้ไข</button>
                            <a href="admin.php" class="btn btn-secondary w-100 mt-2">ยกเลิก</a>
                        </form>

                        <hr class="my-4">

                        <h5 class="fw-bold mb-3">จัดการรูปภาพในอัลบั้ม</h5>
                        <div class="row g-2">
                            <?php while($img = $img_stmt->fetch()): ?>
                            <div class="col-md-3 col-4 text-center">
                                <div class="position-relative border rounded overflow-hidden">
                                    <img src="uploads/<?php echo $img['image_path']; ?>" class="w-100" style="height: 100px; object-fit: cover;">
                                    <a href="gallery_action_new.php?action=delete_single_img&img_id=<?php echo $img['id']; ?>&act_id=<?php echo $act['id']; ?>" 
                                       class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 p-0 px-2 rounded-circle"
                                       onclick="return confirm('ลบรูปนี้?')">
                                        &times;
                                    </a>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>