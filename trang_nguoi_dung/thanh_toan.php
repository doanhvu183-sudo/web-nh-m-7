<?php
session_start();
require_once "../includes/db.php";
require_once "../includes/functions_cart.php";

require_login();
$id_nguoi_dung = get_user_id();
$items = get_cart_items($pdo, $id_nguoi_dung);

if (empty($items)) {
    header("Location: gio_hang.php");
    exit;
}

$tong = 0;
foreach($items as $it){
    $tong += $it['so_luong'] * $it['gia'];
}

$err = "";
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $ho_ten = trim($_POST['ho_ten_nhan'] ?? "");
    $sdt = trim($_POST['so_dien_thoai_nhan'] ?? "");
    $dia_chi = trim($_POST['dia_chi_nhan'] ?? "");
    $ghi_chu = trim($_POST['ghi_chu'] ?? "");
    $phuong_thuc = "COD";

    if ($ho_ten=="" || $sdt=="" || $dia_chi=="") {
        $err = "Vui lòng nhập đầy đủ thông tin nhận hàng.";
    } else {
        try {
            $pdo->beginTransaction();

            // tạo mã đơn
            $ma_don = "DH" . date("YmdHis") . rand(100,999);

            $ins = $pdo->prepare("
                INSERT INTO donhang(id_nguoi_dung, ma_don_hang, tong_tien, trang_thai, phuong_thuc, ngay_dat, ho_ten_nhan, so_dien_thoai_nhan, dia_chi_nhan, ghi_chu)
                VALUES(?, ?, ?, 'Chờ xác nhận', ?, NOW(), ?, ?, ?, ?)
            ");
            $ins->execute([$id_nguoi_dung, $ma_don, $tong, $phuong_thuc, $ho_ten, $sdt, $dia_chi, $ghi_chu]);
            $id_don_hang = $pdo->lastInsertId();

            // insert chi tiết + trừ kho
            $ct = $pdo->prepare("
                INSERT INTO chitiet_donhang(id_don_hang, id_san_pham, so_luong, gia)
                VALUES(?, ?, ?, ?)
            ");
            $tru = $pdo->prepare("
                UPDATE sanpham SET so_luong = so_luong - ?
                WHERE id_san_pham = ? AND so_luong >= ?
            ");

            foreach($items as $it){
                $ct->execute([$id_don_hang, $it['id_san_pham'], $it['so_luong'], $it['gia']]);

                $tru->execute([$it['so_luong'], $it['id_san_pham'], $it['so_luong']]);
                if ($tru->rowCount() == 0) {
                    throw new Exception("Sản phẩm ".$it['ten_san_pham']." không đủ tồn kho.");
                }
            }

            // xóa giỏ
            $id_gio_hang = $items[0]['id_gio_hang'];
            $pdo->prepare("DELETE FROM chitiet_giohang WHERE id_gio_hang=?")->execute([$id_gio_hang]);
            $pdo->prepare("UPDATE giohang SET tong_tien=0 WHERE id_gio_hang=?")->execute([$id_gio_hang]);

            $pdo->commit();

            header("Location: cam_on.php?ma=" . urlencode($ma_don));
            exit;

        } catch(Exception $e){
            $pdo->rollBack();
            $err = $e->getMessage();
        }
    }
}
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8" />
    <title>Thanh toán</title>
    <link rel="stylesheet" href="../assets/css/shop.css">
</head>
<body>
<?php include "../giao_dien/header.php"; ?>

<div class="container checkout-page">
    <div class="checkout-left">
        <h2>Thông tin nhận hàng</h2>

        <?php if($err): ?>
            <div class="alert"><?= htmlspecialchars($err) ?></div>
        <?php endif; ?>

        <form method="post" class="checkout-form">
            <label>Họ tên người nhận</label>
            <input type="text" name="ho_ten_nhan" required>

            <label>Số điện thoại</label>
            <input type="text" name="so_dien_thoai_nhan" required>

            <label>Địa chỉ nhận hàng</label>
            <input type="text" name="dia_chi_nhan" required>

            <label>Ghi chú (tuỳ chọn)</label>
            <textarea name="ghi_chu" rows="3"></textarea>

            <div class="pay-method">
                <label><input type="radio" checked> Thanh toán khi nhận hàng (COD)</label>
            </div>

            <button class="btn btn-primary w100" type="submit">Xác nhận đặt hàng</button>
        </form>
    </div>

    <div class="checkout-right">
        <div class="summary-box">
            <h3>Đơn hàng</h3>

            <?php foreach($items as $it): ?>
                <div class="mini-item">
                    <img src="../assets/img/<?= htmlspecialchars($it['hinh_anh']) ?>" alt="">
                    <div>
                        <div class="mini-name"><?= htmlspecialchars($it['ten_san_pham']) ?></div>
                        <div class="mini-qty">SL: <?= (int)$it['so_luong'] ?></div>
                    </div>
                    <div class="mini-price"><?= format_vnd($it['so_luong']*$it['gia']) ?></div>
                </div>
            <?php endforeach; ?>

            <div class="sum-row total">
                <span>Tổng cộng</span>
                <strong><?= format_vnd($tong) ?></strong>
            </div>
        </div>
    </div>
</div>

<?php include "../giao_dien/footer.php"; ?>
</body>
</html>
