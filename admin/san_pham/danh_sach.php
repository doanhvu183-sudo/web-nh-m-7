<?php
include_once __DIR__ . "/../includes/db.php";

// Lấy danh sách sản phẩm
$sql = "SELECT * FROM sanpham ORDER BY id_san_pham DESC";
$products = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);

$title = "Danh sách sản phẩm";
$view_file = __FILE__; // load chính file này
?>

<style>
.page-title {
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 16px;
}

/* WRAPPER */
.product-wrapper {
    background: var(--card-bg);
    padding: 18px;
    border-radius: 14px;
    box-shadow: 0 3px 12px rgba(0,0,0,0.05);
}

/* BUTTON */
.btn-add {
    background: #4f46e5;
    padding: 10px 16px;
    border-radius: 8px;
    color: white;
    font-size: 14px;
    margin-bottom: 18px;
    display: inline-block;
}

/* TABLE */
.product-table {
    width: 100%;
    border-collapse: collapse;
}

.product-table th {
    background: #f3f4f6;
    padding: 12px;
    font-size: 14px;
    color: #374151;
    text-align: left;
}

.product-table td {
    padding: 12px;
    border-bottom: 1px solid #e5e7eb80;
    font-size: 14px;
}

.product-table tr:hover {
    background: #f9fafb;
}

/* Ảnh sản phẩm */
.thumb {
    width: 55px;
    height: 55px;
    border-radius: 8px;
    object-fit: cover;
    cursor: pointer;
}

.thumb-large {
    display: none;
    position: absolute;
    left: 70px;
    top: 0;
    background: white;
    padding: 6px;
    border-radius: 10px;
    box-shadow: 0 4px 14px rgba(0,0,0,0.15);
}

.thumb:hover + .thumb-large {
    display: block;
}

/* ACTION BUTTON */
.btn-action {
    padding: 6px 10px;
    background: #f3f4f6;
    border-radius: 8px;
    margin-right: 6px;
    display: inline-block;
    color: #374151;
}
.btn-action:hover { background: #e5e7eb; }
</style>

<h2 class="page-title">Danh sách sản phẩm</h2>

<div class="product-wrapper">

    <a class="btn-add" href="them.php"><i class="fa-solid fa-plus"></i> Thêm sản phẩm</a>

    <table class="product-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Ảnh</th>
            <th>Sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Hành động</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($products as $p): ?>
        <tr>
            <td>#<?= $p["id_san_pham"] ?></td>

            <td style="position:relative;">
                <img src="/webnhom7/assets/img/<?= $p["hinh_anh"] ?>" class="thumb">
                <img src="/webnhom7/assets/img/<?= $p["hinh_anh"] ?>" class="thumb-large" width="150">
            </td>

            <td><?= $p["ten_san_pham"] ?></td>
            <td><?= number_format($p["gia"]) ?> đ</td>
            <td><?= $p["so_luong"] ?></td>

            <td>
                <a href="sua.php?id=<?= $p["id_san_pham"] ?>" class="btn-action"><i class="fa-solid fa-pen"></i></a>
                <a href="xoa.php?id=<?= $p["id_san_pham"] ?>" class="btn-action" style="color:#dc2626;">
                    <i class="fa-solid fa-trash"></i>
                </a>
            </td>
        </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>
