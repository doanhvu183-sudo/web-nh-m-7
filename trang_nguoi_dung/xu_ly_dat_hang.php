<?php
require_once __DIR__ . '/../cau_hinh/ket_noi.php';
require_once __DIR__ . '/../cau_hinh/ham.php';

if (session_status() === PHP_SESSION_NONE) session_start();
init_gio_hang();

if (!isset($_SESSION['user'])) {
    header("Location: ../tai_khoan/dang_nhap.php?err=Vui lòng đăng nhập để đặt hàng");
    exit;
}

$gio = $_SESSION['gio_hang'];
if (empty($gio)) {
    header("Location: gio_hang.php");
    exit;
}

$id_user = $_SESSION['user']['id'] ?? $_SESSION['user']['id_nguoi_dung'] ?? 0;

$ho_ten = trim($_POST['ho_ten'] ?? '');
$sdt    = trim($_POST['so_dien_thoai'] ?? '');
$email  = trim($_POST['email'] ?? '');
$dia_chi= trim($_POST['dia_chi'] ?? '');
$ghi_chu= trim($_POST['ghi_chu'] ?? '');
$pttt   = $_POST['pttt'] ?? 'COD';

$tong = tinh_tong_gio();
$ma_don = "DH" . date("YmdHis");

try {
    $pdo->beginTransaction();

    // 1) Tạo đơn hàng
    $stmt = $pdo->prepare("
        INSERT INTO DONHANG (id_nguoi_dung, ma_don_hang, tong_tien, trang_thai)
        VALUES (:id_user, :ma, :tong, 'Chờ xác nhận')
    ");
    $stmt->execute([
        ':id_user' => $id_user,
        ':ma'      => $ma_don,
        ':tong'    => $tong
    ]);

    $id_don = $pdo->lastInsertId();

    // 2) Thêm chi tiết đơn + trừ tồn kho
    $insCT = $pdo->prepare("
        INSERT INTO CHITIET_DONHANG (id_don_hang, id_san_pham, so_luong, gia_ban)
        VALUES (:id_don, :id_sp, :sl, :gia)
    ");

    $updKho = $pdo->prepare("
        UPDATE SANPHAM 
        SET so_luong = so_luong - :sl
        WHERE id_san_pham = :id_sp AND so_luong >= :sl
    ");

    foreach ($gio as $id_sp => $sp) {
        $sl  = (int)$sp['so_luong'];
        $gia = (float)$sp['gia'];

        // insert chi tiết
        $insCT->execute([
            ':id_don' => $id_don,
            ':id_sp'  => $id_sp,
            ':sl'     => $sl,
            ':gia'    => $gia
        ]);

        // trừ kho
        $updKho->execute([
            ':sl'    => $sl,
            ':id_sp' => $id_sp
        ]);

        if ($updKho->rowCount() == 0) {
            throw new Exception("Sản phẩm ID $id_sp không đủ tồn kho.");
        }
    }

    $pdo->commit();

    // 3) Xóa giỏ
    $_SESSION['gio_hang'] = [];

    header("Location: lich_su_mua_hang.php?msg=Đặt hàng thành công! Mã đơn: $ma_don");
    exit;

} catch (Exception $e) {
    $pdo->rollBack();
    header("Location: thanh_toan.php?err=" . urlencode($e->getMessage()));
    exit;
}
