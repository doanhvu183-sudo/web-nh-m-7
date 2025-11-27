<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../cau_hinh/ket_noi.php';
require_once __DIR__ . '/../cau_hinh/ham.php';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Crocs Việt Nam</title>

    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<!-- =============== TOPBAR ================= -->
<div class="topbar">
    <span>Tặng VOUCHER 100K khi tham gia Crocs Club</span>
    <span>Đăng ký & nhận 100.000 VND</span>
</div>

<!-- =============== HEADER CHÍNH =============== -->
<header class="header-wrap">

    <!-- LOGO -->
    <a class="logo" href="/webnhom7/trang_nguoi_dung/trang_chu.php">
        <img src="../assets/img/logo.png" alt="Crocs Việt Nam">
    </a>

    <!-- MENU CHÍNH -->
    <nav class="menu">
        <a href="danh_muc.php?loai=nu">NỮ</a>
        <a href="danh_muc.php?loai=nam">NAM</a>
        <a href="danh_muc.php?loai=treem">TRẺ EM</a>
        <a href="danh_muc.php?loai=sandals">SANDALS</a>
        <a href="danh_muc.php?loai=jibbitz">JIBBITZ™</a>
        <a href="danh_muc.php?loai=xuhuong">XU HƯỚNG</a>
        <a href="danh_muc.php?loai=uudai" class="highlight">ƯU ĐÃI</a>
        <a href="danh_muc.php?loai=blackfriday" class="highlight">BLACK FRIDAY</a>
    </nav>

    <!-- SEARCH + ACCOUNT + CART -->
    <div class="right-box">

        <!-- SEARCH -->
        <div class="search-box">
            <input type="text" placeholder="Tìm kiếm ...">
            <i class="fa fa-search"></i>
        </div>

        <!-- ACCOUNT ICON -->
        <a class="icon" href="/webnhom7/tai_khoan/dang_nhap.php">
            <i class="fa-regular fa-user"></i>
        </a>

        <!-- CART ICON -->
        <a class="icon" href="/webnhom7/trang_nguoi_dung/gio_hang.php">
            <i class="fa-solid fa-cart-shopping"></i>

            <span class="cart-count">
                <?= isset($_SESSION['gio_hang']) ? count($_SESSION['gio_hang']) : 0 ?>
            </span>
        </a>

    </div>

</header>
