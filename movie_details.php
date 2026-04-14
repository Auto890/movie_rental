<?php
session_start();
include 'db.php';

// ตั้งค่าภาษาให้ MySQL รองรับ UTF-8
mysqli_set_charset($conn, "utf8mb4");
header("Content-Type: text/html; charset=UTF-8");

// รับค่า id และป้องกัน SQL Injection
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "SELECT movie.*, type_movie.type_name 
        FROM movie 
        JOIN type_movie ON movie.type_ID = type_movie.type_ID 
        WHERE movie.movie_ID = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$movie = $result->fetch_assoc();

// ตรวจสอบว่าพบข้อมูลหรือไม่
if (!$movie) {
    echo "<p class='error-msg'>❌ ไม่พบข้อมูลภาพยนตร์</p>";
    exit();
}

// เตรียมแปลง movievideo_Path
$videoPath = '';
if (!empty($movie['movievideo_Path'])) {
    // แปลงลิงก์จาก watch?v= เป็น embed/
    $videoPath = str_replace("watch?v=", "embed/", $movie['movievideo_Path']);
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($movie['movie_name']); ?> - รายละเอียดภาพยนตร์</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css?v=4">
</head>
<body class="bg-dark">

<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="index.php">
            <i class="fas fa-film me-2 text-accent"></i>เช่าภาพยนตร์
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
    <div class="row align-items-center">
        <div class="col-lg-8 mx-auto">
            <!-- Breadcrumb Navigation -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-info">หน้าแรก</a></li>
                    <li class="breadcrumb-item"><a href="movies.php" class="text-decoration-none text-info">รายการภาพยนตร์</a></li>
                    <li class="breadcrumb-item active text-light" aria-current="page"><?php echo htmlspecialchars($movie['movie_name']); ?></li>
                </ol>
            </nav>

            <div class="card border-0 shadow-lg mb-4 glass-card">
                <div class="card-body p-5">
                    <?php if (!empty($videoPath)) : ?>
                        <div class="ratio ratio-16x9 mb-5 rounded-4 overflow-hidden shadow-default" style="border: 2px solid rgba(255,255,255,0.1);">
                            <iframe src="<?php echo htmlspecialchars($videoPath); ?>"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning text-center mb-5 rounded-4 py-4" role="alert">
                            <i class="fas fa-video fa-2x mb-3 text-warning"></i>
                            <h5 class="mb-0">ไม่มีวิดีโอตัวอย่าง</h5>
                        </div>
                    <?php endif; ?>

                    <h1 class="display-4 fw-bold mb-4 text-light text-center">
                        <?php echo htmlspecialchars($movie['movie_name']); ?>
                    </h1>

                    <div class="info-box bg-dark p-4 rounded-4 mb-5 border border-secondary shadow-sm">
                        <div class="row g-4 text-center">
                            <div class="col-md-4 border-end border-secondary">
                                <label class="fw-bold text-white d-block mb-2">
                                    <i class="fas fa-tag me-2 text-success"></i>ราคาเช่า
                                </label>
                                <span class="fs-3 text-success fw-bold"><?php echo number_format($movie['movie_price'], 0); ?> ฿</span>
                            </div>

                            <div class="col-md-4 border-end border-secondary">
                                <label class="fw-bold text-white d-block mb-2">
                                    <i class="fas fa-film me-2 text-warning"></i>ประเภท
                                </label>
                                <span class="fs-4 text-light"><?php echo htmlspecialchars($movie['type_name']); ?></span>
                            </div>

                            <div class="col-md-4">
                                <label class="fw-bold text-white d-block mb-2">
                                    <i class="fas fa-calendar-alt me-2 text-info"></i>วันที่นำเข้า
                                </label>
                                <span class="fs-5 text-light"><?php echo date('d M Y', strtotime($movie['movie_import'])); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-md-row gap-3 justify-content-center mt-4">
                        <a href="add_to_cart.php?id=<?php echo $movie['movie_ID']; ?>" class="btn btn-primary px-5 py-3 fs-5 rounded-pill shadow">
                            <i class="fas fa-cart-plus me-2"></i>เพิ่มลงตะกร้า
                        </a>
                        <a href="movies.php" class="btn btn-outline-light px-5 py-3 fs-5 rounded-pill">
                            <i class="fas fa-arrow-left me-2"></i>กลับไปรายการหนัง
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark border-top border-secondary py-4 text-center text-muted mt-5 font-small">
    <div class="container">
        <p class="mb-0"><i class="fas fa-film me-2"></i>Movie Rental © 2026 | เช่าหนังง่าย สะดวกรวดเร็ว</p>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
