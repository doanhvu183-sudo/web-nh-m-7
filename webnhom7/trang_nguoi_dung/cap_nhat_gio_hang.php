<?php
// trang_nguoi_dung/cap_nhat_gio_hang.php
require_once __DIR__ . '/../cau_hinh/ket_noi.php';
require_once __DIR__ . '/../cau_hinh/ham.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['so_luong'])) {
    foreach ($_POST['so_luong'] as $id => $sl) {
        cap_nhat_gio((int)$id, (int)$sl);
    }
}

header('Location: gio_hang.php');
exit;
