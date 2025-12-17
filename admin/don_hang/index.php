<?php
include_once __DIR__ . "/../includes/db.php";

/* LẤY TẤT CẢ ĐƠN HÀNG */
$sql = "
    SELECT dh.*, dh.ho_ten_nhan AS ten_khach
    FROM donhang dh
    ORDER BY dh.id_don_hang DESC
";
$stm = $conn->query($sql);
$orders = $stm->fetchAll(PDO::FETCH_ASSOC);

$title = "Quản lý đơn hàng (Premium)";
$view_file = __DIR__ . "/view_list.php";
include "../layout/layout_admin.php";
