<?php
session_start();
include 'db.php'; // เชื่อมต่อฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_ID = trim($_POST["customer_ID"]);
    $customer_fname = trim($_POST["customer_fname"]);
    $customer_lname = trim($_POST["customer_lname"]);
    $customer_email = trim($_POST["customer_email"]);
    $customer_password = $_POST["customer_password"];
    $confirm_password = $_POST["confirm_password"];
    $phone_num = trim($_POST["phone_num"]);

    // ตรวจสอบว่ารหัสผ่านตรงกันไหม
    if ($customer_password !== $confirm_password) {
        $_SESSION["error"] = "รหัสผ่านไม่ตรงกัน";
        header("Location: register.php");
        exit();
    }

    // ✅ Hash เฉพาะ password
    $hashed_customer_password = password_hash($customer_password, PASSWORD_DEFAULT);
    

    // ตรวจสอบว่า customer_ID หรือ Email ซ้ำกันหรือไม่
    $check_sql = "SELECT * FROM customers WHERE customer_ID = ? OR customer_email = ?";
    $check_stmt = $conn->prepare($check_sql);
    if (!$check_stmt) {
        die("เกิดข้อผิดพลาดใน SQL: " . $conn->error);
    }
    
    $check_stmt->bind_param("ss", $customer_ID, $customer_email);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION["error"] = "รหัสบัตรประชาชนหรืออีเมลนี้ถูกใช้งานแล้ว";
        header("Location: register.php");
        exit();
    }

    $check_stmt->close();

    // ✅ ใช้ชื่อคอลัมน์ให้ตรงกับฐานข้อมูล
    $sql = "INSERT INTO customers (customer_ID, customer_fname, customer_lname, customer_password, phone_num, customer_email) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        die("เกิดข้อผิดพลาดใน SQL: " . $conn->error);
    }

    // ✅ แก้ให้ Hash เฉพาะ password
    $stmt->bind_param("ssssss", $customer_ID, $customer_fname, $customer_lname, $hashed_customer_password, $phone_num, $customer_email);

    // บันทึกข้อมูล
    if ($stmt->execute()) {
        $_SESSION["success"] = "สมัครสมาชิกสำเร็จ! กรุณาเข้าสู่ระบบ";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION["error"] = "เกิดข้อผิดพลาด: " . $stmt->error;
        header("Location: register.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก - เช่าภาพยนตร์</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css?v=5">
</head>
<body class="bg-dark d-flex align-items-center min-vh-100 position-relative" style="padding-top: 80px;">

<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark position-fixed top-0 w-100" style="z-index: 1000;">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="index.php">
            <i class="fas fa-film me-2 text-accent"></i>เช่าภาพยนตร์
        </a>
    </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">
            <div class="card border-0 shadow-lg glass-card rounded-4">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-user-plus fa-3x text-accent"></i>
                        </div>
                        <h2 class="fw-bold text-light">สร้างบัญชีใหม่</h2>
                        <p class="text-light">เข้าร่วมกับเราเพื่อเช่าภาพยนตร์ที่คุณชื่นชอบ</p>
                    </div>

                    <?php if (!empty($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 py-3" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i><?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($_SESSION['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show rounded-3 border-0 py-3" role="alert">
                            <i class="fas fa-check-circle me-2"></i><?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <form action="register.php" method="POST">
                        <div class="mb-4">
                            <label for="customer_ID" class="form-label text-light fw-bold">
                                <i class="fas fa-id-card me-2 text-light"></i>รหัสบัตรประชาชน (13 หลัก)
                            </label>
                            <input type="text" class="form-control form-control-lg bg-dark text-light border-secondary" name="customer_ID" placeholder="เช่น 1234567890123" required>
                        </div>

                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label for="customer_fname" class="form-label text-light fw-bold">
                                    <i class="fas fa-user me-2 text-light"></i>ชื่อ
                                </label>
                                <input type="text" class="form-control form-control-lg bg-dark text-light border-secondary" name="customer_fname" placeholder="ชื่อจริง" required>
                            </div>

                            <div class="col-md-6">
                                <label for="customer_lname" class="form-label text-light fw-bold">
                                    <i class="fas fa-user me-2 text-light"></i>นามสกุล
                                </label>
                                <input type="text" class="form-control form-control-lg bg-dark text-light border-secondary" name="customer_lname" placeholder="นามสกุล" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="customer_email" class="form-label text-light fw-bold">
                                <i class="fas fa-envelope me-2 text-light"></i>อีเมล
                            </label>
                            <input type="email" class="form-control form-control-lg bg-dark text-light border-secondary" name="customer_email" placeholder="example@email.com" required>
                        </div>

                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label for="customer_password" class="form-label text-light fw-bold">
                                    <i class="fas fa-lock me-2 text-light"></i>รหัสผ่าน
                                </label>
                                <input type="password" class="form-control form-control-lg bg-dark text-light border-secondary" name="customer_password" required minlength="8" placeholder="อย่างน้อย 8 ตัวอักษร">
                            </div>

                            <div class="col-md-6">
                                <label for="confirm_password" class="form-label text-light fw-bold">
                                    <i class="fas fa-lock me-2 text-light"></i>ยืนยันรหัสผ่าน
                                </label>
                                <input type="password" class="form-control form-control-lg bg-dark text-light border-secondary" name="confirm_password" required minlength="8" placeholder="ยืนยันรหัสผ่านอีกครั้ง">
                            </div>
                        </div>

                        <div class="mb-5">
                            <label for="phone_num" class="form-label text-light fw-bold">
                                <i class="fas fa-phone-alt me-2 text-light"></i>เบอร์โทรศัพท์
                            </label>
                            <input type="text" class="form-control form-control-lg bg-dark text-light border-secondary" name="phone_num" placeholder="เช่น 0812345678" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill fw-bold shadow mb-4 py-3">
                            <i class="fas fa-user-plus me-2"></i>สร้างบัญชี
                        </button>
                    </form>

                    <div class="text-center border-top border-secondary pt-4 mt-2">
                        <p class="text-light mb-3">
                            มีบัญชีผู้ใช้อยู่แล้ว? <a href="login.php" class="text-accent text-decoration-none fw-bold">เข้าสู่ระบบที่นี่</a>
                        </p>
                        <a href="index.php" class="btn btn-outline-light rounded-pill px-4">
                            <i class="fas fa-home me-2"></i>กลับหน้าหลัก
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>