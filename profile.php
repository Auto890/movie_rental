<?php
session_start(); 

if (!isset($_SESSION['customer_ID'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$customer_ID = $_SESSION['customer_ID'];
$sql = "SELECT * FROM customers WHERE customer_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $customer_ID);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Query failed: " . $conn->error);
}

$customer = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ข้อมูลส่วนตัว</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลส่วนตัว</title>
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
            <a href="profile.php" class="btn btn-outline-light btn-sm active" title="โปรไฟล์">
                <i class="fas fa-user-circle"></i>
            </a>
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card bg-secondary-subtle border-0 shadow-lg">
                <div class="card-body p-5">
                    <h2 class="card-title text-center fw-bold mb-4">
                        <i class="fas fa-user-circle me-2 text-info"></i>ข้อมูลส่วนตัว
                    </h2>

                    <div class="info-group mb-4 p-4 bg-dark rounded">
                        <div class="mb-3">
                            <label class="fw-bold text-secondary">
                                <i class="fas fa-user me-2"></i>ชื่อ - นามสกุล
                            </label>
                            <p class="text-light"><?php echo $customer['customer_fname'] . ' ' . $customer['customer_lname']; ?></p>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold text-secondary">
                                <i class="fas fa-envelope me-2"></i>อีเมล
                            </label>
                            <p class="text-light"><?php echo $customer['customer_email']; ?></p>
                        </div>

                        <div class="mb-0">
                            <label class="fw-bold text-secondary">
                                <i class="fas fa-phone me-2"></i>เบอร์โทรศัพท์
                            </label>
                            <p class="text-light"><?php echo $customer['phone_num']; ?></p>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="index.php" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-home me-2"></i>กลับไปหน้าแรก
                        </a>
                        <a href="logout.php" class="btn btn-danger btn-lg">
                            <i class="fas fa-sign-out-alt me-2"></i>ออกจากระบบ
                        </a>
                    </div>
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
