<?php
require_once __DIR__ . '/../giao_dien/header.php';
require_once __DIR__ . '/../cau_hinh/ham.php';

init_gio_hang();
$gio = $_SESSION['gio_hang'];
$tong = tinh_tong_gio();
?>

<link rel="stylesheet" href="../assets/css/cart.css">

<div class="cart-container">
    <h1>Giỏ hàng</h1>

    <?php if (empty($gio)): ?>
        <p>Giỏ hàng của bạn đang trống.</p>
        <a href="trang_chu.php" class="btn-primary">Tiếp tục mua sắm</a>
    <?php else: ?>

        <div class="cart-layout">
            <div class="cart-left">
                <?php foreach ($gio as $id => $sp): ?>
                    <div class="cart-item">
                        <div class="cart-img">
                            <img src="../assets/img/<?= htmlspecialchars($sp['hinh_anh']) ?>" alt="">
                        </div>
                        <div class="cart-info">
                            <h3><?= htmlspecialchars($sp['ten']) ?></h3>
                            <p>Giá: <?= dinh_dang_gia($sp['gia']) ?></p>

                            <form action="cap_nhat_gio_hang.php" method="post" class="cart-qty-form">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                <label>Số lượng</label>
                                <input type="number" name="so_luong" value="<?= $sp['so_luong'] ?>" min="1">
                                <button type="submit">Cập nhật</button>
                            </form>

                            <a href="xoa_khoi_gio.php?id=<?= $id ?>" class="cart-remove"
                               onclick="return confirm('Xóa sản phẩm này khỏi giỏ?');">
                                Xóa
                            </a>
                        </div>
                        <div class="cart-line-total">
                            <?= dinh_dang_gia($sp['gia'] * $sp['so_luong']) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="cart-right">
                <h2>Tổng tiền</h2>
                <p class="cart-sum"><?= dinh_dang_gia($tong) ?></p>
                <a href="thanh_toan.php" class="btn-primary cart-checkout">Tiến hành thanh toán</a>
                <a href="trang_chu.php" class="btn-outline">Tiếp tục mua sắm</a>
            </div>
        </div>

    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../giao_dien/footer.php'; ?>
