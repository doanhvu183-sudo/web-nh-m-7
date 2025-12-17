<?php
include_once __DIR__ . "/../includes/db.php";

$id = $_POST["id"];
$ten = $_POST["ten"];
$gia = $_POST["gia"];
$gia_goc = $_POST["gia_goc"];
$so_luong = $_POST["so_luong"];
$id_dm = $_POST["id_dm"];
$mo_ta = $_POST["mo_ta"];

// Lấy sản phẩm cũ
$sql = "SELECT hinh_anh FROM sanpham WHERE id_san_pham = ?";
$stm = $conn->prepare($sql);
$stm->execute([$id]);
$old = $stm->fetch();

$ten_file = $old["hinh_anh"];

// Nếu đổi ảnh
if (!empty($_FILES["anh"]["name"])) {
    $anh = $_FILES["anh"]["name"];
    $tmp = $_FILES["anh"]["tmp_name"];
    $ten_file = time() . "_" . $anh;
    move_uploaded_file($tmp, "../../assets/img/" . $ten_file);
}

$sql = "UPDATE sanpham SET 
        ten_san_pham=?, gia=?, gia_goc=?, so_luong=?, id_danh_muc=?, hinh_anh=?, mo_ta=?
        WHERE id_san_pham=?";

$stm = $conn->prepare($sql);
$stm->execute([$ten, $gia, $gia_goc, $so_luong, $id_dm, $ten_file, $mo_ta, $id]);

header("Location: index.php");
exit;
