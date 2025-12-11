<?php
// Kết nối DB
include_once __DIR__ . "/../includes/db.php";

// Lấy số đơn
$sql = "SELECT COUNT(*) AS total FROM donhang";
$so_don = $conn->query($sql)->fetch()['total'];

// Lấy số khách
$sql = "SELECT COUNT(*) AS total FROM nguoidung";
$so_khach = $conn->query($sql)->fetch()['total'];

$title = "Dashboard";

// Tải giao diện dashboard
$view_file = __DIR__ . "/dashboard_noi_dung.php";
include "../layout/layout_admin.php";
