<?php
session_start();

if (!isset($_SESSION['admin_da_dang_nhap'])) {
    header("Location: dang_nhap/dang_nhap.php");
    exit();
}
?>
