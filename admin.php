<?php 
session_start();
require_once 'db.php'; 
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit(); }

// ดึงข้อมูลประวัติมารอไว้
$hist_stmt = $conn->prepare("SELECT * FROM page_content WHERE page_name='history'");
$hist_stmt->execute();
$history = $hist_stmt->fetch();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ระบบจัดการเว็บไซต์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> </head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-primary mb-4">
        <div class="container">
            <span class="navbar-brand">Admin Panel - บ้านหนองสิม</span>
            <div>
                <a href="index.php" target="_blank" class="btn btn-outline-light btn-sm me-2">ดูหน้าเว็บ</a>
                <a href="logout.php" class="btn btn-danger btn-sm">ออกจากระบบ</a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <ul class="nav nav-tabs mb-4" id="adminTab" role="tablist">
            <li class="nav-item"><button class="nav-link active" data-bs-target="#news" data-bs-toggle="tab">1. ข่าวสาร</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-target="#gallery" data-bs-toggle="tab">2. ภาพกิจกรรม</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-target="#leaders" data-bs-toggle="tab">3. ผู้นำชุมชน</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-target="#history" data-bs-toggle="tab">4. ประวัติหมู่บ้าน</button></li>
        </ul>

        <div class="tab-content">
            
            <div class="tab-pane fade show active" id="news">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card shadow-sm mb-3">
                            <div class="card-header bg-success text-white">เพิ่มข่าวใหม่</div>
                            <div class="card-body">
                                <form action="news_action.php?action=add" method="post" enctype="multipart/form-data">
                                    <div class="mb-2"><label>หัวข้อ</label><input type="text" name="title" class="form-control" required></div>
                                    <div class="mb-2"><label>เนื้อหา</label><textarea name="content" class="form-control" rows="3" required></textarea></div>
                                    <div class="mb-2"><label>รูปภาพ</label><input type="file" name="image" class="form-control"></div>
                                    <button type="submit" class="btn btn-success w-100">โพสต์ข่าว</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <table class="table table-bordered bg-white">
                            <thead><tr><th>หัวข้อ</th><th width="150">จัดการ</th></tr></thead>
                            <tbody>
                                <?php
                                $stmt = $conn->query("SELECT * FROM news ORDER BY created_at DESC");
                                while($row = $stmt->fetch()){
                                    echo "<tr><td>{$row['title']}</td>
                                    <td>
                                        <a href='news_edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>แก้ไข</a>
                                        <a href='news_action.php?action=delete&id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"ยืนยันลบ?\")'>ลบ</a>
                                    </td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

           <div class="tab-pane fade" id="gallery">
    <div class="row mt-3">
        <div class="col-md-4">
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-info text-white">สร้างอัลบั้มใหม่</div>
                <div class="card-body">
                    <form action="gallery_action_new.php?action=add" method="post" enctype="multipart/form-data">
                        <div class="mb-2"><label>ชื่องาน/กิจกรรม</label><input type="text" name="title" class="form-control" required></div>
                        <div class="mb-2"><label>คำบรรยาย</label><textarea name="description" class="form-control" rows="3"></textarea></div>
                        <div class="mb-2">
                            <label class="small text-muted">รูปปก (1 รูป)</label>
                            <input type="file" name="cover_image" class="form-control form-control-sm" required>
                        </div>
                        <div class="mb-3">
                            <label class="small text-muted">รูปในอัลบั้ม (หลายรูป)</label>
                            <input type="file" name="gallery[]" class="form-control form-control-sm" multiple>
                        </div>
                        <button type="submit" class="btn btn-info w-100 text-white">สร้างอัลบั้ม</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">รายการกิจกรรมทั้งหมด</div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th width="100">ปก</th>
                                <th>ชื่อกิจกรรม</th>
                                <th width="150">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // ดึงข้อมูลจากตาราง activities (ตารางใหม่ที่เราสร้าง)
                            $act_stmt = $conn->query("SELECT * FROM activities ORDER BY created_at DESC");
                            while($act = $act_stmt->fetch()){
                                $cover = !empty($act['cover_image']) ? "uploads/".$act['cover_image'] : "https://via.placeholder.com/50";
                            ?>
                            <tr>
                                <td><img src="<?php echo $cover; ?>" width="80" class="rounded"></td>
                                <td>
                                    <strong><?php echo $act['title']; ?></strong><br>
                                    <small class="text-muted"><?php echo mb_strimwidth($act['description'], 0, 50, '...'); ?></small>
                                </td>
                                <td>
                                    <a href="gallery_edit.php?id=<?php echo $act['id']; ?>" class="btn btn-sm btn-warning mb-1">แก้ไข</a>
                                    <a href="gallery_action_new.php?action=delete&id=<?php echo $act['id']; ?>" class="btn btn-sm btn-danger mb-1" onclick="return confirm('ยืนยันลบกิจกรรมนี้และรูปทั้งหมด?')">ลบ</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

            <div class="tab-pane fade" id="leaders">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">เพิ่มผู้นำชุมชน</div>
                            <div class="card-body">
                                <form action="save_info.php?action=add_leader" method="post" enctype="multipart/form-data">
                                    <div class="mb-2"><label>ชื่อ-นามสกุล</label><input type="text" name="name" class="form-control" required></div>
                                    <div class="mb-2"><label>ตำแหน่ง</label><input type="text" name="position" class="form-control" placeholder="เช่น ผู้ใหญ่บ้าน" required></div>
                                    <div class="mb-2"><label>เบอร์โทร</label><input type="text" name="phone" class="form-control"></div>
                                    <div class="mb-3"><label>รูปภาพ</label><input type="file" name="image" class="form-control"></div>
                                    <button type="submit" class="btn btn-primary w-100">บันทึกข้อมูล</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">รายชื่อผู้นำชุมชน</h5>
                                <table class="table">
                                    <thead><tr><th>รูป</th><th>ข้อมูล</th><th>จัดการ</th></tr></thead>
                                    <tbody>
                                        <?php
                                        $l_stmt = $conn->query("SELECT * FROM leaders ORDER BY id ASC");
                                        while($l = $l_stmt->fetch()){
                                            $img = $l['image_path'] ? "uploads/".$l['image_path'] : "https://via.placeholder.com/50";
                                            echo "<tr>
                                                <td><img src='$img' width='50' class='rounded-circle'></td>
                                                <td>
                                                    <strong>{$l['name']}</strong><br>
                                                    <small class='text-muted'>{$l['position']} | โทร: {$l['phone']}</small>
                                                </td>
                                                <td><a href='save_info.php?action=delete_leader&id={$l['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"ยืนยันลบ?\")'>ลบ</a></td>
                                            </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="history">
                <div class="card shadow-sm">
                    <div class="card-header bg-warning">แก้ไขข้อมูลประวัติหมู่บ้าน</div>
                    <div class="card-body">
                        <form action="save_info.php?action=update_history" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">รูปภาพปัจจุบัน</label>
                                    <?php if(!empty($history['image_path'])): ?>
                                        <img src="uploads/<?php echo $history['image_path']; ?>" class="img-fluid rounded mb-2">
                                    <?php else: ?>
                                        <div class="alert alert-secondary">ไม่มีรูปภาพ</div>
                                    <?php endif; ?>
                                    <input type="hidden" name="old_image" value="<?php echo $history['image_path']; ?>">
                                    <label class="small text-muted">เปลี่ยนรูปภาพใหม่ (ถ้าต้องการ)</label>
                                    <input type="file" name="image" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label">เนื้อหาประวัติความเป็นมา</label>
                                    <textarea name="content" class="form-control" rows="10" required><?php echo $history['content']; ?></textarea>
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-warning px-4">บันทึกการแก้ไข</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // สคริปต์จำ Tab ล่าสุดที่กดไว้ เวลา Refresh หน้าจะไม่เด้งกลับไปหน้าแรก
        $(document).ready(function(){
            $('button[data-bs-toggle="tab"]').on('show.bs.tab', function(e) {
                localStorage.setItem('activeTab', $(e.target).attr('data-bs-target'));
            });
            var activeTab = localStorage.getItem('activeTab');
            if(activeTab){
                $('#adminTab button[data-bs-target="' + activeTab + '"]').tab('show');
            }
        });
    </script>
</body>
</html>