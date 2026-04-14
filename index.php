<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแรก - เช่าหนัง</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css?v=3">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="index.php">
                <i class="fas fa-film me-2"></i>เช่าภาพยนตร์
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

    <!-- Navigation Menu -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-secondary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="movies.php"><i class="fas fa-film me-2"></i>รายการภาพยนตร์</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php"><i
                                class="fas fa-sign-in-alt me-2"></i>เข้าสู่ระบบ/สมัครสมาชิก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rental_history.php"><i
                                class="fas fa-history me-2"></i>ประวัติการเช่า</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="fines.php"><i class="fas fa-exclamation-circle me-2"></i>ค่าปรับ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Hero Section -->
    <section class="hero-section py-5 text-center text-light"
        style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);">
        <div class="container py-5">
            <span class="badge bg-info mb-3">🎬 เช่าหนังช่องทางใหม่</span>
            <h1 class="display-4 fw-bold mb-3">หนังดี คุณภาพสูง พร้อมให้คุณเช่าได้ทันที</h1>
            <p class="lead mb-4">ค้นหารายการหนังฮิต ทั้งแอ็คชัน โรแมนซ์ และผจญภัย พร้อมราคาเช่าสุดคุ้ม</p>
            <div class="gap-3 d-flex justify-content-center flex-wrap">
                <a class="btn btn-primary btn-lg" href="movies.php">
                    <i class="fas fa-film me-2"></i>ดูหนังทั้งหมด
                </a>
                <a class="btn btn-outline-light btn-lg" href="login.php">
                    <i class="fas fa-sign-in-alt me-2"></i>เข้าสู่ระบบ
                </a>
            </div>
        </div>
    </section>

    <!-- Slider Section -->
    <section class="py-5 bg-dark">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="display-5 fw-bold text-light">🎥 หนังแนะนำวันนี้</h2>
                <p class="text-secondary">เลือกชมตัวอย่างหนังใหม่ล่าสุดจากคอลเลกชันของเรา</p>
            </div>
            <div class="swiper" style="max-width: 800px; margin: 0 auto;">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="photo/Blackpanther.jpg" alt="Black Panther"
                            class="img-fluid rounded"></div>
                    <div class="swiper-slide"><img src="photo/dune.jpg" alt="Dune" class="img-fluid rounded"></div>
                    <div class="swiper-slide"><img src="photo/Endgame.jpg" alt="Avengers: Endgame"
                            class="img-fluid rounded"></div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- Popular Movies Section -->
    <section class="py-5 bg-dark border-top border-secondary">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold text-light">⭐ ภาพยนตร์ยอดนิยม</h2>
                <p class="text-secondary">หนังที่คนดูเลือกเช่าบ่อยที่สุดจากร้านของเรา</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card bg-secondary-subtle border-0 h-100 shadow-sm">
                        <img src="photo/Blackpanther.jpg" class="card-img-top" alt="Black Panther">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-light">Black Panther</h5>
                            <p class="card-text text-secondary">🏆 Top 1 / ราคาเช่า <span
                                    class="fw-bold text-success">89 บาท</span></p>
                            <a href="movie_details.php?id=1" class="btn btn-primary w-100">
                                <i class="fas fa-info-circle me-2"></i>ดูรายละเอียด
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card bg-secondary-subtle border-0 h-100 shadow-sm">
                        <img src="photo/dune.jpg" class="card-img-top" alt="Dune">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-light">Dune</h5>
                            <p class="card-text text-secondary">🏆 Top 2 / ราคาเช่า <span
                                    class="fw-bold text-success">89 บาท</span></p>
                            <a href="movie_details.php?id=2" class="btn btn-primary w-100">
                                <i class="fas fa-info-circle me-2"></i>ดูรายละเอียด
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card bg-secondary-subtle border-0 h-100 shadow-sm">
                        <img src="photo/Endgame.jpg" class="card-img-top" alt="Avengers: Endgame">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-light">Avengers: Endgame</h5>
                            <p class="card-text text-secondary">🏆 Top 3 / ราคาเช่า <span
                                    class="fw-bold text-warning">99 บาท</span></p>
                            <a href="movie_details.php?id=3" class="btn btn-primary w-100">
                                <i class="fas fa-info-circle me-2"></i>ดูรายละเอียด
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark border-top border-secondary py-4 text-center text-secondary">
        <div class="container">
            <p class="mb-0"><i class="fas fa-film me-2"></i>Movie Rental © 2026 | เช่าหนังง่าย สะดวกรวดเร็ว</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper', {
            loop: true,
            autoplay: { delay: 3000 },
            navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
            pagination: { el: '.swiper-pagination', clickable: true }
        });
    </script>
</body>

</html>
