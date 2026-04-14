<?php
session_start(); // เริ่มต้นเซสชัน
include 'db.php'; // เชื่อมต่อกับฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // ป้องกัน SQL Injection โดยใช้ Prepared Statements
    $sql = "SELECT * FROM customers WHERE customer_email = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        $_SESSION['error'] = "เกิดข้อผิดพลาดของระบบ กรุณาลองใหม่อีกครั้ง";
        header("Location: login.php");
        exit();
    }

    $stmt->bind_param("s", $email); // ใช้ s สำหรับ string (email)
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        // พบข้อมูลลูกค้า
        $row = $result->fetch_assoc();
        
        // ตรวจสอบรหัสผ่านที่แฮชแล้ว
        if (password_verify($password, $row['customer_password'])) {
            // เก็บข้อมูลลูกค้าในเซสชัน
            $_SESSION['customer_ID'] = $row['customer_ID'];
            
            // ถ้าเป็น admin
            if ($row['customer_email'] === 'admin@example.com') {
                header("Location: index_Admin.php");
                exit();
            } else {
                header("Location: index.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "รหัสผ่านไม่ถูกต้อง";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "ไม่พบผู้ใช้ด้วยอีเมลนี้";
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>
