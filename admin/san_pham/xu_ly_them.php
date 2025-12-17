<?php
include_once __DIR__ . "/../includes/db.php";

$ten = $_POST["ten"];
$gia = $_POST["gia"];
$gia_goc = $_POST["gia_goc"] ?: null;
$so_luong = $_POST["so_luong"];
$id_dm = $_POST["id_dm"];
$mo_ta = $_POST["mo_ta"];

// Xử lý ảnh
$anh = $_FILES["anh"]["name"];
$tmp = $_FILES["anh"]["tmp_name"];

$ten_file = time() . "_" . $anh;
move_uploaded_file($tmp, "../../assets/img/" . $ten_file);

// Insert DB
$sql = "INSERT INTO sanpham(ten_san_pham, gia, gia_goc, so_luong, id_danh_muc, hinh_anh, mo_ta)
        VALUES (?,?,?,?,?,?,?)";

$stm = $conn->prepare($sql);
$stm->execute([$ten, $gia, $gia_goc, $so_luong, $id_dm, $ten_file, $mo_ta]);

header("Location: index.php");
exit;
