<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ . '/../cau_hinh/ket_noi.php';
require_once __DIR__ . '/../cau_hinh/ham.php';

// Tính số lượng sản phẩm trong giỏ
$gio_count = 0;
if (!empty($_SESSION['gio_hang'])) {
    foreach ($_SESSION['gio_hang'] as $g) {
        $gio_count += $g['so_luong'];
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Crocs Store</title>
    <link rel="stylesheet" href="../assets/css/style_home.css">
    <link rel="stylesheet" href="../assets/css/category.css">
    <link rel="stylesheet" href="../assets/css/product_detail.css">
    <link rel="stylesheet" href="../assets/css/auth.css">
    <link rel="stylesheet" href="../assets/css/profile.css">
    <link rel="stylesheet" href="../assets/css/header.css">
</head>
<body>

<header class="main-header">
    <div class="header-inner">

        <div class="header-left">
            <a href="trang_chu.php" class="logo">crocs™</a>

            <nav class="main-nav">
                <a href="danh_muc.php?id_danh_muc=1">Nam</a>
                <a href="danh_muc.php?id_danh_muc=2">Nữ</a>
                <a href="danh_muc.php?id_danh_muc=3">Trẻ em</a>
                <a href="danh_muc.php">Tất cả</a>
            </nav>
        </div>

        <div class="header-right">
            <form action="tim_kiem.php" method="get" class="search-box">
                <input type="text" name="q" placeholder="Tìm kiếm sản phẩm...">
            </form>

            <div class="header-icons">
                <?php if (isset($_SESSION['user'])): ?>
                    <a href="../trang_nguoi_dung/profile.php" class="header-link">
                        <?= htmlspecialchars($_SESSION['user']['ho_ten'] ?? 'Tài khoản') ?>
                    </a>
                <?php else: ?>
                    <a href="../tai_khoan/dang_nhap.php" class="header-link">Đăng nhập</a>
                <?php endif; ?>

                <a href="../trang_nguoi_dung/gio_hang.php" class="header-cart">
                    Giỏ hàng
                    <?php if ($gio_count > 0): ?>
                        <span class="cart-badge"><?= $gio_count ?></span>
                    <?php endif; ?>
                </a>
            </div>
        </div>

    </div>
</header>

<main class="main-page">
