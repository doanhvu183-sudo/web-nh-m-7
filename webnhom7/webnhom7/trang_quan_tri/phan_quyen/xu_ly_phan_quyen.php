<?php
require_once __DIR__ . '/../../cau_hinh/ket_noi.php';

$id_vai_tro = $_POST['id_vai_tro'];
$chuc_nang = $_POST['chuc_nang'] ?? [];

// Xóa quyền cũ
$del = $pdo->prepare("DELETE FROM VAITRO_CHUCNANG WHERE id_vai_tro = :id");
$del->execute([':id' => $id_vai_tro]);

// Thêm quyền mới
$add = $pdo->prepare("
    INSERT INTO VAITRO_CHUCNANG (id_vai_tro, id_chuc_nang, quyen_truy_cap)
    VALUES (:vt, :cn, 'Có')
");

foreach ($chuc_nang as $cn) {
    $add->execute([
        ':vt' => $id_vai_tro,
        ':cn' => $cn
    ]);
}

header("Location: danh_sach.php");
exit;
?>
