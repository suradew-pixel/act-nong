<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ผู้นำชุมชน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-4">
    <div class="bg-primary text-white text-center py-4 rounded-4 shadow">
        <h1 class="mb-0 fw-bold">คณะผู้นำชุมชน</h1>
    </div>
</div>
    <div class="container py-4">
        <div class="row justify-content-center">
            
            <?php
            $stmt = $conn->query("SELECT * FROM leaders ORDER BY id ASC");
            if($stmt->rowCount() == 0) echo "<p class='text-center'>ยังไม่มีข้อมูลผู้นำชุมชน</p>";
            
            while($row = $stmt->fetch()) {
                $img = !empty($row['image_path']) ? "uploads/".$row['image_path'] : "https://via.placeholder.com/150?text=No+Image";
            ?>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card-custom p-4 text-center h-100 bg-white">
                    <div style="width:150px; height:150px; margin:0 auto; overflow:hidden; border-radius:50%; border:5px solid #f0f0f0;">
                        <img src="<?php echo $img; ?>" style="width:100%; height:100%; object-fit:cover;">
                    </div>
                    <h4 class="mt-3 fw-bold text-primary"><?php echo $row['name']; ?></h4>
                    <p class="text-muted fw-bold mb-1"><?php echo $row['position']; ?></p>
                    <?php if($row['phone']): ?>
                        <p class="small text-secondary"><i class="fas fa-phone-alt"></i> โทร: <?php echo $row['phone']; ?></p>
                    <?php endif; ?>
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