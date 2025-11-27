<?php
session_start();

require_once __DIR__ . '/../cau_hinh/ket_noi.php';
require_once __DIR__ . '/../cau_hinh/ham.php';

// Kiểm tra đăng nhập
if (!isset($_SESSION['user'])) {
    echo "<script>
            alert('Bạn phải đăng nhập để thêm vào giỏ hàng!');
            window.location='../tai_khoan/dang_nhap.php';
          </script>";
    exit;
}

// Lấy dữ liệu từ form
$id_sp     = $_POST['id_sp'] ?? 0;
$ten_sp    = $_POST['ten_sp'] ?? '';
$gia       = $_POST['gia'] ?? 0;
$hinh_anh  = $_POST['hinh'] ?? '';
$size      = $_POST['size'] ?? '';
$so_luong  = 1;

// Tạo item giỏ hàng
$sp_moi = [
    "id_sp"        => $id_sp,
    "ten"          => $ten_sp,
    "gia"          => $gia,
    "hinh_anh"     => $hinh_anh,
    "size"         => $size,
    "so_luong"     => $so_luong
];

// Nếu giỏ hàng chưa tồn tại → tạo mới
if (!isset($_SESSION['gio_hang'])) {
    $_SESSION['gio_hang'] = [];
}

// Kiểm tra sản phẩm trùng (cùng ID + Size)
$da_co = false;

foreach ($_SESSION['gio_hang'] as $key => $item) {
    if ($item['id_sp'] == $id_sp && $item['size'] == $size) {
        $_SESSION['gio_hang'][$key]['so_luong']++;
        $da_co = true;
        break;
    }
}

// Nếu chưa có → thêm mới
if (!$da_co) {
    $_SESSION['gio_hang'][] = $sp_moi;
}

// Chuyển hướng về giỏ
echo "<script>
        alert('Đã thêm vào giỏ hàng!');
        window.location='gio_hang.php';
      </script>";
?>
