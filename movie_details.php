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
    <title><?php echo htmlspecialchars($movie['movie_name']); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="movie-container">
    <div class="movie-card">

        <?php if (!empty($videoPath)) : ?>
            <iframe width="560" height="315" src="<?php echo htmlspecialchars($videoPath); ?>"
            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
        <?php else: ?>
            <p>🎬 ไม่มีวิดีโอตัวอย่าง</p>
        <?php endif; ?>

        <h1><?php echo htmlspecialchars($movie['movie_name']); ?></h1>
        <p><strong>💰 ราคา:</strong> <?php echo htmlspecialchars($movie['movie_price']); ?> บาท</p>
        <p><strong>📅 วันนำเข้า:</strong> <?php echo htmlspecialchars($movie['movie_import']); ?></p>
        <p><strong>🎭 ประเภท:</strong> <?php echo htmlspecialchars($movie['type_name']); ?></p>

        <!-- ปุ่มเพิ่มลงตะกร้า -->
        <form action="cart.php" method="post">
            <input type="hidden" name="movie_ID" value="<?php echo $movie['movie_ID']; ?>">
            <input type="hidden" name="movie_name" value="<?php echo $movie['movie_name']; ?>">
            <input type="hidden" name="movie_price" value="<?php echo $movie['movie_price']; ?>">
            
            <a href="add_to_cart.php?id=<?php echo $movie['movie_ID']; ?>" class="btn add-to-cart">🛒 เพิ่มลงตะกร้า</a>
        </form>

        <a href="movies.php" class="btn back-btn">⬅️ กลับไปหน้ารายการหนัง</a>
    </div>
</div>

</body>
</html>
