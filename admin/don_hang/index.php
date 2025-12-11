<?php
include_once __DIR__ . "/../includes/db.php";

$title = "Quản lý đơn hàng (Premium)";

// Lấy danh sách đơn
$sql = "
    SELECT dh.*, nd.ho_ten AS ten_khach
    FROM donhang dh
    LEFT JOIN nguoidung nd ON dh.id_nguoi_dung = nd.id_nguoi_dung
    ORDER BY dh.ngay_dat DESC
";
$orders = $conn->query($sql)->fetchAll();

$view_file = __DIR__ . "/view_list.php";
include "../layout/layout_admin.php";
