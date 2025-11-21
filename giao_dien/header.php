<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<link rel="stylesheet" href="../assets/css/header.css">

<header class="main-header">

    <!-- HÀNG TRÊN -->
    <div class="topbar">
        <span>Miễn phí giao hàng cho đơn từ 500.000đ</span>
        <span>Đăng ký nhận ưu đãi 100.000đ</span>
    </div>

    <!-- THANH CHÍNH -->
    <div class="header-middle">

        <!-- LOGO -->
        <a href="/webnhom7/trang_nguoi_dung/trang_chu.php" class="logo">
            <img src="../assets/img/logo.png" alt="crocs">
        </a>

        <!-- MENU -->
        <nav class="main-menu">
            <a href="../trang_nguoi_dung/danh_muc.php?id_danh_muc=2">NỮ</a>
            <a href="../trang_nguoi_dung/danh_muc.php?id_danh_muc=1">NAM</a>
            <a href="../trang_nguoi_dung/danh_muc.php?id_danh_muc=3">TRẺ EM</a>
            <a href="#">SANDALS</a>
            <a href="#">JIBBITZ™</a>
            <a href="#">XU HƯỚNG</a>
            <a href="#">ƯU ĐÃI</a>
        </nav>

        <!-- SEARCH -->
        <form action="../trang_nguoi_dung/tim_kiem.php" method="get" class="search-box">
            <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm...">
            <button><i class="fa fa-search"></i></button>
        </form>

        <!-- ICON -->
        <div class="header-icons">

            <!-- TÀI KHOẢN -->
            <?php if (isset($_SESSION['user'])): ?>
                <div class="user-box">
                    <span class="hi">Xin chào, <?= htmlspecialchars($_SESSION['user']['ho_ten']) ?></span>
                    <a href="/webnhom7/tai_khoan/dang_xuat.php">Đăng xuất</a>
                </div>
            <?php else: ?>
                <a href="/webnhom7/tai_khoan/dang_nhap.php"><i class="fa fa-user"></i></a>
            <?php endif; ?>

            <!-- GIỎ HÀNG -->
            <a href="/webnhom7/trang_nguoi_dung/gio_hang.php" class="cart-icon">
                <i class="fa fa-shopping-cart"></i>
                <span class="cart-num">
                    <?= isset($_SESSION['gio_hang']) ? count($_SESSION['gio_hang']) : 0 ?>
                </span>
            </a>

        </div>
    </div>

</header>
