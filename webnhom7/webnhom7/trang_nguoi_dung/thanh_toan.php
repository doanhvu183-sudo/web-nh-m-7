<?php
require_once __DIR__ . '/../giao_dien/header.php';
require_once __DIR__ . '/../cau_hinh/ket_noi.php';
require_once __DIR__ . '/../cau_hinh/ham.php';

init_gio_hang();

// Nếu giỏ hàng trống thì báo lỗi
if (empty($_SESSION['gio_hang'])) {
    echo "<div class='checkout-empty'>
            <p>Giỏ hàng đang trống.</p>
            <a href='trang_chu.php' class='btn-primary'>Tiếp tục mua sắm</a>
          </div>";
    require_once __DIR__ . '/../giao_dien/footer.php';
    exit;
}

$gio = $_SESSION['gio_hang'];
$tong = tinh_tong_gio();
?>

<link rel="stylesheet" href="../assets/css/checkout.css">

<div class="checkout-container">

    <h2>Thanh toán</h2>

    <form action="xu_ly_dat_hang.php" method="post" class="checkout-form">

        <!-- THÔNG TIN KHÁCH -->
        <div class="checkout-left">
            <h3>Thông tin nhận hàng</h3>

            <label>Họ tên *</label>
            <input type="text" name="ho_ten" required>

            <label>Số điện thoại *</label>
            <input type="text" name="so_dien_thoai" required>

            <label>Email</label>
            <input type="email" name="email">

            <label>Địa chỉ nhận hàng *</label>
            <textarea name="dia_chi" required></textarea>

            <label>Ghi chú</label>
            <textarea name="ghi_chu"></textarea>

            <h3>Phương thức thanh toán</h3>

            <div class="payment-methods">
                <label><input type="radio" name="pttt" value="COD" checked> Thanh toán khi nhận hàng (COD)</label>
                <label><input type="radio" name="pttt" value="Bank"> Chuyển khoản ngân hàng</label>
                <label><input type="radio" name="pttt" value="Visa"> Thẻ VISA/Mastercard</label>
            </div>
        </div>

        <!-- TÓM TẮT ĐƠN HÀNG -->
        <div class="checkout-right">
            <h3>Đơn hàng (<?= count($gio) ?> sản phẩm)</h3>

            <div class="checkout-items">
                <?php foreach ($gio as $sp): ?>
                    <div class="checkout-item">
                        <img src="../assets/img/<?= $sp['hinh'] ?>" alt="">
                        <div>
                            <p><?= $sp['ten'] ?></p>
                            <span>Số lượng: <?= $sp['so_luong'] ?></span>
                        </div>
                        <strong><?= dinh_dang_gia($sp['gia'] * $sp['so_luong']) ?></strong>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="checkout-total">
                <p>Tổng tiền:</p>
                <h3><?= dinh_dang_gia($tong) ?></h3>
            </div>

            <button type="submit" class="btn-primary btn-checkout">Xác nhận đặt hàng</button>
        </div>

    </form>

</div>

<?php
require_once __DIR__ . '/../giao_dien/footer.php';
