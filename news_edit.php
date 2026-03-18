<?php
session_start();
require_once 'db.php';
if (!isset($_SESSION['admin_logged_in'])) exit();

if (isset($_GET['id'])) {
    $stmt = $conn->prepare("SELECT * FROM news WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $news = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขข่าวสาร</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow" style="max-width: 600px; margin: auto;">
            <div class="card-header bg-warning">แก้ไขข่าวสาร</div>
            <div class="card-body">
                <form action="news_action.php?action=edit" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $news['id']; ?>">
                    <input type="hidden" name="old_image" value="<?php echo $news['image_path']; ?>">
                    
                    <div class="mb-3">
                        <label>หัวข้อ</label>
                        <input type="text" name="title" class="form-control" value="<?php echo $news['title']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>เนื้อหา</label>
                        <textarea name="content" class="form-control" rows="5" required><?php echo $news['content']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label>เปลี่ยนรูปภาพ (ถ้าไม่เปลี่ยนให้เว้นว่าง)</label>
                        <input type="file" name="image" class="form-control">
                        <?php if($news['image_path']): ?>
                            <small class="text-muted">รูปเดิม: <?php echo $news['image_path']; ?></small>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-warning w-100">บันทึกการแก้ไข</button>
                    <a href="admin.php" class="btn btn-secondary w-100 mt-2">ยกเลิก</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>