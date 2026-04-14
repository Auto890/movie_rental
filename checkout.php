<?php
session_start();
include 'db.php';

if (!isset($_SESSION['customer_ID'])) {
    header("Location: login.php");
    exit();
}

$customer_ID = $_SESSION['customer_ID'];
$message = '';
$messageClass = 'success';

if (!empty($_SESSION['cart'])) {
    $rent_sql = "INSERT INTO rent (customer_ID, movie_ID, date_start, rent_status) VALUES (?, ?, NOW(), 'ยังไม่คืน')";
    $stmt = $conn->prepare($rent_sql);

    if ($stmt) {
        foreach ($_SESSION['cart'] as $movie_ID => $movie) {
            $stmt->bind_param("ii", $customer_ID, $movie_ID);
            $stmt->execute();
        }
        unset($_SESSION['cart']);
        $message = "✅ เช่าสำเร็จแล้ว! ระบบได้บันทึกการเช่าให้เรียบร้อยแล้ว";
    } else {
        $messageClass = 'error';
        $message = "เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่อีกครั้ง";
    }
} else {
    $messageClass = 'error';
    $message = "ไม่มีหนังในตะกร้า กรุณาเลือกหนังก่อนยืนยันการเช่า";
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เช่าหนัง</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ยืนยันการเช่า</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css?v=3">
</head>
<body class="bg-dark d-flex align-items-center min-vh-100">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card bg-secondary-subtle border-0 shadow-lg">
                <div class="card-body p-5 text-center">
                    <?php if ($messageClass === 'success'): ?>
                        <div class="mb-4">
                            <i class="fas fa-check-circle" style="font-size: 4rem; color: #28a745;"></i>
                        </div>
                        <h2 class="card-title fw-bold mb-3 text-success">เช่าสำเร็จแล้ว!</h2>
                    <?php else: ?>
                        <div class="mb-4">
                            <i class="fas fa-exclamation-triangle" style="font-size: 4rem; color: #dc3545;"></i>
                        </div>
                        <h2 class="card-title fw-bold mb-3 text-danger">มีข้อผิดพลาด</h2>
                    <?php endif; ?>

                    <div class="alert <?php echo $messageClass === 'success' ? 'alert-success' : 'alert-danger'; ?> mb-4">
                        <p class="mb-0"><?php echo $message; ?></p>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="index.php" class="btn btn-primary btn-lg fw-bold">
                            <i class="fas fa-home me-2"></i>กลับไปหน้าแรก
                        </a>
                        <a href="movies.php" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-film me-2"></i>เลือกหนังเพิ่มเติม
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
</body>
</html>
