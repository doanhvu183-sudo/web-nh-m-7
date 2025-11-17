<?php
require_once __DIR__ . '/../cau_hinh/ket_noi.php';
require_once __DIR__ . '/../cau_hinh/ham.php';

init_gio_hang();

$id_sp = intval($_POST['id_san_pham']);
$so_luong = intval($_POST['so_luong']);

$sp = $pdo->prepare("SELECT * FROM SANPHAM WHERE id_san_pham = :id");
$sp->execute([':id' => $id_sp]);
$sp = $sp->fetch();

if (!$sp) {
    die("Sản phẩm không tồn tại.");
}

if (!isset($_SESSION['gio_hang'][$id_sp])) {
    $_SESSION['gio_hang'][$id_sp] = [
        'ten' => $sp['ten_san_pham'],
        'gia' => $sp['gia'],
        'so_luong' => $so_luong,
        'hinh' => $sp['hinh_anh']
    ];
} else {
    $_SESSION['gio_hang'][$id_sp]['so_luong'] += $so_luong;
}

header("Location: gio_hang.php");
exit;
