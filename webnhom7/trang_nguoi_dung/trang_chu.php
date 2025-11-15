<?php
// trang_nguoi_dung/trang_chu.php
require_once __DIR__ . '/../giao_dien/header.php';

// Lấy 8 sản phẩm mới
$san_pham_moi = lay_san_pham_moi($pdo, 8);

// Lấy tất cả danh mục để show block danh mục lớn (Nam, Nữ, Trẻ em, Phụ kiện)
$danhmuc_list = lay_tat_ca_danh_muc($pdo);
?>

<!-- HERO BANNER LỚN -->
<section class="hero-section">
    <div class="hero-image">
        <img src="../assets/img/hero_crocs.jpg" alt="Crocs mới nhất 2025">
    </div>
    <div class="hero-content">
        <h1>Bộ sưu tập Crocs 2025</h1>
        <p>Thoải mái, cá tính và phù hợp với mọi phong cách. Khám phá ngay những đôi Crocs mới nhất dành cho bạn.</p>
        <a href="danh_muc.php" class="btn btn-primary">Mua ngay</a>
    </div>
</section>

<!-- BLOCK DANH MỤC (NỮ / NAM / TRẺ EM / SANDALS) -->
<section class="category-section">
    <div class="category-grid">
        <div class="category-item">
            <img src="../assets/img/banner_women.jpg" alt="Crocs nữ">
            <div class="category-overlay">
                <h2>Nữ</h2>
                <a href="danh_muc.php">Xem bộ sưu tập</a>
            </div>
        </div>
        <div class="category-item">
            <img src="../assets/img/banner_men.jpg" alt="Crocs nam">
            <div class="category-overlay">
                <h2>Nam</h2>
                <a href="danh_muc.php">Xem bộ sưu tập</a>
            </div>
        </div>
        <div class="category-item">
            <img src="../assets/img/banner_kids.jpg" alt="Crocs trẻ em">
            <div class="category-overlay">
                <h2>Trẻ em</h2>
                <a href="danh_muc.php">Xem ngay</a>
            </div>
        </div>
        <div class="category-item">
            <img src="../assets/img/banner_sandals.jpg" alt="Sandals & Jibbitz">
            <div class="category-overlay">
                <h2>Sandals & Jibbitz™</h2>
                <a href="danh_muc.php">Khám phá</a>
            </div>
        </div>
    </div>
</section>

<!-- HÀNG MỚI VỀ -->
<section class="section-sanpham home-section">
    <div class="section-header">
        <h2>Hàng mới về</h2>
        <a href="danh_muc.php">Xem tất cả</a>
    </div>
    <div class="product-grid">
        <?php foreach ($san_pham_moi as $sp): ?>
            <div class="product-item">
                <div class="product-tag">New</div>
                <img src="../assets/img/<?= htmlspecialchars($sp['hinh_anh']) ?>"
                     alt="<?= htmlspecialchars($sp['ten_san_pham']) ?>">
                <h3><?= htmlspecialchars($sp['ten_san_pham']) ?></h3>
                <div class="price"><?= dinh_dang_gia($sp['gia']) ?></div>
                <a class="btn" href="chi_tiet_san_pham.php?id=<?= $sp['id_san_pham'] ?>">Xem chi tiết</a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- BLOCK ƯU ĐÃI (FAKE SALE CHO ĐẸP GIỐNG CROCS) -->
<section class="sale-banner">
    <div class="sale-content">
        <h2>Ưu đãi đến 50%</h2>
        <p>Chọn ngay những mẫu Crocs được yêu thích nhất với mức giá tốt hơn.</p>
        <a href="danh_muc.php" class="btn btn-outline">Xem ưu đãi</a>
    </div>
</section>

<!-- LỢI ÍCH - ICON (Ship, đổi trả, chính hãng) -->
<section class="benefit-section">
    <div class="benefit-grid">
        <div class="benefit-item">
            <h3>Giao hàng nhanh</h3>
            <p>Miễn phí giao hàng cho đơn từ 500.000đ.</p>
        </div>
        <div class="benefit-item">
            <h3>Đổi trả dễ dàng</h3>
            <p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi.</p>
        </div>
        <div class="benefit-item">
            <h3>Hàng chính hãng</h3>
            <p>Sản phẩm được bảo hành theo chính sách của shop.</p>
        </div>
    </div>
</section>

<?php
require_once __DIR__ . '/../giao_dien/footer.php';
