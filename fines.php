<?php
session_start();
include 'db.php';

if (!isset($_SESSION['customer_ID'])) {
    // ถ้ายังไม่เข้าสู่ระบบ ให้ redirect ไปที่หน้าเข้าสู่ระบบ
    header("Location: login.php");
    exit();
}

$customer_ID = $_SESSION['customer_ID'];
$sql = "SELECT * FROM Fine WHERE customer_ID = $customer_ID";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ค่าปรับ</title>
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
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="mb-5">
                <h1 class="display-4 fw-bold text-light mb-3">
                    <i class="fas fa-exclamation-triangle me-3 text-danger"></i>ค่าปรับ
                </h1>
                <p class="lead text-secondary">ข้อมูลค่าปรับของคุณ</p>
            </div>

            <?php if ($result && $result->num_rows > 0): ?>
                <div class="row g-3">
                    <?php 
                    $totalFine = 0;
                    while ($row = $result->fetch_assoc()): 
                        $totalFine += $row['damage_price'];
                    ?>
                        <div class="col-12">
                            <div class="card bg-secondary-subtle border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold mb-3">
                                        <i class="fas fa-receipt me-2 text-warning"></i><?php echo htmlspecialchars($row['fine_type']); ?>
                                    </h5>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="text-secondary fw-bold">จำนวนเงิน:</label>
                                            <p class="fs-5 text-danger fw-bold"><?php echo number_format($row['damage_price'], 2); ?> บาท</p>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="text-secondary fw-bold">สถานะ:</label>
                                            <p>
                                                <?php if ($row['fine_status'] === 'ยังไม่จ่าย'): ?>
                                                    <span class="badge bg-warning text-dark fs-6">
                                                        <i class="fas fa-clock me-1"></i>ยังไม่จ่าย
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-success fs-6">
                                                        <i class="fas fa-check-circle me-1"></i>จ่ายแล้ว
                                                    </span>
                                                <?php endif; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

                <?php if ($totalFine > 0): ?>
                    <div class="card bg-danger-subtle border-0 shadow-sm mt-4">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold mb-2">
                                <i class="fas fa-calculator me-2"></i>รวมค่าปรับทั้งหมด
                            </h5>
                            <p class="display-6 fw-bold text-danger mb-0"><?php echo number_format($totalFine, 2); ?> บาท</p>
                        </div>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="alert alert-success text-center py-5" role="alert">
                    <i class="fas fa-check-circle" style="font-size: 3rem;"></i>
                    <h4 class="mt-3">ไม่มีค่าปรับ</h4>
                    <p class="text-secondary mb-0">ยินดีด้วย! คุณไม่มีค่าปรับที่ค้างชำระ</p>
                </div>
            <?php endif; ?>

            <div class="mt-5">
                <a href="index.php" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-arrow-left me-2"></i>กลับไปหน้าแรก
                </a>
            </div>
        </div>
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
