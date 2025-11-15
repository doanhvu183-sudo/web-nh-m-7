<?php
// trang_nguoi_dung/chi_tiet_san_pham.php
require_once __DIR__ . '/../giao_dien/header.php';

$id_san_pham = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$san_pham = lay_san_pham_theo_id($pdo, $id_san_pham);

if (!$san_pham) {
    echo "<p>Sản phẩm không tồn tại.</p>";
    require_once __DIR__ . '/../giao_dien/footer.php';
    exit;
}
?>

<section class="product-detail">
    <div class="product-detail-left">
        <img src="../assets/img/<?= htmlspecialchars($san_pham['hinh_anh']) ?>"
             alt="<?= htmlspecialchars($san_pham['ten_san_pham']) ?>">
    </div>
    <div class="product-detail-right">
        <h1><?= htmlspecialchars($san_pham['ten_san_pham']) ?></h1>
        <p class="pd-price"><?= dinh_dang_gia($san_pham['gia']) ?></p>
        <p class="pd-desc"><?= nl2br(htmlspecialchars($san_pham['mo_ta'])) ?></p>

        <form action="them_vao_gio.php" method="post" class="pd-form">
            <input type="hidden" name="id_san_pham" value="<?= $san_pham['id_san_pham'] ?>">
            <label>Số lượng:</label>
            <input type="number" name="so_luong" value="1" min="1">
            <button type="submit" class="btn">Thêm vào giỏ</button>
        </form>

        <div class="pd-extra">
            <p>✔ Hàng chính hãng</p>
            <p>✔ Đổi trả trong 7 ngày nếu lỗi nhà sản xuất</p>
            <p>✔ Giao hàng toàn quốc</p>
        </div>
    </div>
</section>

<?php
require_once __DIR__ . '/../giao_dien/footer.php';
