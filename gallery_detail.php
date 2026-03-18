<?php 
require_once 'db.php'; 

if (!isset($_GET['id'])) { header("Location: gallery.php"); exit(); }
$id = $_GET['id'];

// 1. ดึงข้อมูลหัวข้อและคำบรรยาย
$stmt = $conn->prepare("SELECT * FROM activities WHERE id = ?");
$stmt->execute([$id]);
$activity = $stmt->fetch();

if (!$activity) { echo "ไม่พบกิจกรรม"; exit(); }

// 2. ดึงรูปภาพย่อยทั้งหมดของกิจกรรมนี้
$img_stmt = $conn->prepare("SELECT * FROM activity_images WHERE activity_id = ?");
$img_stmt->execute([$id]);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $activity['title']; ?> - ประมวลภาพ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container py-5">
        <a href="gallery.php" class="btn btn-outline-secondary mb-4">
            <i class="fas fa-arrow-left"></i> ย้อนกลับไปหน้าอัลบั้มรวม
        </a>

        <div class="text-center mb-5">
            <h1 class="fw-bold text-primary"><?php echo $activity['title']; ?></h1>
            <p class="text-muted"><i class="far fa-calendar-alt"></i> จัดเมื่อ: <?php echo date('d/m/Y', strtotime($activity['created_at'])); ?></p>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <p class="lead" style="white-space: pre-wrap;"><?php echo $activity['description']; ?></p>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <?php while($img = $img_stmt->fetch()): ?>
            <div class="col-lg-3 col-md-4 col-6">
                <a href="uploads/<?php echo $img['image_path']; ?>" data-lightbox="mygallery" data-title="<?php echo $activity['title']; ?>">
                    <div class="ratio ratio-1x1 overflow-hidden rounded shadow-sm">
                        <img src="uploads/<?php echo $img['image_path']; ?>" class="w-100 h-100" style="object-fit: cover; transition:0.3s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                    </div>
                </a>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox-plus-jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</body>
</html>