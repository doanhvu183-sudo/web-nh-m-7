<?php
// trang_nguoi_dung/trang_chu.php

require_once __DIR__ . '/../giao_dien/header.php';
require_once __DIR__ . '/../cau_hinh/ket_noi.php';
require_once __DIR__ . '/../cau_hinh/ham.php';

// Lấy 8 sản phẩm mới nhất
$sql = "SELECT * FROM SANPHAM ORDER BY id_san_pham DESC LIMIT 8";
$san_pham_moi = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="../assets/css/trang_chu.css">

<main class="home-page">

    <!-- HERO DORAEMON -->
    <section class="hero-block">
        <img src="../assets/img/hero_doraemon.jpg" alt="Mua Doraemon" class="hero-img">
    </section>

    <!-- TAB NỮ / NAM / TRẺ EM / SALE -->
    <section class="gender-tabs">
        <div class="tabs-inner">
            <button class="tab-item active">Nữ</button>
            <button class="tab-item">Nam</button>
            <button class="tab-item">Trẻ Em</button>
            <button class="tab-item">SALE</button>
        </div>
    </section>

    <!-- DANH MỤC -->
    <section class="category-row">
        <div class="category-inner">

            <a href="danh_muc.php?loai=hangmoi" class="cat-card">
                <div class="cat-img"><img src="../assets/img/dm_hang_moi.jpg"></div>
                <div class="cat-title">Hàng Mới</div>
            </a>

            <a href="danh_muc.php?loai=banchay" class="cat-card">
                <div class="cat-img"><img src="../assets/img/dm_ban_chay.jpg"></div>
                <div class="cat-title">Bán Chạy</div>
            </a>

            <a href="danh_muc.php?loai=giaydecao" class="cat-card">
                <div class="cat-img"><img src="../assets/img/dm_giay_de_cao.jpg"></div>
                <div class="cat-title">Giày Đế Cao</div>
            </a>

            <a href="danh_muc.php?loai=xuhuong" class="cat-card">
                <div class="cat-img"><img src="../assets/img/dm_xu_huong.jpg"></div>
                <div class="cat-title">Xu Hướng</div>
            </a>

            <a href="danh_muc.php?loai=collab" class="cat-card">
                <div class="cat-img"><img src="../assets/img/dm_collab.jpg"></div>
                <div class="cat-title">Collab</div>
            </a>

            <a href="danh_muc.php?loai=thethao" class="cat-card">
                <div class="cat-img"><img src="../assets/img/dm_the_thao.jpg"></div>
                <div class="cat-title">Thể Thao</div>
            </a>

        </div>
    </section>

    <!-- HÀNG MỚI -->
    <section class="section-new-products">
        <div class="section-header">
            <h2>HÀNG MỚI</h2>
        </div>

        <div class="products-row">
            <?php foreach ($san_pham_moi as $sp): ?>
                <a href="chi_tiet_san_pham.php?id=<?= $sp['id_san_pham'] ?>" class="product-card">

                    <div class="product-img">
                        <img src="../assets/img/<?= htmlspecialchars($sp['hinh_anh']) ?>">
                    </div>

                    <div class="product-info">
                        <div class="product-name"><?= htmlspecialchars($sp['ten_san_pham']) ?></div>
                        <div class="product-price"><?= dinh_dang_gia($sp['gia']) ?></div>
                    </div>

                </a>
            <?php endforeach; ?>
        </div>
    </section>

</main>

<?php require_once __DIR__ . '/../giao_dien/footer.php'; ?>
