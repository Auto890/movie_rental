<?php
session_start();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตะกร้าหนัง</title>
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
            <a href="cart.php" class="btn btn-outline-light btn-sm active" title="ตะกร้า">
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
            <div class="mb-4">
                <h1 class="display-5 fw-bold text-light">
                    <i class="fas fa-shopping-cart me-3 text-warning"></i>ตะกร้าหนัง
                </h1>
            </div>

            <?php if (!empty($_SESSION['cart'])): ?>
                <div class="card bg-secondary-subtle border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <?php 
                            $total = 0;
                            foreach ($_SESSION['cart'] as $movie_ID => $movie): 
                                $total += $movie['movie_price'];
                            ?>
                                <li class="list-group-item bg-secondary-subtle border-secondary d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong><?php echo htmlspecialchars($movie['movie_name']); ?></strong>
                                    </div>
                                    <div class="d-flex gap-3 align-items-center">
                                        <span class="fw-bold text-success"><?php echo number_format($movie['movie_price'], 0); ?> ฿</span>
                                        <a href="remove_from_cart.php?id=<?php echo $movie_ID; ?>" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> ลบ
                                        </a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="border-top border-secondary pt-3 mt-3">
                            <div class="d-flex justify-content-between align-items-center fs-5">
                                <span class="fw-bold">รวมทั้งหมด:</span>
                                <span class="fw-bold text-success"><?php echo number_format($total, 0); ?> ฿</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 mb-4">
                    <a href="checkout.php" class="btn btn-success btn-lg fw-bold">
                        <i class="fas fa-check-circle me-2"></i>ยืนยันการเช่า
                    </a>
                </div>
            <?php else: ?>
                <div class="alert alert-info text-center py-5" role="alert">
                    <i class="fas fa-shopping-cart" style="font-size: 3rem;"></i>
                    <h4 class="mt-3">ยังไม่มีหนังในตะกร้า</h4>
                    <p class="text-secondary mb-0">ไปเลือกหนังที่คุณชอบกันเถอะ</p>
                </div>
            <?php endif; ?>

            <div class="row gap-3">
                <div class="col-6">
                    <a href="movies.php" class="btn btn-outline-light w-100 btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>เลือกหนังเพิ่ม
                    </a>
                </div>
                <div class="col-6">
                    <a href="index.php" class="btn btn-outline-light w-100 btn-lg">
                        <i class="fas fa-home me-2"></i>หน้าแรก
                    </a>
                </div>
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
