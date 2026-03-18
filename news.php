<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข่าวประชาสัมพันธ์ - บ้านหนองสิม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-4">
        <div class="bg-primary text-white text-center py-4 rounded-4 shadow">
             <h1 class="mb-0 fw-bold">ข่าวประชาสัมพันธ์</h1>
        </div>
    </div>

    <div class="container py-5">
        <div class="row g-4">
            <?php
            // ดึงข้อมูลข่าว ล่าสุดขึ้นก่อน
            $stmt = $conn->query("SELECT * FROM news ORDER BY created_at DESC");
            
            if ($stmt->rowCount() == 0) {
                echo "<div class='alert alert-secondary text-center'>ยังไม่มีข่าวสารในขณะนี้</div>";
            }

            while ($row = $stmt->fetch()) {
                // กำหนดรูปภาพ (ถ้าไม่มีให้ใช้รูปแทน)
                $img = !empty($row['image_path']) ? "uploads/".$row['image_path'] : "https://via.placeholder.com/400x250?text=No+Image";
                
                // *** สูตรตัดคำให้สั้น (Highlight) ***
                // ตัดเหลือ 150 ตัวอักษรสำหรับภาษาไทย
                $content_short = mb_substr($row['content'], 0, 150, 'UTF-8') . "..."; 
            ?>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 hover-card">
                    <img src="<?php echo $img; ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold text-primary"><?php echo $row['title']; ?></h5>
                        <p class="text-muted small mb-2">
                            <i class="far fa-calendar-alt"></i> <?php echo date('d/m/Y', strtotime($row['created_at'])); ?>
                        </p>
                        <p class="card-text flex-grow-1"><?php echo $content_short; ?></p>
                        
                        <a href="news_detail.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-primary mt-3">
                            อ่านรายละเอียด <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</body>
</html>