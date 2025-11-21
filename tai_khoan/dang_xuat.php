<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

unset($_SESSION['user']);
header('Location: ../trang_nguoi_dung/trang_chu.php');
exit;
