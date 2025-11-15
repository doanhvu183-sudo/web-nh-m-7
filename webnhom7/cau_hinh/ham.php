<?php
// cau_hinh/ham.php

// Định dạng giá tiền: 990000 => 990.000 đ
function dinh_dang_gia($so)
{
    return number_format($so, 0, ',', '.') . ' đ';
}

// Lấy tất cả danh mục
function lay_tat_ca_danh_muc($pdo)
{
    $sql = "SELECT * FROM DANHMUC ORDER BY id_danh_muc ASC";
    return $pdo->query($sql)->fetchAll();
}

// Lấy sản phẩm mới (mặc định 8 sản phẩm)
function lay_san_pham_moi($pdo, $limit = 8)
{
    $stmt = $pdo->prepare("SELECT * FROM SANPHAM ORDER BY id_san_pham DESC LIMIT :lim");
    $stmt->bindValue(':lim', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Lấy sản phẩm theo id
function lay_san_pham_theo_id($pdo, $id)
{
    $stmt = $pdo->prepare("SELECT * FROM SANPHAM WHERE id_san_pham = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
}

// Lấy sản phẩm theo danh mục
function lay_san_pham_theo_danh_muc($pdo, $id_danh_muc)
{
    $stmt = $pdo->prepare("SELECT * FROM SANPHAM WHERE id_danh_muc = :dm");
    $stmt->execute([':dm' => $id_danh_muc]);
    return $stmt->fetchAll();
}

// Tìm kiếm sản phẩm theo từ khóa
function tim_kiem_san_pham($pdo, $keyword)
{
    $kw = '%' . $keyword . '%';
    $stmt = $pdo->prepare("SELECT * FROM SANPHAM WHERE ten_san_pham LIKE :kw OR mo_ta LIKE :kw");
    $stmt->execute([':kw' => $kw]);
    return $stmt->fetchAll();
}

// ================= GIỎ HÀNG (LƯU TRONG SESSION) =================

// Khởi tạo giỏ nếu chưa có
function init_gio_hang()
{
    if (!isset($_SESSION['gio_hang'])) {
        $_SESSION['gio_hang'] = []; // mỗi phần tử: id_san_pham => ['ten', 'gia', 'so_luong', 'hinh_anh']
    }
}

// Thêm sản phẩm vào giỏ
function them_vao_gio($id, $ten, $gia, $hinh_anh, $so_luong = 1)
{
    init_gio_hang();
    if (isset($_SESSION['gio_hang'][$id])) {
        $_SESSION['gio_hang'][$id]['so_luong'] += $so_luong;
    } else {
        $_SESSION['gio_hang'][$id] = [
            'ten'       => $ten,
            'gia'       => $gia,
            'so_luong'  => $so_luong,
            'hinh_anh'  => $hinh_anh
        ];
    }
}

// Cập nhật số lượng
function cap_nhat_gio($id, $so_luong)
{
    init_gio_hang();
    if (isset($_SESSION['gio_hang'][$id])) {
        if ($so_luong <= 0) {
            unset($_SESSION['gio_hang'][$id]);
        } else {
            $_SESSION['gio_hang'][$id]['so_luong'] = $so_luong;
        }
    }
}

// Xóa sản phẩm khỏi giỏ
function xoa_khoi_gio($id)
{
    init_gio_hang();
    if (isset($_SESSION['gio_hang'][$id])) {
        unset($_SESSION['gio_hang'][$id]);
    }
}

// Tính tổng tiền giỏ hàng
function tinh_tong_gio()
{
    init_gio_hang();
    $tong = 0;
    foreach ($_SESSION['gio_hang'] as $id => $sp) {
        $tong += $sp['gia'] * $sp['so_luong'];
    }
    return $tong;
}
