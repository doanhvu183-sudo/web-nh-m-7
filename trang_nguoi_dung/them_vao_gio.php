<?php
session_start();
require_once "../includes/db.php";
require_once "../includes/functions_cart.php";

require_login();

$id_nguoi_dung = get_user_id();
$id_san_pham = (int)($_POST['id_san_pham'] ?? 0);
$so_luong = (int)($_POST['so_luong'] ?? 1);
$action = $_POST['action'] ?? 'add';

$error = add_to_cart($pdo, $id_nguoi_dung, $id_san_pham, $so_luong);

if ($error) {
    // quay lại chi tiết sp với thông báo
    header("Location: chi_tiet_san_pham.php?id={$id_san_pham}&err=" . urlencode($error));
    exit;
}

if ($action === "buy") {
    header("Location: gio_hang.php");
} else {
    header("Location: chi_tiet_san_pham.php?id={$id_san_pham}&ok=1");
}
exit;
