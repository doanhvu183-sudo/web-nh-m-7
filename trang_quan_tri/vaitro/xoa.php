<?php
require_once __DIR__ . '/../../cau_hinh/ket_noi.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM VAITRO WHERE id_vai_tro = :id");
$stmt->execute([':id' => $id]);

header("Location: danh_sach.php");
exit;
?>
