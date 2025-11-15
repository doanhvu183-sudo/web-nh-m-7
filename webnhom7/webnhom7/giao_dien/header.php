<?php
// giao_dien/header.php
require_once __DIR__ . '/../cau_hinh/ket_noi.php';
require_once __DIR__ . '/../cau_hinh/ham.php';

$da_dang_nhap = isset($_SESSION['user']);
$ten_user = $da_dang_nhap ? $_SESSION['user']['ten'] : '';
$so_sp_gio = isset($_SESSION['gio_hang']) ? count($_SESSION['gio_hang']) : 0;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Cửa hàng Crocs - WebNhóm7</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<!-- Topbar -->
<div class="topbar">
    <div class="topbar-inner">
        <div>Miễn phí giao hàng cho đơn từ <strong>500.000đ</strong></div>
        <div>Hotline: 0974775265</div>
    </div>
</div>

<!-- Promo bar -->
<div class="promo-bar">
    <span>Giảm đến 50% cho bộ sưu tập mới</span>
    <span>Thành viên mới tặng voucher 100.000đ</span>
</div>

<!-- Header chính -->
<header class="header">
    <div class="header-main">
        <div class="logo">
            <a href="../trang_nguoi_dung/trang_chu.php">Crocs Shop</a>
        </div>

        <nav class="main-nav">
            <ul>
                <li><a href="../trang_nguoi_dung/danh_muc.php?id_danh_muc=2">Nữ</a></li>
                <li><a href="../trang_nguoi_dung/danh_muc.php?id_danh_muc=1">Nam</a></li>
                <li><a href="../trang_nguoi_dung/danh_muc.php?id_danh_muc=3">Trẻ em</a></li>
                <li><a href="../trang_nguoi_dung/danh_muc.php">Tất cả sản phẩm</a></li>
            </ul>
        </nav>

        <div class="header-right">
            <form class="search-form" action="../trang_nguoi_dung/tim_kiem.php" method="get">
                <input type="text" name="q" placeholder="Tìm sản phẩm...">
                <button type="submit">🔍</button>
            </form>

            <a class="header-cart" href="../trang_nguoi_dung/gio_hang.php">
                🛒 <span><?= $so_sp_gio ?></span>
            </a>

            <div class="account-links">
                <?php if ($da_dang_nhap): ?>
                    <span class="hello">Hi, <?= htmlspecialchars($ten_user) ?></span>
                    <a href="../trang_nguoi_dung/lich_su_mua_hang.php">Đơn hàng</a>
                    <a href="../tai_khoan/dang_xuat.php">Đăng xuất</a>
                <?php else: ?>
                    <a href="../tai_khoan/dang_nhap.php">Đăng nhập</a>
                    <a href="../tai_khoan/dang_ky.php">Đăng ký</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

<main class="main-content">
