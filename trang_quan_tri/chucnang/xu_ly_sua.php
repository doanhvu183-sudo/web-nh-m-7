<?php
require_once __DIR__ . '/../../cau_hinh/ket_noi.php';

$id   = $_POST['id'];
$ten  = $_POST['ten_chuc_nang'];
$mo_ta = $_POST['mo_ta'];

$stmt = $pdo->prepare("
    UPDATE CHUCNANG
    SET ten_chuc_nang = :ten,
        mo_ta = :mo
    WHERE id_chuc_nang = :id
");

$stmt->execute([
    ':ten' => $ten,
    ':mo'  => $mo_ta,
    ':id'  => $id
]);

header("Location: danh_sach.php");
exit;
?>
