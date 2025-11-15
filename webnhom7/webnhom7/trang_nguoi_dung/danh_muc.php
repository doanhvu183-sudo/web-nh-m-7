<?php
require_once __DIR__ . '/../giao_dien/header.php';

// Lấy danh mục
$id_dm = $_GET['id_danh_muc'] ?? 0;

// Lấy tên danh mục
if ($id_dm > 0) {
    $dm = $pdo->query("SELECT * FROM DANHMUC WHERE id_danh_muc = $id_dm")->fetch();
    $ten_dm = $dm ? $dm['ten_danh_muc'] : "Sản phẩm";
} else {
    $ten_dm = "Tất cả sản phẩm";
}

// Phân trang
$sp_moi_trang = 12;
$trang = $_GET['trang'] ?? 1;
$bat_dau = ($trang - 1) * $sp_moi_trang;

// Lọc theo danh mục
$where = $id_dm > 0 ? "WHERE id_danh_muc = $id_dm" : "";

// Lấy sản phẩm
$sql = "SELECT * FROM SANPHAM $where ORDER BY id_san_pham DESC LIMIT $bat_dau, $sp_moi_trang";
$ds_sp = $pdo->query($sql)->fetchAll();

// Tổng số sản phẩm
$tong_sp = $pdo->query("SELECT COUNT(*) FROM SANPHAM $where")->fetchColumn();
$so_trang = ceil($tong_sp / $sp_moi_trang);
?>

<div class="category-page">

    <h2><?= $ten_dm ?></h2>

    <!-- Lưới sản phẩm -->
    <div class="product-grid">
        <?php foreach ($ds_sp as $sp): ?>
            <div class="product-item">
                <img src="../assets/img/<?= $sp['hinh_anh'] ?>" alt="">
                <h3><?= $sp['ten_san_pham'] ?></h3>
                <div class="price"><?= dinh_dang_gia($sp['gia']) ?></div>

                <a class="btn btn-outline"
                   href="chi_tiet_san_pham.php?id=<?= $sp['id_san_pham'] ?>">Xem chi tiết</a>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- PHÂN TRANG -->
    <div class="pagination">
        <?php for ($i = 1; $i <= $so_trang; $i++): ?>
            <a class="<?= $i == $trang ? 'active' : '' ?>"
               href="danh_muc.php?id_danh_muc=<?= $id_dm ?>&trang=<?= $i ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>

</div>

<?php
require_once __DIR__ . '/../giao_dien/footer.php';
