<?php
require_once __DIR__ . '/../giao_dien/header.php';
require_once __DIR__ . '/../cau_hinh/ket_noi.php';

// lấy id sản phẩm
$id = $_GET['id'] ?? 0;
$id = intval($id);

$sp = $pdo->prepare("SELECT * FROM SANPHAM WHERE id_san_pham = :id");
$sp->execute([':id' => $id]);
$sp = $sp->fetch();

if (!$sp) {
    echo "<h2>Sản phẩm không tồn tại.</h2>";
    require_once __DIR__ . '/../giao_dien/footer.php';
    exit;
}

// lấy sản phẩm liên quan cùng danh mục
$related = $pdo->prepare("
    SELECT * FROM SANPHAM 
    WHERE id_danh_muc = :dm AND id_san_pham != :id 
    ORDER BY RAND() 
    LIMIT 8
");
$related->execute([
    ':dm' => $sp['id_danh_muc'],
    ':id' => $sp['id_san_pham']
]);
$ds_lien_quan = $related->fetchAll();
?>

<link rel="stylesheet" href="../assets/css/product.css">

<div class="product-detail">

    <!-- Ảnh lớn -->
    <div class="pd-left">
        <img class="main-img" src="../assets/img/<?= $sp['hinh_anh'] ?>" alt="">
    </div>

    <!-- Nội dung -->
    <div class="pd-right">
        <h1><?= $sp['ten_san_pham'] ?></h1>

        <div class="pd-price">
            <?= dinh_dang_gia($sp['gia']) ?>
        </div>

        <p class="pd-desc">
            <?= nl2br($sp['mo_ta']) ?>
        </p>

        <form action="them_vao_gio.php" method="post">
            <input type="hidden" name="id_san_pham" value="<?= $sp['id_san_pham'] ?>">

            <label>Số lượng:</label>
            <input type="number" name="so_luong" value="1" min="1" class="pd-qty">

            <button type="submit" class="btn-primary pd-add">
                Thêm vào giỏ hàng
