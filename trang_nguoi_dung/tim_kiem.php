<?php include '../giao_dien/header.php'; ?>

<?php
$tu_khoa = $_GET['q'] ?? '';

$stmt = $conn->prepare("SELECT * FROM SANPHAM WHERE ten_san_pham LIKE ?");
$stmt->execute(["%$tu_khoa%"]);
$ds_sp = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2 class="title">Kết quả tìm kiếm: "<?= htmlspecialchars($tu_khoa) ?>"</h2>

<?php 
if (count($ds_sp) == 0) {
    echo "<p class='noti'>Không tìm thấy sản phẩm nào</p>";
} else {
    include '../giao_dien/product_grid.php';
}
?>

<?php include '../giao_dien/footer.php'; ?>
