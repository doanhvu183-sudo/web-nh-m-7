<?php
require_once __DIR__ . '/../giao_dien/header.php';
require_once __DIR__ . '/../cau_hinh/ket_noi.php';
require_once __DIR__ . '/../cau_hinh/ham.php';

if (!isset($_GET['id'])) {
    echo "<p>Không tìm thấy sản phẩm.</p>";
    require_once __DIR__ . '/../giao_dien/footer.php';
    exit;
}

$id = (int)$_GET['id'];

// Lấy thông tin sản phẩm
$stmt = $pdo->prepare("
    SELECT s.*, d.ten_danh_muc 
    FROM SANPHAM s
    LEFT JOIN DANHMUC d ON s.id_danh_muc = d.id_danh_muc
    WHERE s.id_san_pham = :id
");
$stmt->execute([':id' => $id]);
$sp = $stmt->fetch();

if (!$sp) {
    echo "<p>Không tìm thấy sản phẩm.</p>";
    require_once __DIR__ . '/../giao_dien/footer.php';
    exit;
}

// Lấy sản phẩm liên quan (cùng danh mục)
$related = [];
if (!empty($sp['id_danh_muc'])) {
    $stmt2 = $pdo->prepare("
        SELECT * FROM SANPHAM 
        WHERE id_danh_muc = :dm AND id_san_pham <> :id
        ORDER BY id_san_pham DESC
        LIMIT 8
    ");
    $stmt2->execute([
        ':dm' => $sp['id_danh_muc'],
        ':id' => $sp['id_san_pham']
    ]);
    $related = $stmt2->fetchAll();
}
?>

<link rel="stylesheet" href="../assets/css/product_detail.css">

<div class="pd-container">
    <div class="pd-main">
        <!-- ẢNH LỚN -->
        <div class="pd-image">
            <img src="../assets/img/<?= htmlspecialchars($sp['hinh_anh']) ?>" 
                 alt="<?= htmlspecialchars($sp['ten_san_pham']) ?>">
        </div>

        <!-- THÔNG TIN CHI TIẾT -->
        <div class="pd-info">
            <p class="pd-breadcrumb">
                <a href="trang_chu.php">Trang chủ</a> /
                <?php if (!empty($sp['ten_danh_muc'])): ?>
                    <a href="danh_muc.php?id_danh_muc=<?= $sp['id_danh_muc'] ?>">
                        <?= htmlspecialchars($sp['ten_danh_muc']) ?>
                    </a> /
                <?php endif; ?>
                <span><?= htmlspecialchars($sp['ten_san_pham']) ?></span>
            </p>

            <h1><?= htmlspecialchars($sp['ten_san_pham']) ?></h1>

            <div class="pd-price">
                <?= dinh_dang_gia($sp['gia']) ?>
            </div>

            <p class="pd-short-desc">
                <?= nl2br(htmlspecialchars($sp['mo_ta'])) ?>
            </p>

            <form action="them_vao_gio.php" method="get" class="pd-cart-form">
                <input type="hidden" name="id" value="<?= $sp['id_san_pham'] ?>">

                <label>Số lượng</label>
                <input type="number" name="so_luong" value="1" min="1" class="pd-qty">

                <button type="submit" class="btn-primary pd-btn-add">
                    Thêm vào giỏ
                </button>
            </form>

            <ul class="pd-meta">
                <li>Mã sản phẩm: #<?= $sp['id_san_pham'] ?></li>
                <?php if (!empty($sp['ten_danh_muc'])): ?>
                    <li>Danh mục: <?= htmlspecialchars($sp['ten_danh_muc']) ?></li>
                <?php endif; ?>
                <li>Tình trạng: 
                    <?= ($sp['so_luong'] > 0) ? 'Còn hàng' : 'Hết hàng' ?>
                </li>
            </ul>
        </div>
    </div>

    <?php if ($related): ?>
    <div class="pd-related">
        <h2>Sản phẩm liên quan</h2>
        <div class="product-grid">
            <?php foreach ($related as $r): ?>
                <a href="chi_tiet_san_pham.php?id=<?= $r['id_san_pham'] ?>" class="product-item">
                    <img src="../assets/img/<?= htmlspecialchars($r['hinh_anh']) ?>" alt="">
                    <h3><?= htmlspecialchars($r['ten_san_pham']) ?></h3>
                    <div class="price"><?= dinh_dang_gia($r['gia']) ?></div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../giao_dien/footer.php'; ?>
