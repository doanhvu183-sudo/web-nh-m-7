<?php
include_once __DIR__ . "/../includes/db.php";

// Lấy danh mục
$sql = "SELECT * FROM danhmuc ORDER BY id_danh_muc ASC";
$ds_dm = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);

$title = "Thêm sản phẩm";
$view_file = __DIR__ . "/view_them.php";
include "../layout/layout_admin.php";
