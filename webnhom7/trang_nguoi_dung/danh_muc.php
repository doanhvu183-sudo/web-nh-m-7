<?php
// trang_nguoi_dung/danh_muc.php
require_once __DIR__ . '/../giao_dien/header.php';

$id_danh_muc = isset($_GET['id_danh_muc']) ? (int)$_GET['id_danh_muc'] : 0;

if ($id_danh_muc > 0) {
    // Lấy tên danh mục
    $stmt = $pdo->prepare("SELECT * FROM DANHMUC WHERE id_danh_muc = :id");
    $stmt->execute([':id' => $id_danh_muc]);
    $danh_muc = $stmt->fetch();

    // Lấy sản phẩm theo danh mục
    $san_phams = lay_san_pham_theo_danh_muc($pdo, $id_danh_muc);
    $tieu_de_trang = $danh_muc ? $danh_muc['ten_danh_muc'] : 'Danh mục';
} else {
    // Không có id → lấy tất cả
    $stmt = $pdo->query("SELECT * FROM SANPHAM ORDER BY id_san_pham DESC");
    $san_phams = $stmt->fetchAll();
    $tieu_de_trang = 'Tất cả sản phẩm';
}
?>

<section class="section-sanpham">
    <h2><?= htmlspecialchars($tieu_de_trang) ?></h2>

    <?php if (empty($san_phams)): ?>
        <p>Không có sản phẩm nào trong danh mục này.</p>
    <?php else: ?>
        <div class="product-grid">
            <?php foreach ($san_phams as $sp): ?>
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
