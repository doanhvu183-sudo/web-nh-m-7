<?php
// trang_nguoi_dung/them_vao_gio.php
require_once __DIR__ . '/../cau_hinh/ket_noi.php';
require_once __DIR__ . '/../cau_hinh/ham.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_san_pham = isset($_POST['id_san_pham']) ? (int)$_POST['id_san_pham'] : 0;
    $so_luong    = isset($_POST['so_luong']) ? (int)$_POST['so_luong'] : 1;

    $sp = lay_san_pham_theo_id($pdo, $id_san_pham);
    if ($sp) {
        them_vao_gio(
            $sp['id_san_pham'],
            $sp['ten_san_pham'],
            $sp['gia'],
            $sp['hinh_anh'],
            $so_luong
        );
    }

    header('Location: gio_hang.php');
    exit;
} else {
    header('Location: trang_chu.php');
    exit;
}
