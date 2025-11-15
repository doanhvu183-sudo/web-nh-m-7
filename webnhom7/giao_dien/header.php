<?php
// giao_dien/header.php
require_once __DIR__ . '/../cau_hinh/ket_noi.php';
require_once __DIR__ . '/../cau_hinh/ham.php';

// Lấy danh mục (dùng cho menu “Tất cả sản phẩm”)
$danhmuc_list = lay_tat_ca_danh_muc($pdo);

// Check đăng nhập
$da_dang_nhap = isset($_SESSION['user']);
$ten_user = $da_dang_nhap ? $_SESSION['user']['ho_ten'] : '';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Crocs Shop Việt Nam - WebNhóm7</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<!-- THANH THÔNG BÁO TRÊN CÙNG (giống crocs: freeship, giỏ mini) -->
<div class="topbar">
    <div class="topbar-inner">
        <div class="topbar-left">
            Miễn phí giao hàng cho đơn từ <strong>500.000đ</strong>
        </div>
        <div class="topbar-right">
            <span>Giỏ hàng: </span>
            <a href="gio_hang.php" class="topbar-cart-link">
                Xem giỏ hàng (<?= isset($_SESSION['gio_hang']) ? count($_SESSION['gio_hang']) : 0 ?>)
            </a>
        </div>
    </div>
</div>

<!-- THANH VOUCHER / LOYALTY (giống dòng chạy khuyến mãi) -->
<div class="promo-bar">
    <div class="promo-item">Đón đầu xu hướng với giày dép MỚI NHẤT 2025</div>
    <div class="promo-item">Tham gia thành viên nhận voucher 100K cho đơn đầu tiên</div>
</div>

<header class="header">
    <div class="header-main">
        <div class="logo">
            <a href="trang_chu.php">Crocs Shop</a>
        </div>

        <nav class="main-nav">
            <ul>
                <li class="nav-item has-mega">
                    <a href="#">Nữ</a>
                </li>
                <li class="nav-item has-mega">
                    <a href="#">Nam</a>
                </li>
                <li class="nav-item has-mega">
                    <a href="#">Trẻ em</a>
                </li>
                <li class="nav-item">
                    <a href="#">Sandals</a>
                </li>
                <li class="nav-item">
                    <a href="#">Jibbitz™</a>
                </li>
                <li class="nav-item">
                    <a href="danh_muc.php">Ưu đãi</a>
                </li>
                <li class="nav-item">
                    <a href="danh_muc.php">Tất cả sản phẩm</a>
                </li>
            </ul>
        </nav>

        <div class="header-right">
            <form class="search-form" action="tim_kiem.php" method="get">
                <input type="text" name="q" placeholder="Tìm sản phẩm...">
                <button type="submit">🔍</button>
            </form>

            <div class="account-links">
                <?php if ($da_dang_nhap): ?>
                    <span class="hello">Xin chào, <?= htmlspecialchars($ten_user) ?></span>
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
