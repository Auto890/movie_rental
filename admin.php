<?php
include 'db.php';

// ตรวจสอบว่าเป็นผู้ดูแลระบบ
// เพิ่มการตรวจสอบการเข้าสู่ระบบสำหรับผู้ดูแลระบบที่นี่
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>จัดการระบบ</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>จัดการระบบ</h1>
    <h2>รายการหนัง</h2>
    <a href="add_movie.php">เพิ่มหนังใหม่</a>
    <h2>รายการลูกค้า</h2>
    <a href="customer_list.php">ดูรายการลูกค้า</a>
    <a href="index_admin.php">กลับไปหน้า Admin</a>
</body>
</html>
