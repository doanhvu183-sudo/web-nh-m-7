<?php
include_once __DIR__ . "/../includes/db.php";

$id = $_GET["id"] ?? 0;

// Không có ID → báo lỗi
if (!$id) {
    die("Thiếu mã đơn hàng!");
}

/* ========================
   LẤY THÔNG TIN ĐƠN HÀNG
======================== */
$sql = "
    SELECT dh.*, 
           dh.ho_ten_nhan AS ho_ten, 
           dh.so_dien_thoai_nhan AS so_dien_thoai,
           dh.dia_chi_nhan AS dia_chi
    FROM donhang dh
    WHERE dh.id_don_hang = ?
";
$stm = $conn->prepare($sql);
$stm->execute([$id]);
$don = $stm->fetch(PDO::FETCH_ASSOC);

if (!$don) {
    die("Đơn hàng không tồn tại!");
}

/* ========================
   LẤY SẢN PHẨM TRONG ĐƠN
======================== */
$sql_items = "
    SELECT ct.*, sp.ten_san_pham, sp.hinh_anh, sp.gia
    FROM chitiet_donhang ct
    JOIN sanpham sp ON sp.id_san_pham = ct.id_san_pham
    WHERE ct.id_don_hang = ?
";
$stm2 = $conn->prepare($sql_items);
$stm2->execute([$id]);
$items = $stm2->fetchAll(PDO::FETCH_ASSOC);

/* ========================
   TRẢ FILE VIEW
======================== */
$title = "Chi tiết đơn hàng #" . $id;
$view_file = __DIR__ . "/view_detail.php";
include "../layout/layout_admin.php";
?>
