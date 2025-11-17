<?php
require_once __DIR__ . '/../cau_hinh/ket_noi.php';

unset($_SESSION['user']);

header('Location: ../trang_nguoi_dung/trang_chu.php');
exit;
