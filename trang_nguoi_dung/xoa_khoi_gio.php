<?php
require_once __DIR__ . '/../cau_hinh/ket_noi.php';
require_once __DIR__ . '/../cau_hinh/ham.php';

init_gio_hang();
$id = (int)($_GET['id'] ?? 0);
xoa_khoi_gio($id);

header("Location: gio_hang.php");
exit;
