<?php
session_start();
include 'db.php';

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
if (!isset($_SESSION['customer_ID'])) {
    header("Location: login.php");
    exit();
}

$customer_ID = $_SESSION['customer_ID'];

if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $movie_ID => $movie) {
        $sql = "INSERT INTO rent (customer_ID, movie_ID, date_start, rent_status) VALUES (?, ?, NOW(), 'ยังไม่คืน')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $customer_ID, $movie_ID);
        $stmt->execute();
    }

    // เคลียร์ตะกร้าหลังจากเช่าเสร็จ
    unset($_SESSION['cart']);

    echo "เช่าสำเร็จ! <a href='index.php'>กลับไปหน้าหลัก</a>";
} else {
    echo "ไม่มีหนังในตะกร้า";
}
?>
