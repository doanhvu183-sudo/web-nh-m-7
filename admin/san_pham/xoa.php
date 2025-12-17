<?php
include_once __DIR__ . "/../includes/db.php";

$id = $_GET["id"];

$sql = "DELETE FROM sanpham WHERE id_san_pham = ?";
$stm = $conn->prepare($sql);
$stm->execute([$id]);

header("Location: index.php");
exit;
