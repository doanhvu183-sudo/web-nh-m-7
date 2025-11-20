<?php
require_once __DIR__ . '/../giao_dien/header.php';
require_once __DIR__ . '/../cau_hinh/ket_noi.php';
require_once __DIR__ . '/../cau_hinh/ham.php';

if (!isset($_GET['id'])) {
    echo "<h2>Sản phẩm không tồn tại!</h2>";
    require_once __DIR__ . '/../giao_dien/footer.php';
    exit;
}

$id = (int)$_GET['id'];

// Lấy sản phẩm
$stmt = $pdo->prepare("SELECT * FROM SANPHAM WHERE id_san_pham = :id");
$stmt->execute([':id'=>$id]);
$sp = $stmt->fetch();

if (!$sp) {
    echo "<h2>Sản phẩm không tồn tại!</h2>";
    require_once __DIR__ . '/../giao_dien/footer.php';
    exit;
}
?>

<link rel="stylesheet" href="../assets/css/chi_tiet_san_pham.css">

<div class="product-page">

    <!-- Hình ảnh bên trái -->
    <div class="product-images">
        <img src="../assets/img/<?= $sp['hinh_anh'] ?>" class="main-img">
    </div>

    <!-- Thông tin bên phải -->
    <div class="product-info">

        <h1 class="product-title"><?= htmlspecialchars($sp['ten_san_pham']) ?></h1>

        <div class="product-price">
            <?= dinh_dang_gia($sp['gia']) ?>
        </div>

        <div class="product-desc">
            <?= nl2br(htmlspecialchars($sp['mo_ta'])) ?>
        </div>

        <form action="them_vao_gio.php" method="POST" class="add-cart-form">
            <input type="hidden" name="id_san_pham" value="<?= $sp['id_san_pham'] ?>">

            <label>Số lượng</label>
            <input type="number" name="so_luong" value="1" min="1">

            <button type="submit" class="btn-add-cart">Thêm vào giỏ</button>
        </form>

        <div class="policy-box">
            <p><i class="fa fa-check-circle"></i> Giao nhanh toàn quốc</p>
            <p><i class="fa fa-check-circle"></i> Đổi trả trong 7 ngày</p>
            <p><i class="fa fa-check-circle"></i> Hỗ trợ 24/7</p>
        </div>

    </div>

</div>

<?php require_once __DIR__ . '/../giao_dien/footer.php'; ?>
