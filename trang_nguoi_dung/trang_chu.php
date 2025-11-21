<?php
require_once __DIR__ . '/../cau_hinh/ket_noi.php';
require_once __DIR__ . '/../cau_hinh/ham.php';

// Lấy 8 sản phẩm mới nhất
$sql = "SELECT * FROM SANPHAM ORDER BY id_san_pham DESC LIMIT 8";
$san_pham_moi = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Crocs Việt Nam</title>
    <link rel="stylesheet" href="../assets/css/trang_chu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<!-- ================== HEADER CROCS ================== -->
<header class="main-header">

    <!-- Thanh top nhỏ -->
    <div class="topbar">
        <span>Tặng VOUCHER 100K khi tham gia Crocs Club</span>
        <span>Đăng ký & nhận 100.000 VND</span>
    </div>

    <!-- Logo + Menu + Search + Icon -->
    <div class="header-middle">

        <!-- LOGO -->
        <a class="logo">
            <img src="../assets/img/logo.png" alt="Crocs">
        </a>

        <!-- MENU -->
        <nav class="main-menu">
            <a href="danh_muc.php?loai=hangmoi"></a>
            <a href="danh_muc.php?loai=banchay">NỮ</a>
            <a href="danh_muc.php?loai=giaydecao">NAM</a>
            <a href="danh_muc.php?loai=xuhuong">TRẺ EM</a>
            <a href="danh_muc.php?loai=collab">SANDALS</a>
            <a href="danh_muc.php?loai=thethao">JIBBITZ™</a>
            <a href="danh_muc.php?loai=nu">XU HƯỚNG</a>
            <a href="danh_muc.php?loai=nam">ƯU ĐÃI</a>
            <a href="danh_muc.php?loai=treem">BLACK FRIDAY</a>
        </nav>

        <!-- SEARCH -->
        <div class="search-box">
            <input type="text" placeholder="Tìm kiếm sản phẩm...">
            <i class="fa fa-search"></i>
        </div>

        <!-- ICON PHẢI -->
        <div class="header-icons">
            <a href="#" class="icon-item"><i class="fa-regular fa-user"></i></a>
            <a href="#" class="icon-item">
                <i class="fa-solid fa-cart-shopping"></i>
                <span class="cart-num">3</span>
            </a>
        </div>

    </div>

</header>

<!-- ================== HERO ================== -->
<section class="hero-block">
    <img src="../assets/img/hero_doraemon.jpg" class="hero-img">
</section>
<!-- TABS GIỚI TÍNH -->
<section class="gender-tabs">
    <div class="tabs-inner">
        <a href="danh_muc.php?loai=nu" class="tab-item">Nữ</a>
        <a href="danh_muc.php?loai=nam" class="tab-item">Nam</a>
        <a href="danh_muc.php?loai=treem" class="tab-item">Trẻ Em</a>
        <a href="danh_muc.php?loai=sale" class="tab-item">SALE</a>
    </div>
</section>



<!-- ================== DANH MỤC ================== -->
<section class="category-row">
    <div class="category-inner">

        <a class="cat-card">
            <img src="../assets/img/dm_hang_moi.jpg">
            <p>Hàng Mới</p>
        </a>

        <a class="cat-card">
            <img src="../assets/img/dm_ban_chay.jpg">
            <p>Bán Chạy</p>
        </a>

        <a class="cat-card">
            <img src="../assets/img/dm_giay_de_cao.jpg">
            <p>Giày Đế Cao</p>
        </a>

        <a class="cat-card">
            <img src="../assets/img/dm_xu_huong.jpg">
            <p>Xu Hướng</p>
        </a>

        <a class="cat-card">
            <img src="../assets/img/dm_collab.jpg">
            <p>Collab</p>
        </a>

        <a class="cat-card">
            <img src="../assets/img/dm_the_thao.jpg">
            <p>Thể Thao</p>
        </a>

    </div>
</section>

<!-- ================== HÀNG MỚI ================== -->
<section class="section-new-products">
    <h2>HÀNG MỚI</h2>

    <div class="products-row">

        <?php foreach ($san_pham_moi as $sp): ?>
            <div class="product-card">
                <img src="../assets/img/<?= $sp['hinh_anh'] ?>">
                <p class="product-name"><?= $sp['ten_san_pham'] ?></p>
                <p class="product-price"><?= dinh_dang_gia($sp['gia'] ) ?></p>
            </div>
        <?php endforeach; ?>

    </div>
</section>

</body>
</html>
