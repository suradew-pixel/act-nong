<?php 
require_once 'db.php'; 

// ตรวจสอบว่ามี id ส่งมาไหม
if (!isset($_GET['id'])) {
    header("Location: news.php"); // ถ้าไม่มี ให้เด้งกลับไปหน้าข่าวรวม
    exit();
}

// ดึงข้อมูลข่าวตาม id ที่ส่งมา
$stmt = $conn->prepare("SELECT * FROM news WHERE id = ?");
$stmt->execute([$_GET['id']]);
$news = $stmt->fetch();

// ถ้าหาข่าวไม่เจอ
if (!$news) {
    echo "ไม่พบข่าวที่คุณต้องการ";
    exit();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $news['title']; ?> - บ้านหนองสิม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container py-5">
        <a href="news.php" class="btn btn-outline-secondary mb-4">
            <i class="fas fa-arrow-left"></i> กลับไปหน้ารวมข่าวสาร
        </a>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <article class="blog-post">
                    <h1 class="display-5 fw-bold mb-3"><?php echo $news['title']; ?></h1>
                    <p class="text-muted mb-4">
                        <i class="far fa-calendar-alt"></i> โพสต์เมื่อ: <?php echo date('d/m/Y H:i', strtotime($news['created_at'])); ?> น.
                    </p>

                    <?php if (!empty($news['image_path'])): ?>
                    <div class="mb-4 text-center">
                        <img src="uploads/<?php echo $news['image_path']; ?>" class="img-fluid rounded shadow" style="max-height: 500px; width: auto;">
                    </div>
                    <?php endif; ?>

                    <div class="content fs-5" style="line-height: 1.8; text-align: justify;">
                        <?php echo nl2br($news['content']); ?>
                    </div>
                </article>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</body>
</html>