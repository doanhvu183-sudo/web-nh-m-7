<?php
// trang_nguoi_dung/tim_kiem.php
require_once __DIR__ . '/../giao_dien/header.php';

$keyword = isset($_GET['q']) ? trim($_GET['q']) : '';
$ket_qua = [];

if ($keyword !== '') {
    $ket_qua = tim_kiem_san_pham($pdo, $keyword);
}
?>

<section class="section-sanpham">
    <h2>Kết quả tìm kiếm: "<?= htmlspecialchars($keyword) ?>"</h2>

    <?php if ($keyword === ''): ?>
        <p>Vui lòng nhập từ khóa tìm kiếm.</p>
    <?php elseif (empty($ket_qua)): ?>
        <p>Không tìm thấy sản phẩm phù hợp.</p>
    <?php else: ?>
        <div class="product-grid">
            <?php foreach ($ket_qua as $sp): ?>
                <div class="product-item">
                    <img src="../assets/img/<?= htmlspecialchars($sp['hinh_anh']) ?>"
                         alt="<?= htmlspecialchars($sp['ten_san_pham']) ?>">
                    <h3><?= htmlspecialchars($sp['ten_san_pham']) ?></h3>
                    <div class="price"><?= dinh_dang_gia($sp['gia']) ?></div>
                    <a class="btn" href="chi_tiet_san_pham.php?id=<?= $sp['id_san_pham'] ?>">Xem chi tiết</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<?php
require_once __DIR__ . '/../giao_dien/footer.php';
