<?php
require_once __DIR__ . '/../giao_dien/header.php';
require_once __DIR__ . '/../cau_hinh/ket_noi.php';
require_once __DIR__ . '/../cau_hinh/ham.php';

init_gio_hang();

$gio = $_SESSION['gio_hang'];
$tong = tinh_tong_gio();
?>

<link rel="stylesheet" href="../assets/css/gio_hang.css">

<div class="cart-container">

    <h2>Giỏ hàng của bạn</h2>

    <?php if (empty($gio)): ?>
        <p class="empty">Giỏ hàng đang trống.</p>
        <a href="trang_chu.php" class="btn-primary">Tiếp tục mua sắm</a>
    <?php else: ?>

        <div class="cart-list">

            <?php foreach ($gio as $id => $sp): ?>
                <div class="cart-item">

                    <img src="../assets/img/<?= $sp['hinh_anh'] ?>" class="cart-img">

                    <div class="cart-info">
                        <h3><?= $sp['ten'] ?></h3>
                        <p>Giá: <?= dinh_dang_gia($sp['gia']) ?></p>
                        <p>Số lượng: <?= $sp['so_luong'] ?></p>
                    </div>

                    <a href="xoa_khoi_gio.php?id=<?= $id ?>" class="remove">X</a>
                </div>
            <?php endforeach; ?>

        </div>

        <div class="cart-total">
            <p>Tổng tiền:</p>
            <h3><?= dinh_dang_gia($tong) ?></h3>

            <a class="btn-primary" href="thanh_toan.php">Tiến hành thanh toán</a>
        </div>

    <?php endif; ?>

</div>

<?php require_once __DIR__ . '/../giao_dien/footer.php'; ?>
