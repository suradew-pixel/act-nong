<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กิจกรรมชุมชน - บ้านหนองสิม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .hover-zoom img { transition: transform 0.3s; }
        .hover-zoom:hover img { transform: scale(1.05); }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-4">
    <div class="bg-primary text-white text-center py-4 rounded-4 shadow">
        <h1 class="mb-0 fw-bold">ภาพกิจกรรม</h1>
    </div>
</div>

    <div class="container py-5">
        <div class="row g-4">
            <?php
            // ดึงกิจกรรมทั้งหมด เรียงจากใหม่ไปเก่า
            $stmt = $conn->query("SELECT * FROM activities ORDER BY created_at DESC");
            
            if ($stmt->rowCount() == 0) {
                echo "<div class='alert alert-secondary text-center w-100'>ยังไม่มีกิจกรรมในขณะนี้</div>";
            }

            while ($row = $stmt->fetch()) {
                $cover = !empty($row['cover_image']) ? "uploads/".$row['cover_image'] : "https://via.placeholder.com/400x300";
            ?>
            <div class="col-md-4 col-sm-6">
                <a href="gallery_detail.php?id=<?php echo $row['id']; ?>" class="text-decoration-none text-dark">
                    <div class="card h-100 border-0 shadow-sm hover-zoom">
                        <div style="height: 250px; overflow: hidden;">
                            <img src="<?php echo $cover; ?>" class="w-100 h-100" style="object-fit: cover;">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold mb-0"><?php echo $row['title']; ?></h5>
                            <small class="text-muted">
                                <i class="far fa-calendar-alt"></i> <?php echo date('d/m/Y', strtotime($row['created_at'])); ?>
                            </small>
                            <div class="mt-2 text-primary small">
                                คลิกเพื่อดูรูปทั้งหมด <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</body>
</html>