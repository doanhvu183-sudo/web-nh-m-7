<?php
require_once __DIR__ . '/../../cau_hinh/ket_noi.php';

$ten = $_POST['ten_vai_tro'];
$mo_ta = $_POST['mo_ta'];

$stmt = $pdo->prepare("INSERT INTO VAITRO (ten_vai_tro, mo_ta) VALUES (:t, :m)");
$stmt->execute([':t' => $ten, ':m' => $mo_ta]);

header("Location: danh_sach.php");
exit;
?>
