<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แผนที่หมู่บ้าน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container mt-4">
        <div class="bg-primary text-white text-center py-4 rounded-4 shadow">
            <h1 class="mb-0 fw-bold">แผนที่การเดินทาง</h1>
        </div>
    </div>

    <div class="container mt-4 mb-5"> 
        <div class="card shadow p-2 rounded-4 border-0">
            
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d962.8424329730232!2d103.61953396390923!3d15.138026286633108!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1z4Lia4LmJ4Liy4LiZ4Lir4LiZ4Lit4LiH4Liq4Li04LihIOC4iOC4reC4oeC4nuC4o-C4sCDguKrguLjguKPguLTguJnguJfguKPguYw!5e0!3m2!1sen!2sth!4v1771414141284!5m2!1sen!2sth" 
                width="100%" 
                height="500" 
                style="border:0; border-radius: 10px;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>