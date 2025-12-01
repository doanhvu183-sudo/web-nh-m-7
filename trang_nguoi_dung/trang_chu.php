<?php
require_once __DIR__ . '/../cau_hinh/ket_noi.php';
require_once __DIR__ . '/../giao_dien/header.php';

// Tự sinh SALE ảo 1 lần duy nhất
$sql_products = "SELECT id_san_pham, gia, gia_goc FROM sanpham";
$all_products = $pdo->query($sql_products)->fetchAll(PDO::FETCH_ASSOC);

foreach ($all_products as $p) {
    if ($p['gia_goc'] == NULL) {
        $percent = rand(10, 30);
        $gia_goc = $p['gia'];
        $gia_km  = $gia_goc - ($gia_goc * $percent / 100);

        $update = $pdo->prepare(
            "UPDATE sanpham SET gia_goc = :goc, gia_khuyen_mai = :km WHERE id_san_pham = :id"
        );
        $update->execute([
            ':goc' => $gia_goc,
            ':km'  => $gia_km,
            ':id'  => $p['id_san_pham']
        ]);
    }
}

// HÀNG MỚI
$sql_new = "SELECT * FROM SANPHAM ORDER BY id_san_pham DESC LIMIT 20";
$hang_moi = $pdo->query($sql_new)->fetchAll(PDO::FETCH_ASSOC);

// SALE
$sql_sale = "SELECT * FROM SANPHAM WHERE gia_goc IS NOT NULL ORDER BY id_san_pham DESC LIMIT 20";
$hang_sale = $pdo->query($sql_sale)->fetchAll(PDO::FETCH_ASSOC);

// BÁN CHẠY
$sql_best = "SELECT * FROM SANPHAM ORDER BY RAND() LIMIT 18";
$best_sellers = $pdo->query($sql_best)->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="../assets/css/trang_chu.css?v=<?=time()?>">

<main class="home-page">

<!-- ================= HERO SLIDER ================= -->
<section class="hero-slider">

    <div class="hero-item active" style="background-image: url('../assets/img/hero1.jpg');"></div>
    <div class="hero-item" style="background-image: url('../assets/img/hero2.jpg');"></div>
    <div class="hero-item" style="background-image: url('../assets/img/hero3.jpg');"></div>

    <button class="hero-btn hero-prev">&#10094;</button>
    <button class="hero-btn hero-next">&#10095;</button>

    <div class="hero-dots">
        <span class="hero-dot active"></span>
        <span class="hero-dot"></span>
        <span class="hero-dot"></span>
    </div>
</section>


<script src="../assets/js/hero.js"></script>



    <!-- ================= GENDER ================= -->
    <section class="gender-tabs">
        <div class="tabs-inner">
            <a href="danh_muc.php?loai=nu" class="tab-item">Nữ</a>
            <a href="danh_muc.php?loai=nam" class="tab-item">Nam</a>
            <a href="danh_muc.php?loai=treem" class="tab-item">Trẻ Em</a>
            <a href="danh_muc.php?loai=sale" class="tab-item">SALE</a>
        </div>
    </section>

    <!-- ================= CATEGORIES ================= -->
    <section class="category-row">
        <div class="category-inner">

            <a href="danh_muc.php?loai=hangmoi" class="cat-card">
                <img src="../assets/img/dm_hang_moi.jpg"><p>Hàng Mới</p>
            </a>

            <a href="danh_muc.php?loai=banchay" class="cat-card">
                <img src="../assets/img/dm_ban_chay.jpg"><p>Bán Chạy</p>
            </a>

            <a href="danh_muc.php?loai=giaydecao" class="cat-card">
                <img src="../assets/img/dm_giay_de_cao.jpg"><p>Giày Đế Cao</p>
            </a>

            <a href="danh_muc.php?loai=xuhuong" class="cat-card">
                <img src="../assets/img/dm_xu_huong.jpg"><p>Xu Hướng</p>
            </a>

            <a href="danh_muc.php?loai=collab" class="cat-card">
                <img src="../assets/img/dm_collab.jpg"><p>Collab</p>
            </a>

            <a href="danh_muc.php?loai=classic" class="cat-card">
                <img src="../assets/img/dm_classic.jpg"><p>Classic</p>
            </a>

        </div>
    </section>

    <!-- ================= CATEGORY BANNER ================= -->
    <section class="category-banner">
        <a href="danh_muc.php?loai=xbox">
            <img src="../assets/img/banner_xbox.jpg">
        </a>
    </section>

    <!-- ================= HÀNG MỚI ================= -->
    <section class="product-slider-section">
        <h2>HÀNG MỚI</h2>

        <div class="product-slider">
            <button class="p-prev">&#10094;</button>

            <div class="product-track">
                <?php foreach ($hang_moi as $sp): ?>
                <div class="product-box">
                    <img src="../assets/img/<?= $sp['hinh_anh'] ?>">
                    <p class="p-name"><?= $sp['ten_san_pham'] ?></p>
                    <p class="p-price"><?= number_format($sp['gia']) ?>₫</p>
                </div>
                <?php endforeach; ?>
            </div>

            <button class="p-next">&#10095;</button>
        </div>
    </section>

    <!-- ================= SALE ================= -->
    <section class="sale-section">
        <h2>ĐANG SALE</h2>

        <div class="sale-slider">
            <button class="sale-prev">&#10094;</button>

            <div class="sale-track">
                <?php foreach ($hang_sale as $sp): 
                    $percent = round(100 - ($sp['gia_khuyen_mai'] / $sp['gia_goc'] * 100));
                ?>
                <div class="sale-box">
                    <span class="sale-tag">-<?= $percent ?>%</span>
                    <img src="../assets/img/<?= $sp['hinh_anh'] ?>">
                    <p class="sale-name"><?= $sp['ten_san_pham'] ?></p>

                    <p class="sale-price">
                        <span class="sale-new"><?= number_format($sp['gia_khuyen_mai']) ?>₫</span>
                        <span class="sale-old"><?= number_format($sp['gia_goc']) ?>₫</span>
                    </p>
                </div>
                <?php endforeach; ?>
            </div>

            <button class="sale-next">&#10095;</button>
        </div>
    </section>

    <!-- ================= BEST SELLER ================= -->
    <section class="best-section">
        <h2>BÁN CHẠY</h2>

        <div class="best-grid">
            <?php foreach ($best_sellers as $sp): ?>
            <div class="best-item">
                <img src="../assets/img/<?= $sp['hinh_anh'] ?>">
                <p class="best-name"><?= $sp['ten_san_pham'] ?></p>
                <p class="best-price"><?= number_format($sp['gia']) ?>₫</p>
            </div>
            <?php endforeach; ?>
        </div>

    </section>

</main>

<script src="../assets/js/product_slider.js" defer></script>

<?php require_once __DIR__.'/../giao_dien/footer.php'; ?>
