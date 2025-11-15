<?php
require_once __DIR__ . '/../cau_hinh/ket_noi.php';
require_once __DIR__ . '/../cau_hinh/ham.php';

init_gio_hang();

if (empty($_SESSION['gio_hang'])) {
    echo "<script>alert('Giỏ hàng trống!'); window.location='gio_hang.php';</script>";
    exit;
}

// LẤY ID USER - PHẢI CÓ
$id_user = $_SESSION['user']['id'] ?? null;

// LẤY THÔNG TIN FORM
$ho_ten = $_POST['ho_ten'];
$so_dien_thoai = $_POST['so_dien_thoai'];
$email = $_POST['email'];
$dia_chi = $_POST['dia_chi'];
$ghi_chu = $_POST['ghi_chu'];
$pttt = $_POST['pttt'];

$tong_tien = tinh_tong_gio();
$ma_don = 'DH' . time();

// ============================
// LƯU ĐƠN HÀNG
// ============================
$stmt = $pdo->prepare("
    INSERT INTO DONHANG (id_nguoi_dung, ma_don_hang, tong_tien, trang_thai)
    VALUES (:id_user, :ma_don, :tong_tien, 'Chờ xác nhận')
");

$stmt->execute([
    ':id_user' => $id_user,
    ':ma_don' => $ma_don,
    ':tong_tien' => $tong_tien
]);

$id_don_hang = $pdo->lastInsertId();

// ============================
// LƯU CHI TIẾT ĐƠN
// ============================
foreach ($_SESSION['gio_hang'] as $id_sp => $sp) {
    $stmt2 = $pdo->prepare("
        INSERT INTO CHITIET_DONHANG (id_don_hang, id_san_pham, so_luong, gia_ban)
        VALUES (:id_don, :id_sp, :sl, :gia)
    ");

    $stmt2->execute([
        ':id_don' => $id_don_hang,
        ':id_sp' => $id_sp,
        ':sl' => $sp['so_luong'],
        ':gia' => $sp['gia']
    ]);
}

unset($_SESSION['gio_hang']);

echo "<script>alert('Đặt hàng thành công!'); window.location='lich_su_mua_hang.php';</script>";
