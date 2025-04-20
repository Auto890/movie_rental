<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>หน้าแรก</title>
    <link rel="stylesheet" href="style.css?v=2">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- เพิ่ม Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

    <div class="navbar">
        <h1>เช่าภาพยนตร์</h1>
        <div class="top-right-buttons">
            <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
            <a href="profile.php"><i class="fas fa-user-circle"></i></a>
        </div>
    </div>

    <nav>
        <a href="movies.php"><button>รายการภาพยนตร์</button></a>
        <a href="login.php"><button>เข้าสู่ระบบ/สมัครสมาชิก</button></a>
        <!-- <a href="profile.php"><button>ข้อมูลส่วนตัว</button></a> -->
        <a href="rental_history.php"><button>ประวัติการเช่า</button></a>
        <a href="fines.php"><button>ค่าปรับ</button></a>
    </nav>

    <div class="swiper">
    <div class="swiper-wrapper">
        <!-- สไลด์ที่ 1 -->
        <div class="swiper-slide"><img src="photo/Blackpanther.jpg" alt="Slide 1"></div>
        <!-- สไลด์ที่ 2 -->
        <div class="swiper-slide"><img src="photo/dune.jpg" alt="Slide 2"></div>
        <!-- สไลด์ที่ 3 -->
        <div class="swiper-slide"><img src="photo/Endgame.jpg" alt="Slide 3"></div>
    </div>

    <!-- ปุ่มเลื่อนซ้ายขวา -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>

    <!-- จุดบอกตำแหน่งสไลด์ -->
    <div class="swiper-pagination"></div>
</div>

<script>
  var swiper = new Swiper('.swiper', {
    loop: true, // ให้สไลด์วนซ้ำ
    autoplay: { 
      delay: 3000, // เปลี่ยนสไลด์ทุก 3 วินาที
    },
    navigation: { 
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    pagination: { 
      el: '.swiper-pagination',
      clickable: true, 
    },
  });
</script>
<h2>ภาพยนตร์ยอดนิยม</h2>
    
    <table>
        <thead>
            <tr>
                <th>ภาพยนตร์</th>
                <th>ความนิยม</th>
                <th>ชื่อภาพยนตร์</th>
                <th>ราคาเช่า (บาท)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><img src="photo/Blackpanther.jpg" alt="Black Panther"></td>
                <td>Top 1</td>
                <td>Black Panther</td>
                <td>89</td>
            </tr>
            <tr>
                <td><img src="photo/dune.jpg" alt="Dune"></td>
                <td>Top 2</td>
                <td>Dune</td>
                <td>89</td>
            </tr>
            <tr>
                <td><img src="photo/Endgame.jpg" alt="Avengers: Endgame"></td>
                <td>Top 3</td>
                <td>Avengers: Endgame</td>
                <td>99</td>
            </tr>
        </tbody>
    </table>
</body>
</html>

<!-- สิ่งที่ต้องเพิ่ม
    1.ทำปุ่มเปลี่ยนสถานะการยืม
    2.ทำหน้าเพิ่มหนัง
    3.ปุ่ม Log out
    4.ตกตแต่งทั้งหมด
    5.ตัวอย่างหนังจากยูทูป
    6.ระบบการจอง
        -รวมเงิน รวมส่วนลด(จองจากเว็บลด 5%) 
        -ขึ้นหน้าจ่ายมัดจำ
    7.ขึ้นระยะเวลาการมาเอาหนัง
    8.เริ่มเช่า มีรายละเอียดลูกค้ากับหนัง ใส่ปุ่มเริ่มเวลาเช่า(เจ้าของร้าน)
    9.คืน มีรายละเอียดลูกค้ากับหนัง ใส่ปุ่มคืนเวลาเช่า(เจ้าของร้าน)
        -เลือกประเภทความเสีย แต่ละแผ่นหนัง
        -รวมค่าความเสียหาย
-->