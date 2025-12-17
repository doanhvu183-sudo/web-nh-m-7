<?php
include_once __DIR__ . "/../includes/db.php";

$id = $_GET["id"];

$sql = "SELECT * FROM sanpham WHERE id_san_pham = ?";
$stm = $conn->prepare($sql);
$stm->execute([$id]);
$sp = $stm->fetch();

$sql_dm = "SELECT * FROM danhmuc ORDER BY id_danh_muc ASC";
$ds_dm = $conn->query($sql_dm)->fetchAll();

$title = "Sửa sản phẩm";
$view_file = __DIR__ . "/view_sua.php";
include "../layout/layout_admin.php";
