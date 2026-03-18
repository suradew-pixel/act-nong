<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแรก - บ้านหนองสิม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include 'navbar.php'; ?>

    <div class="container mt-4"> <header class="text-white text-center rounded-4 shadow overflow-hidden" 
            style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('images/bg-main.jpg'); 
                   background-size: cover; 
                   background-position: center; 
                   padding-top: 80px; 
                   padding-bottom: 80px;">
        
        <div class="px-3">
            <h1 class="display-5 fw-bold mb-3">ยินดีต้อนรับสู่ หมู่บ้านหนองสิม</h1>
            <p class="lead mb-4">แหล่งวัฒนธรรม ผ้าไหมงาม ภูมิปัญญาท้องถิ่น <br> จ.สุรินทร์</p>
            <a href="#history-preview" class="btn btn-light rounded-pill px-4 text-primary fw-bold shadow-sm">มาเด้อพี่น้อง</a>
        </div>

    </header>

</div>

</div>

    <section id="history-preview" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="position-relative">
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            <div class="position-relative text-center">
                                 <img src="images/history-new.jpg" class="img-fluid rounded-4 shadow-lg w-130" alt="ภาพประวัติหมู่บ้าน">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 ps-lg-5">
                    <h5 class="text-primary fw-bold text-uppercase"></h5>
                    <h2 class="fw-bold mb-3">ประวัติความเป็นมา</h2>
                    <p class="text-muted text-indent">
                        หมู่บ้านหนองสิม ตำบลจอมพระ อำเภอจอมพระ จังหวัดสุรินทร์ เป็นชุมชนที่มีเอกลักษณ์เฉพาะตัว 
                        มีทรัพยากรในท้องถิ่นที่หลากหลาย ไม่ว่าจะเป็นอาชีพการเกษตร การทอผ้าไหม วัฒนธรรมประเพณีที่สืบทอดกันมาช้านาน...
                    </p>
                    <ul class="list-unstyled mb-4">
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>วิถีชีวิตเกษตรกรรมและภูมิปัญญา</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>ผลิตภัณฑ์ผ้าไหมท้องถิ่น</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>ประเพณีวัฒนธรรมอันดีงาม</li>
                    </ul>
                    <a href="history.php" class="btn btn-outline-primary rounded-pill px-4">อ่านประวัติฉบับเต็ม <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <h2 class="fw-bold">ข่าวสารและกิจกรรมล่าสุด</h2>
                    <p class="text-muted mb-0">ติดตามความเคลื่อนไหวของหมู่บ้านหนองสิม</p>
                </div>
                <a href="news.php" class="btn btn-link text-decoration-none">ดูข่าวทั้งหมด <i class="fas fa-angle-right"></i></a>
            </div>

            <div class="row">
                <?php
                // ดึงข่าวล่าสุด 3 อันดับ
                try {
                    $stmt = $conn->query("SELECT * FROM news ORDER BY created_at DESC LIMIT 3");
                    
                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch()) {
                            // เช็ครูปภาพ ถ้าไม่มีให้ใช้รูป placeholder
                            $imgSrc = !empty($row['image_path']) ? "uploads/".$row['image_path'] : "https://via.placeholder.com/400x250?text=No+Image";
                            // ตัดข้อความให้สั้นลง
                            $excerpt = mb_strimwidth(strip_tags($row['content']), 0, 100, "...");
                            // แปลงวันที่
                            $date = date('d/m/Y', strtotime($row['created_at']));
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm hover-card">
                        <div class="overflow-hidden rounded-top" style="height: 200px;">
                            <img src="<?php echo $imgSrc; ?>" class="w-100 h-100 object-fit-cover" alt="news">
                        </div>
                        <div class="card-body">
                            <small class="text-muted"><i class="far fa-calendar-alt me-1"></i> <?php echo $date; ?></small>
                            <h5 class="card-title fw-bold mt-2 text-truncate"><?php echo htmlspecialchars($row['title']); ?></h5>
                            <p class="card-text text-secondary small"><?php echo $excerpt; ?></p>
                            <a href="news.php" class="btn btn-sm btn-outline-primary mt-2">อ่านต่อ</a>
                        </div>
                    </div>
                </div>
                <?php 
                        }
                    } else {
                        echo "<div class='col-12 text-center py-5 text-muted'>ยังไม่มีข่าวสารในขณะนี้</div>";
                    }
                } catch (PDOException $e) {
                    echo "<div class='alert alert-danger'>เกิดข้อผิดพลาด: " . $e->getMessage() . "</div>";
                }
                ?>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container text-center">
            <h2 class="fw-bold mb-5">เมนูบริการข้อมูล</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-6 col-md-3">
                    <a href="leaders.php" class="text-decoration-none text-dark">
                        <div class="p-4 border rounded-4 hover-shadow bg-white">
                            <i class="fas fa-users fa-3x text-primary mb-3"></i>
                            <h5 class="fw-bold">ผู้นำชุมชน</h5>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="calendar.php" class="text-decoration-none text-dark">
                        <div class="p-4 border rounded-4 hover-shadow bg-white">
                            <i class="fas fa-calendar-check fa-3x text-success mb-3"></i>
                            <h5 class="fw-bold">กิจกรรม</h5>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="map.php" class="text-decoration-none text-dark">
                        <div class="p-4 border rounded-4 hover-shadow bg-white">
                            <i class="fas fa-map-marked-alt fa-3x text-danger mb-3"></i>
                            <h5 class="fw-bold">แผนที่</h5>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="gallery.php" class="text-decoration-none text-dark">
                        <div class="p-4 border rounded-4 hover-shadow bg-white">
                            <i class="fas fa-images fa-3x text-warning mb-3"></i>
                            <h5 class="fw-bold">ประมวลภาพ</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>