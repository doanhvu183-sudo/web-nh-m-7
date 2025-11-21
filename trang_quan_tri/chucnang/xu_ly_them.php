<?php
require_once __DIR__ . '/../../cau_hinh/ket_noi.php';

$ten = $_POST['ten_chuc_nang'];
$mo_ta = $_POST['mo_ta'];

$stmt = $pdo->prepare("
    INSERT INTO CHUCNANG (ten_chuc_nang, mo_ta)
    VALUES (:ten, :mo)
");
$stmt->execute([
    ':ten' => $ten,
    ':mo'  => $mo_ta
]);

header("Location: danh_sach.php");
exit;
?>
