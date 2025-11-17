<?php
require_once __DIR__ . '/../../cau_hinh/ket_noi.php';

$id = $_POST['id'];
$ten = $_POST['ten_vai_tro'];
$mo_ta = $_POST['mo_ta'];

$stmt = $pdo->prepare("
    UPDATE VAITRO 
    SET ten_vai_tro = :ten, mo_ta = :mo 
    WHERE id_vai_tro = :id
");
$stmt->execute([
    ':ten' => $ten,
    ':mo' => $mo_ta,
    ':id' => $id
]);

header("Location: danh_sach.php");
exit;
?>
