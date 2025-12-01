<?php
require_once __DIR__.'/../cau_hinh/ket_noi.php';
require_once __DIR__.'/../giao_dien/header.php';

$sql = "SELECT * FROM SANPHAM ORDER BY id_san_pham DESC LIMIT 36";
$hang_moi = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="../assets/css/trang_chu.css?v=<?=time()?>">

<main class="home-page">

    <!-- HERO -->
    <section class="hero-block">
        <img src="../assets/img/logoto.jpg" class="hero-img">
    </section>

    <!-- GENDER TABS -->
    <section class="gender-tabs">
        <div class="tabs-inner">
            <a href="danh_muc.php?loai=nu" class="tab-item">Nữ</a>
            <a href="danh_muc.php?loai=nam" class="tab-item">Nam</a>
            <a href="danh_muc.php?loai=treem" class="tab-item">Trẻ Em</a>
            <a href="danh_muc.php?loai=sale" class="tab-item">SALE</a>
        </div>
    </section>

    <!-- CATEGORIES -->
    <section class="category-row">
        <div class="category-inner">

            <a href="danh_muc.php?loai=hangmoi" class="cat-card">
                <img src="../assets/img/dm_hang_moi.jpg">
                <p>Hàng Mới</p>
            </a>

            <a href="danh_muc.php?loai=banchay" class="cat-card">
                <img src="../assets/img/dm_ban_chay.jpg">
                <p>Bán Chạy</p>
            </a>

            <a href="danh_muc.php?loai=giaydecao" class="cat-card">
                <img src="../assets/img/dm_giay_de_cao.jpg">
                <p>Giày Đế Cao</p>
            </a>

            <a href="danh_muc.php?loai=xuhuong" class="cat-card">
                <img src="../assets/img/dm_xu_huong.jpg">
                <p>Xu Hướng</p>
            </a>

            <a href="danh_muc.php?loai=collab" class="cat-card">
                <img src="../assets/img/dm_collab.jpg">
                <p>Collab</p>
            </a>

            <a href="danh_muc.php?loai=thethao" class="cat-card">
                <img src="../assets/img/dm_the_thao.jpg">
                <p>Thể Thao</p>
            </a>

        </div>
    </section>

    <!-- NEW PRODUCTS -->
    <section class="new-products-section">
        <h2>HÀNG MỚI</h2>

        <div class="new-products-grid">
            <?php foreach ($hang_moi as $sp): ?>
            <a href="chi_tiet_san_pham.php?id=<?= $sp['id_san_pham'] ?>" class="product-card">

                <div class="product-img-wrapper">
                    <img src="../assets/img/<?= $sp['hinh_anh'] ?>">
                </div>

                <div class="product-info">
                    <p class="product-name"><?= $sp['ten_san_pham'] ?></p>
                    <p class="product-price"><?= number_format($sp['gia'], 0, ',', '.') ?>₫</p>
                </div>

            </a>
            <?php endforeach; ?>
        </div>
    </section>

</main>

<?php require_once __DIR__.'/../giao_dien/footer.php'; ?>
