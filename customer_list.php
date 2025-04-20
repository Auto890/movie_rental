<?php
session_start(); // เริ่มต้นเซสชัน
include 'db.php'; // เชื่อมต่อกับฐานข้อมูล

// ดึงข้อมูลลูกค้าจากฐานข้อมูล
$sql = "SELECT * FROM customers"; // เปลี่ยนเป็นคำสั่ง SQL ที่ต้องการ
$result = $conn->query($sql);

// เช็คว่าการดึงข้อมูลสำเร็จหรือไม่
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายการลูกค้า</title>
    <link rel="stylesheet" href="style.css"> <!-- เชื่อมโยงกับไฟล์ CSS -->
</head>
<body>
    <h1>รายการลูกค้า</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID ลูกค้า</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>อีเมล</th>
                <th>เบอร์โทร</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['customer_ID']; ?></td>
                    <td><?php echo $row['customer_fname']; ?></td>
                    <td><?php echo $row['customer_lname']; ?></td>
                    <td><?php echo $row['customer_email']; ?></td>
                    <td><?php echo $row['phone_num']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="index_admin.php">กลับไปหน้าแรก</a> <!-- ลิงก์กลับไปยังหน้า admin -->
</body>
</html>
