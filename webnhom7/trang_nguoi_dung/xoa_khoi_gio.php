<?php
// trang_nguoi_dung/xoa_khoi_gio.php
require_once __DIR__ . '/../cau_hinh/ket_noi.php';
require_once __DIR__ . '/../cau_hinh/ham.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id > 0) {
    xoa_khoi_gio($id);
}
header('Location: gio_hang.php');
exit;
