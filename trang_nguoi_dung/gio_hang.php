<?php
session_start();
require_once "../includes/db.php";
require_once "../includes/functions_cart.php";

require_login();
$id_nguoi_dung = get_user_id();

// xử lý update/remove
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type'] ?? '';
    $id_sp = (int)($_POST['id_san_pham'] ?? 0);

    if ($type === 'update') {
        $qty = (int)($_POST['so_luong'] ?? 1);
        update_cart_qty($pdo, $id_nguoi_dung, $id_sp, $qty);
    }
    if ($type === 'remove') {
        remove_item($pdo, $id_nguoi_dung, $id_sp);
    }
    header("Location: gio_hang.php");
    exit;
}

$items = get_cart_items($pdo, $id_nguoi_dung);

// tổng tiền
$tong = 0;
foreach($items as $it){
    $tong += $it['so_luong'] * $it['gia'];
}
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8" />
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="../assets/css/shop.css">
</head>
<body>
<?php include "../giao_dien/header.php"; ?>

<div class="container cart-page">
    <div class="cart-left">
        <h2>Giỏ hàng của bạn</h2>

        <?php if(empty($items)): ?>
            <div class="empty-box">
                Giỏ hàng đang trống.
                <a class="btn btn-outline" href="danh_muc.php?loai=all">Tiếp tục mua sắm</a>
            </div>
        <?php else: ?>
            <?php foreach($items as $it): 
                $lineTotal = $it['so_luong'] * $it['gia'];
            ?>
            <div class="cart-item">
                <div class="ci-img">
                    <img src="../assets/img/<?= htmlspecialchars($it['hinh_anh']) ?>" alt="">
                </div>
                <div class="ci-info">
                    <a class="ci-name" href="chi_tiet_san_pham.php?id=<?= (int)$it['id_san_pham'] ?>">
                        <?= htmlspecialchars($it['ten_san_pham']) ?>
                    </a>
                    <div class="ci-price"><?= format_vnd($it['gia']) ?></div>

                    <form class="ci-qty" method="post">
                        <input type="hidden" name="type" value="update">
                        <input type="hidden" name="id_san_pham" value="<?= (int)$it['id_san_pham'] ?>">
                        <button type="button" class="qty-btn" data-action="minus">-</button>
                        <input class="qty-input" name="so_luong" type="number" min="1" max="<?= (int)$it['ton_kho'] ?>" value="<?= (int)$it['so_luong'] ?>">
                        <button type="button" class="qty-btn" data-action="plus">+</button>
                        <button class="btn-link" type="submit">Cập nhật</button>
                    </form>

                    <form method="post" class="ci-remove">
                        <input type="hidden" name="type" value="remove">
                        <input type="hidden" name="id_san_pham" value="<?= (int)$it['id_san_pham'] ?>">
                        <button type="submit" class="btn-link danger">Xóa</button>
                    </form>
                </div>

                <div class="ci-total"><?= format_vnd($lineTotal) ?></div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div class="cart-right">
        <div class="summary-box">
            <h3>Tóm tắt đơn hàng</h3>
            <div class="sum-row">
                <span>Tạm tính</span>
                <strong><?= format_vnd($tong) ?></strong>
            </div>
            <div class="sum-row">
                <span>Phí vận chuyển</span>
                <strong>Miễn phí</strong>
            </div>
            <div class="sum-row total">
                <span>Tổng cộng</span>
                <strong><?= format_vnd($tong) ?></strong>
            </div>

            <a class="btn btn-primary w100" href="thanh_toan.php">Tiến hành thanh toán</a>
            <a class="btn btn-outline w100" href="danh_muc.php?loai=all">Tiếp tục mua sắm</a>
        </div>
    </div>
</div>

<script>
document.querySelectorAll(".ci-qty").forEach(form=>{
    const input = form.querySelector(".qty-input");
    form.querySelectorAll(".qty-btn").forEach(btn=>{
        btn.addEventListener("click", ()=>{
            let v = parseInt(input.value||1);
            let max = parseInt(input.max||999);
            if(btn.dataset.action==="minus") v = Math.max(1, v-1);
            else v = Math.min(max, v+1);
            input.value = v;
        });
    });
});
</script>

<?php include "../giao_dien/footer.php"; ?>
</body>
</html>
