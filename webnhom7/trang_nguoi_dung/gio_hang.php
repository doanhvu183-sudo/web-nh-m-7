<?php
// trang_nguoi_dung/gio_hang.php
require_once __DIR__ . '/../giao_dien/header.php';

init_gio_hang();
$gio_hang = $_SESSION['gio_hang'];
$tong_tien = tinh_tong_gio();
?>

<section class="cart-section">
    <h2>Giỏ hàng của bạn</h2>

    <?php if (empty($gio_hang)): ?>
        <p>Giỏ hàng đang trống. <a href="danh_muc.php">Mua sắm ngay</a></p>
    <?php else: ?>
        <form action="cap_nhat_gio_hang.php" method="post">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($gio_hang as $id => $sp): ?>
                        <tr>
                            <td><?= htmlspecialchars($sp['ten']) ?></td>
                            <td>
                                <img class="cart-img" src="../assets/img/<?= htmlspecialchars($sp['hinh_anh']) ?>"
                                     alt="<?= htmlspecialchars($sp['ten']) ?>">
                            </td>
                            <td><?= dinh_dang_gia($sp['gia']) ?></td>
                            <td>
                                <input type="number" name="so_luong[<?= $id ?>]"
                                       value="<?= $sp['so_luong'] ?>" min="0">
                            </td>
                            <td><?= dinh_dang_gia($sp['gia'] * $sp['so_luong']) ?></td>
                            <td>
                                <a href="xoa_khoi_gio.php?id=<?= $id ?>" onclick="return confirm('Xóa sản phẩm này?');">
                                    Xóa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="cart-actions">
                <p><strong>Tổng tiền: <?= dinh_dang_gia($tong_tien) ?></strong></p>
                <button type="submit" class="btn">Cập nhật giỏ hàng</button>
                <a href="thanh_toan.php" class="btn btn-primary">Tiến hành thanh toán</a>
            </div>
        </form>
    <?php endif; ?>
</section>

<?php
require_once __DIR__ . '/../giao_dien/footer.php';
