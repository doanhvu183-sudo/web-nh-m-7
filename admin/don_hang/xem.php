<?php
include_once __DIR__ . "/../includes/db.php";

$id = $_GET["id"];

// Lấy thông tin đơn hàng
$sql = "
    SELECT dh.*, nd.ho_ten, nd.email, nd.so_dien_thoai, nd.dia_chi
    FROM donhang dh
    LEFT JOIN nguoidung nd ON dh.id_nguoi_dung = nd.id_nguoi_dung
    WHERE dh.id_don_hang = ?
";
$stm = $conn->prepare($sql);
$stm->execute([$id]);
$don = $stm->fetch();

// Lấy danh sách sản phẩm trong đơn
$sql2 = "
    SELECT ct.*, sp.ten_san_pham, sp.hinh_anh
    FROM chitiet_donhang ct
    JOIN sanpham sp ON ct.id_san_pham = sp.id_san_pham
    WHERE ct.id_don_hang = ?
";
$stm2 = $conn->prepare($sql2);
$stm2->execute([$id]);
$items = $stm2->fetchAll();

$title = "Chi tiết đơn hàng #" . $id;
$view_file = __DIR__ . "/view_detail.php";
include "../layout/layout_admin.php";
