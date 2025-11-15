<?php
require_once __DIR__ . '/../giao_dien/header.php';

// lấy 10 sản phẩm mới nhất
$san_pham_moi = $pdo->query("SELECT * FROM SANPHAM ORDER BY id_san_pham DESC LIMIT 10")->fetchAll();

// lấy 10 sản phẩm bất kỳ làm "Gợi ý cho bạn"
$san_pham_goi_y = $pdo->query("SELECT * FROM SANPHAM ORDER BY RAND() LIMIT 10")->fetchAll();
?>

<!-- HERO -->
<section class="hero-section">
    <div class="hero-image">
        <img src="../assets/img/hero_crocs.jpg" alt="Crocs bộ sưu tập mới">
    </div>
    <div class="hero-content">
        <h1>Bộ sưu tập Crocs 2025</h1>
        <p>Thoải mái, cá tính và phù hợp với mọi phong cách. Khám phá ngay những mẫu Crocs mới nhất.</p>
        <a href="danh_muc.php" class="btn btn-primary">Mua ngay</a>
    </div>
</section>

<!-- DANH MỤC LỚN -->
<section class="category-section">
    <div class="category-grid">
        <div class="category-item">
            <img src="../assets/img/banner_women.jpg" alt="Crocs nữ">
            <div class="category-overlay">
                <h2>Nữ</h2>
                <a href="danh_muc.php?id_danh_muc=2">Xem bộ sưu tập</a>
            </div>
        </div>
        <div class="category-item">
            <img src="../assets/img/banner_men.jpg" alt="Crocs nam">
            <div class="category-overlay">
                <h2>Nam</h2>
                <a href="danh_muc.php?id_danh_muc=1">Xem bộ sưu tập</a>
            </div>
        </div>
        <div class="category-item">
            <img src="../assets/img/banner_kids.jpg" alt="Trẻ em">
            <div class="category-overlay">
                <h2>Trẻ em</h2>
                <a href="danh_muc.php?id_danh_muc=3">Xem ngay</a>
            </div>
        </div>
        <div class="category-item">
            <img src="../assets/img/banner_sandals.jpg" alt="Sandals & Jibbitz">
            <div class="category-overlay">
                <h2>Sandals & Jibbitz™</h2>
                <a href="danh_muc.php?id_danh_muc=3">Khám phá</a>
            </div>
        </div>
    </div>
</section>

<!-- SECTION HÀNG MỚI VỀ -->
<section class="section-sanpham">
    <div class="section-header">
        <h2>Hàng mới về</h2>
        <a href="danh_muc.php">Xem tất cả</a>
    </div>
    <div class="product-grid">
        <?php foreach ($san_pham_moi as $sp): ?>
            <div class="product-item">
                <img src="../assets/img/<?= htmlspecialchars($sp['hinh_anh']) ?>" 
                     alt="<?= htmlspecialchars($sp['ten_san_pham']) ?>">
                <h3><?= htmlspecialchars($sp['ten_san_pham']) ?></h3>
                <div class="price"><?= dinh_dang_gia($sp['gia']) ?></div>
                <a href="chi_tiet_san_pham.php?id=<?= $sp['id_san_pham'] ?>" class="btn btn-outline">
                    Xem chi tiết
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- SECTION GỢI Ý CHO BẠN -->
<section class="section-sanpham">
    <div class="section-header">
        <h2>Gợi ý cho bạn</h2>
        <a href="danh_muc.php">Khám phá thêm</a>
    </div>
    <div class="product-grid">
        <?php foreach ($san_pham_goi_y as $sp): ?>
            <div class="product-item">
                <img src="../assets/img/<?= htmlspecialchars($sp['hinh_anh']) ?>" 
                     alt="<?= htmlspecialchars($sp['ten_san_pham']) ?>">
                <h3><?= htmlspecialchars($sp['ten_san_pham']) ?></h3>
                <div class="price"><?= dinh_dang_gia($sp['gia']) ?></div>
                <a href="chi_tiet_san_pham.php?id=<?= $sp['id_san_pham'] ?>" class="btn btn-outline">
                    Xem chi tiết
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once __DIR__ . '/../giao_dien/footer.php'; ?>
