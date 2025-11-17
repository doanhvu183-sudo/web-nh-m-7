<?php
require_once __DIR__ . '/../giao_dien/header.php';
require_once __DIR__ . '/../cau_hinh/ket_noi.php';
require_once __DIR__ . '/../cau_hinh/ham.php';

// Lấy ID danh mục
$id_dm = isset($_GET['id_danh_muc']) ? (int)$_GET['id_danh_muc'] : 0;

// Lấy thông tin danh mục
$dm = null;
if ($id_dm > 0) {
    $stmt = $pdo->prepare("SELECT * FROM DANHMUC WHERE id_danh_muc = :id");
    $stmt->execute([':id' => $id_dm]);
    $dm = $stmt->fetch();
}

// Lấy danh sách sản phẩm
if ($id_dm > 0 && $dm) {
    $sp = lay_san_pham_theo_danh_muc($pdo, $id_dm);
} else {
    // Nếu danh mục không tồn tại → chuyển sang "tất cả sản phẩm"
    $sp = $pdo->query("SELECT * FROM SANPHAM ORDER BY id_san_pham DESC")->fetchAll();
}
?>

<link rel="stylesheet" href="../assets/css/category.css">

<div class="cat-container">

    <!-- HEADER DANH MỤC -->
    <div class="cat-header">
        <h1><?= $dm ? htmlspecialchars($dm['ten_danh_muc']) : "Tất cả sản phẩm" ?></h1>
        <p><?= $dm ? htmlspecialchars($dm['mo_ta']) : "Khám phá toàn bộ sản phẩm Crocs mới nhất." ?></p>
    </div>

    <!-- DANH SÁCH SẢN PHẨM -->
    <div class="product-grid">

        <?php if (empty($sp)): ?>
            <div class="empty-category">
                <p>Danh mục hiện chưa có sản phẩm.</p>
                <a href="trang_chu.php" class="btn-primary">Quay lại trang chủ</a>
            </div>
        <?php else: ?>

            <?php foreach ($sp as $item): ?>
                <a href="chi_tiet_san_pham.php?id=<?= $item['id_san_pham'] ?>" class="product-item">

                    <img src="../assets/img/<?= htmlspecialchars($item['hinh_anh']) ?>"
                         alt="<?= htmlspecialchars($item['ten_san_pham']) ?>">

                    <h3><?= htmlspecialchars($item['ten_san_pham']) ?></h3>

                    <div class="price">
                        <?= dinh_dang_gia($item['gia']) ?>
                    </div>
                </a>
            <?php endforeach; ?>

        <?php endif; ?>

    </div>
</div>

<?php require_once __DIR__ . '/../giao_dien/footer.php'; ?>
