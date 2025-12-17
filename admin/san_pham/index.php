<?php
include_once __DIR__ . "/../includes/db.php";

$sql_dm = "SELECT * FROM danhmuc ORDER BY id_danh_muc ASC";
$ds_dm = $conn->query($sql_dm)->fetchAll(PDO::FETCH_ASSOC);

// ----- TÌM KIẾM -----
$q = $_GET["q"] ?? "";

// ----- LỌC DANH MỤC -----
$dm = $_GET["dm"] ?? "";

// ----- QUERY SẢN PHẨM -----
$sql = "SELECT sp.*, dm.ten_danh_muc 
        FROM sanpham sp
        LEFT JOIN danhmuc dm ON sp.id_danh_muc = dm.id_danh_muc
        WHERE 1=1 ";

$params = [];

if ($q !== "") {
    $sql .= " AND sp.ten_san_pham LIKE :q ";
    $params[":q"] = "%$q%";
}

if ($dm !== "") {
    $sql .= " AND sp.id_danh_muc = :dm ";
    $params[":dm"] = $dm;
}

$sql .= " ORDER BY sp.id_san_pham DESC";

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$ds_sp = $stmt->fetchAll(PDO::FETCH_ASSOC);

$title = "Quản lý sản phẩm";
$view_file = __DIR__ . "/view_list.php";
include "../layout/layout_admin.php";
?>
