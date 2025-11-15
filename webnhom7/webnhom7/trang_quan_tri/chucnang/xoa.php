<?php
require_once __DIR__ . '/../../cau_hinh/ket_noi.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM CHUCNANG WHERE id_chuc_nang = :id");
$stmt->execute([':id' => $id]);

header("Location: danh_sach.php");
exit;
?>
