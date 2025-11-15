<?php
require_once __DIR__ . '/../cau_hinh/ket_noi.php';

$id = $_POST['id_san_pham'];
$so = intval($_POST['so_luong']);

if ($so <= 0) $so = 1;

$_SESSION['gio_hang'][$id]['so_luong'] = $so;

header("Location: gio_hang.php");
exit;
