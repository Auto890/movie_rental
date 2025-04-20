<?php
$servername = "localhost";
$username = "root"; // ชื่อผู้ใช้ฐานข้อมูล
$password = "123456"; // รหัสผ่าน
$dbname = "movie_rental"; // ชื่อฐานข้อมูล

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// เช็คการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
