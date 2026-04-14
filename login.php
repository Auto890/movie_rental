<?php
session_start();
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css?v=3">
</head>
<body class="bg-dark d-flex align-items-center min-vh-100">

<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark position-fixed top-0 w-100" style="z-index: 1000;">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="index.php">
            <i class="fas fa-film me-2"></i>เช่าภาพยนตร์
        </a>
    </div>
</nav>

<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card bg-secondary-subtle border-0 shadow-lg">
                <div class="card-body p-5">
                    <h2 class="card-title text-center fw-bold mb-4 text-light">
                        <i class="fas fa-sign-in-alt me-2 text-primary "></i>เข้าสู่ระบบ
                    </h2>

                    <?php if (!empty($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i><?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($_SESSION['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i><?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <form action="login_action.php" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">
                                <i class="fas fa-envelope me-2"></i>อีเมล
                            </label>
                            <input type="email" class="form-control form-control-lg" name="email" placeholder="กรอกอีเมลของคุณ" required>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold">
                                <i class="fas fa-lock me-2"></i>รหัสผ่าน
                            </label>
                            <input type="password" class="form-control form-control-lg" name="password" placeholder="กรอกรหัสผ่าน" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold">
                            <i class="fas fa-sign-in-alt me-2"></i>เข้าสู่ระบบ
                        </button>
                    </form>

                    <hr class="my-4">

                    <p class="text-center mb-3">
                        ยังไม่มีบัญชี? <a href="register.php" class="text-primary fw-bold">สมัครสมาชิก</a>
                    </p>

                    <a href="index.php" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-arrow-left me-2"></i>กลับไปหน้าแรก
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
