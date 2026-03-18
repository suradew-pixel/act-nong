<?php require_once 'db.php'; 
// ดึงข้อมูลประวัติจาก Database
$stmt = $conn->prepare("SELECT * FROM page_content WHERE page_name='history'");
$stmt->execute();
$data = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติหมู่บ้าน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container mt-4">
    <div class="bg-primary text-white text-center py-4 rounded-4 shadow">
        <h1 class="mb-0 fw-bold">ประวัติความเป็นมา</h1>
    </div>
</div>
    <div class="container py-4">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <?php if(!empty($data['image_path'])): ?>
                <div class="text-center mb-4">
                    <img src="uploads/<?php echo $data['image_path']; ?>" class="img-fluid rounded shadow-lg" style="max-height: 400px;">
                </div>
                <?php endif; ?>

                <div class="bg-white p-4 p-md-5 rounded shadow-sm">
                    <p class="lead" style="line-height: 1.8;">
                        <?php echo nl2br(htmlspecialchars($data['content'])); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>