<?php
session_start();
include 'db.php';

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือยัง
if (!isset($_SESSION['customer_ID'])) {
    header("Location: login.php?error=กรุณาเข้าสู่ระบบก่อนดูประวัติการเช่า");
    exit();
}

$customer_ID = $_SESSION['customer_ID'];

// ใช้ prepared statement ป้องกัน SQL Injection
$sql = "SELECT rent.*, movie.movie_name, movie.movie_Path 
        FROM rent 
        JOIN movie ON rent.movie_ID = movie.movie_ID 
        WHERE rent.customer_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $customer_ID);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="th">
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติการเช่า</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css?v=3">
</head>
<body class="bg-dark">

<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="index.php">
            <i class="fas fa-film me-2"></i>เช่าภาพยนตร์
        </a>
        <div class="d-flex gap-3">
            <a href="cart.php" class="btn btn-outline-light btn-sm" title="ตะกร้า">
                <i class="fas fa-shopping-cart"></i>
            </a>
            <a href="profile.php" class="btn btn-outline-light btn-sm" title="โปรไฟล์">
                <i class="fas fa-user-circle"></i>
            </a>
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="mb-5">
        <h1 class="display-4 fw-bold text-light mb-3">
            <i class="fas fa-history me-3 text-info"></i>ประวัติการเช่า
        </h1>
        <p class="lead text-secondary">ดูประวัติการเช่าหนังทั้งหมดของคุณ</p>
    </div>

    <?php if ($result->num_rows > 0): ?>
        <div class="row g-4">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card bg-secondary-subtle border-0 shadow-sm h-100">
                        <img src="<?php echo htmlspecialchars($row['movie_Path']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['movie_name']); ?>" style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?php echo htmlspecialchars($row['movie_name']); ?></h5>
                            <dl class="small">
                                <dt class="text-secondary">วันที่เริ่มเช่า:</dt>
                                <dd class="text-light"><?php echo date('d/m/Y', strtotime($row['date_start'])); ?></dd>

                                <dt class="text-secondary">วันที่คืน:</dt>
                                <dd class="text-light"><?php echo $row['date_return'] ? date('d/m/Y', strtotime($row['date_return'])) : 'ยังไม่คืน'; ?></dd>

                                <dt class="text-secondary">สถานะ:</dt>
                                <dd>
                                    <?php if ($row['rent_status'] === 'ยังไม่คืน'): ?>
                                        <span class="badge bg-warning text-dark">ยังไม่คืน</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">คืนแล้ว</span>
                                    <?php endif; ?>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center py-5" role="alert">
            <i class="fas fa-inbox" style="font-size: 3rem;"></i>
            <h4 class="mt-3">ไม่มีประวัติการเช่า</h4>
            <p class="text-secondary mb-0">คุณยังไม่เคยเช่าหนังมาก่อน</p>
        </div>
    <?php endif; ?>

    <div class="mt-5">
        <a href="index.php" class="btn btn-outline-light btn-lg">
            <i class="fas fa-arrow-left me-2"></i>กลับไปหน้าแรก
        </a>
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark border-top border-secondary py-4 text-center text-secondary mt-5">
    <div class="container">
        <p class="mb-0"><i class="fas fa-film me-2"></i>Movie Rental © 2026 | เช่าหนังง่าย สะดวกรวดเร็ว</p>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
