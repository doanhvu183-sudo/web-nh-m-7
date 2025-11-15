<?php
// cau_hinh/bao_mat.php

function yeu_cau_dang_nhap()
{
    if (!isset($_SESSION['user'])) {
        // Lưu URL cũ để quay lại nếu thích
        $_SESSION['back_url'] = $_SERVER['REQUEST_URI'] ?? 'trang_nguoi_dung/trang_chu.php';
        header('Location: ../tai_khoan/dang_nhap.php');
        exit;
    }
}

// Chỉ cho admin (id_vai_tro = 1)
function yeu_cau_admin()
{
    yeu_cau_dang_nhap();
    if ($_SESSION['user']['id_vai_tro'] != 1) {
        die('Bạn không có quyền truy cập trang này.');
    }
}
