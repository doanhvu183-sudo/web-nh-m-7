<?php
require_once __DIR__ . '/../giao_dien/header.php';
require_once __DIR__ . '/../cau_hinh/ket_noi.php';
require_once __DIR__ . '/../cau_hinh/ham.php';

// sản phẩm mới
$san_pham_moi = $pdo->query("SELECT * FROM SANPHAM ORDER BY id_san_pham DESC LIMIT 12")->fetchAll();

// sản phẩm gợi ý
$san_pham_goi_y = $pdo->query("SELECT * FROM SANPHAM ORDER BY RAND() LIMIT 12")->fetchAll();
?>

<link rel="stylesheet" href="../assets/css/home.css">

<!-- BANNER HERO -->
<section class="hero-slider">
    <div class="slider-wrapper">
        <div class="slide active">
            <img src="../assets/img/hero_crocs1.jpg" alt="">
            <div class="slide-content">
                <h1>Crocs Classic</h1>
                <p>Kiểu dáng biểu tượng, thoải mái cho mọi ngày.</p>
            </div>
        </div>
        <div class="slide">
            <img src="../assets/img/hero_crocs2.jpg" alt="">
            <div class="slide-content">
                <h1>Bộ sưu tập 2025</h1>
                <p>Màu sắc mới, phong cách mới, vẫn êm như cũ.</p>
            </div>
        </div>
        <div class="slide">
            <img src="../assets/img/hero_crocs3.jpg" alt="">
            <div class="slide-content">
                <h1>Kids & Family</h1>
                <p>Cả nhà cùng Crocs – nhẹ, bền, dễ vệ sinh.</p>
            </div>
        </div>

        <button class="slide-btn prev">&lt;</button>
        <button class="slide-btn next">&gt;</button>
    </div>
</section>
<script src="../assets/js/slider.js"></script>


<!-- DANH MỤC NỔI BẬT -->
<section class="category">
    <h2 class="section-title">Danh mục nổi bật</h2>

    <div class="category-list">

        <a href="danh_muc.php?id_danh_muc=1" class="category-card">
            <img src="../assets/img/banner_men.jpg">
            <div class="overlay">Nam</div>
        </a>

        <a href="danh_muc.php?id_danh_muc=2" class="category-card">
            <img src="../assets/img/banner_women.jpg">
            <div class="overlay">Nữ</div>
        </a>

        <a href="danh_muc.php?id_danh_muc=3" class="category-card">
            <img src="../assets/img/banner_kids.jpg">
            <div class="overlay">Trẻ em</div>
        </a>

        <a href="danh_muc.php?id_danh_muc=4" class="category-card">
            <img src="../assets/img/banner_sandals.jpg">
            <div class="overlay">Sandals & Jibbitz™</div>
        </a>

    </div>
</section>

<!-- HÀNG MỚI VỀ -->
<section class="product-section">
    <div class="section-header">
        <h2>Hàng mới về</h2>
        <a href="danh_muc.php">Xem tất cả</a>
    </div>

    <div class="product-grid">
        <?php foreach ($san_pham_moi as $sp): ?>
            <div class="product-card">
                <a href="chi_tiet_san_pham.php?id=<?= $sp['id_san_pham'] ?>">
                    <img src="../assets/img/<?= $sp['hinh_anh'] ?>" class="product-img">
                    <h3><?= $sp['ten_san_pham'] ?></h3>
                    <div class="price"><?= dinh_dang_gia($sp['gia']) ?></div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- GỢI Ý CHO BẠN -->
<section class="product-section">
    <div class="section-header">
        <h2>Gợi ý cho bạn</h2>
        <a href="danh_muc.php">Khám phá thêm</a>
    </div>

    <div class="product-grid">
        <?php foreach ($san_pham_goi_y as $sp): ?>
            <div class="product-card">
                <a href="chi_tiet_san_pham.php?id=<?= $sp['id_san_pham'] ?>">
                    <img src="../assets/img/<?= $sp['hinh_anh'] ?>" class="product-img">
                    <h3><?= $sp['ten_san_pham'] ?></h3>
                    <div class="price"><?= dinh_dang_gia($sp['gia']) ?></div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once __DIR__ . '/../giao_dien/footer.php'; ?>
