<?php
require_once __DIR__ . '/../../cau_hinh/ket_noi.php';
require_once __DIR__ . '/../../cau_hinh/bao_mat.php';

yeu_cau_admin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Phương thức không hợp lệ");
}

$id_vai_tro = (int)($_POST['id_vai_tro'] ?? 0);
$chuc_nang  = $_POST['chuc_nang'] ?? [];

// Xóa quyền cũ của vai trò này
$del = $pdo->prepare("DELETE FROM VAITRO_CHUCNANG WHERE id_vai_tro = :id");
$del->execute([':id' => $id_vai_tro]);

// Chuẩn bị câu lệnh insert quyền mới
$ins = $pdo->prepare("
    INSERT INTO VAITRO_CHUCNANG (id_vai_tro, id_chuc_nang, quyen_truy_cap)
    VALUES (:vt, :cn, 'Có')
");

foreach ($chuc_nang as $cn_id) {
    $ins->execute([
        ':vt' => $id_vai_tro,
        ':cn' => (int)$cn_id
    ]);
}

// Quay lại danh sách phân quyền
header("Location: danh_sach.php");
exit;
