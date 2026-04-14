<?php
session_start();
include 'db.php';

$sql = "SELECT * FROM movie";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการภาพยนตร์</title>
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
            <i class="fas fa-film me-3 text-primary"></i>รายการภาพยนตร์ทั้งหมด
        </h1>
        <p class="lead text-secondary">เลือกหนังที่คุณชอบและเพิ่มลงในตะกร้า</p>
    </div>

    <?php if (!empty($_SESSION['cart_message'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i><?php echo $_SESSION['cart_message']; unset($_SESSION['cart_message']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if ($result && $result->num_rows > 0): ?>
        <div class="row g-4">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="card h-100 border-0 shadow-sm bg-secondary-subtle hover-shadow" style="transition: transform 0.3s;">
                        <img src="<?php echo htmlspecialchars($row['movie_Path']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['movie_name']); ?>" style="height: 300px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold text-white"><?php echo htmlspecialchars($row['movie_name']); ?></h5>
                            <p class="card-text text-white flex-grow-1">
                                <small><?php echo isset($row['movie_year']) ? $row['movie_year'] : 'N/A'; ?></small>
                            </p>
                            <a href="movie_details.php?id=<?php echo $row['movie_ID']; ?>" class="btn btn-primary w-100 mt-auto">
                                <i class="fas fa-info-circle me-2"></i>ดูรายละเอียด
                            </a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-danger text-center py-5" role="alert">
            <i class="fas fa-exclamation-triangle me-2" style="font-size: 2rem;"></i>
            <h4 class="mt-3">ไม่พบรายการหนังในระบบ</h4>
        </div>
    <?php endif; ?>

    <div class="mt-5 text-center">
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
