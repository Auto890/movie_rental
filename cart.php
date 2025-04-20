<?php
session_start();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ตะกร้าหนัง</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="cart-container">
    <h2>ตะกร้าหนัง</h2>

    <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
        <ul class="cart-list">
            <?php foreach ($_SESSION['cart'] as $movie_ID => $movie): ?>
                <li class="cart-item">
                    <span class="movie-name"><?php echo htmlspecialchars($movie['movie_name']); ?></span>
                    <span class="movie-price"><?php echo htmlspecialchars($movie['movie_price']); ?> บาท</span>
                    <a href="remove_from_cart.php?id=<?php echo urlencode($movie_ID); ?>" class="remove-btn">[ลบออก]</a>
                </li>
            <?php endforeach; ?>
        </ul>
        <a href="checkout.php" class="btn checkout-btn">✅ ยืนยันการเช่า</a>
    <?php else: ?>
        <p class="empty-cart">🛒 ยังไม่มีหนังในตะกร้า</p>
    <?php endif; ?>

    <div class="cart-links">
        <a href="movies.php" class="back-btn">⬅ กลับไปเลือกหนัง</a>
        <a href="index.php" class="back-btn">⬅ กลับไปหน้าหลัก</a>
    </div>
</div>

</body>
</html>
