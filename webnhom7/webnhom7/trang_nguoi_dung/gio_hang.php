<?php
require_once __DIR__ . '/../giao_dien/header.php';
require_once __DIR__ . '/../cau_hinh/ket_noi.php';
require_once __DIR__ . '/../cau_hinh/ham.php';

init_gio_hang();
$gio = $_SESSION['gio_hang'];
?>

<link rel="stylesheet" href="../assets/css/cart.css">

<div class="cart-container">

    <h2>Giỏ hàng của bạn</h2>

    <?php if (empty($gio)) : ?>
        <p class="empty-cart">Giỏ hàng đang trống.</p>
        <a href="trang_chu.php" class="btn-primary">Tiếp tục mua sắm</a>
    <?php else : ?>

        <table class="cart-table">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?php 
                $tong = 0;
                foreach ($gio as $id => $sp): 
                    $thanh_tien = $sp['gia'] * $sp['so_luong'];
                    $tong += $thanh_tien;
                ?>
                <tr>
                    <td class="p-info">
                        <img src="../assets/img/<?= $sp['hinh'] ?>" alt="">
                        <span><?= $sp['ten'] ?></span>
                    </td>

                    <td><?= dinh_dang_gia($sp['gia']) ?></td>

                    <td>
                        <form action="cap_nhat_gio_hang.php" method="post">
                            <input type="hidden" name="id_san_pham" value="<?= $id ?>">
                            <input type="number" class="qty-input" name="so_luong" value="<?= $sp['so_luong'] ?>" min="1">
                            <button type="submit" class="btn-update">Cập nhật</button>
                        </form>
                    </td>

                    <td><?= dinh_dang_gia($thanh_tien) ?></td>

                    <td>
                        <a class="btn-remove" href="xoa_khoi_gio.php?id=<?= $id ?>">X</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="cart-total">
            <h3>Tổng tiền: <?= dinh_dang_gia($tong) ?></h3>
            <a href="thanh_toan.php" class="btn-primary checkout-btn">Tiến hành thanh toán</a>
        </div>

    <?php endif; ?>
</div>

<?php
require_once __DIR__ . '/../giao_dien/footer.php';
