<?php
require_once __DIR__ . '/../giao_dien/header.php';
require_once __DIR__ . '/../cau_hinh/ket_noi.php';
require_once __DIR__ . '/../cau_hinh/ham.php';

// Lấy id danh mục
$id_dm = isset($_GET['id_danh_muc']) ? (int)$_GET['id_danh_muc'] : 0;

// Lấy thông tin danh mục
$dm = null;
if ($id_dm > 0) {
    $stmt = $pdo->prepare("SELECT * FROM DANHMUC WHERE id_danh_muc = :id");
    $stmt->execute(['id' => $id_dm]);
    $dm = $stmt->fetch();
}

// Lấy sản phẩm theo danh mục
if ($id_dm > 0) {
    $stmt = $pdo->prepare("SELECT * FROM SANPHAM WHERE id_danh_muc = :dm");
    $stmt->execute(['dm' => $id_dm]);
    $san_pham = $stmt->fetchAll();
} else {
    // Nếu không có id danh mục → hiện tất cả
    $san_pham = $pdo->query("SELECT * FROM SANPHAM ORDER BY id_san_pham DESC")->fetchAll();
}
?>

<link rel="stylesheet" href="../assets/css/category.css">

<div class="cat-container">

    <div class="cat-header">
        <h1><?= $dm ? htmlspecialchars($dm['ten_danh_muc']) : "TẤT CẢ SẢN PHẨM" ?></h1>
        <p><?= $dm ? htmlspecialchars($dm['mo_ta']) : "Khám phá toàn bộ sản phẩm Crocs™" ?></p>
    </div>

    <div class="product-grid">
        <?php if (count($san_pham) == 0): ?>
            <p>Không có sản phẩm nào.</p>

        <?php else: ?>
            <?php foreach ($san_pham as $sp): ?>
                <a href="chi_tiet_san_pham.php?id=<?= $sp['id_san_pham'] ?>" class="product-item">
                    <img src="../assets/img/<?= htmlspecialchars($sp['hinh_anh']) ?>" alt="">
                    <h3><?= htmlspecialchars($sp['ten_san_pham']) ?></h3>
                    <div class="price"><?= dinh_dang_gia($sp['gia']) ?></div>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</div>

<?php require_once __DIR__ . '/../giao_dien/footer.php'; ?>
