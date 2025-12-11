<?php
include_once __DIR__ . "/../includes/db.php";

$id = $_GET["id"] ?? 0;

/* LẤY ĐƠN HÀNG */
$sql = "SELECT * FROM donhang WHERE id_don_hang = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);
$don = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$don) {
    die("Không tìm thấy đơn hàng!");
}

/* LẤY SẢN PHẨM */
$sql_items = "
    SELECT ct.*, sp.ten_san_pham, sp.hinh_anh, sp.gia
    FROM chitiet_donhang ct
    JOIN sanpham sp ON sp.id_san_pham = ct.id_san_pham
    WHERE ct.id_don_hang = ?
";
$stmt_items = $conn->prepare($sql_items);
$stmt_items->execute([$id]);
$items = $stmt_items->fetchAll(PDO::FETCH_ASSOC);

/* CẬP NHẬT */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $ho_ten = $_POST["ho_ten"];
    $so_dien_thoai = $_POST["so_dien_thoai"];
    $dia_chi = $_POST["dia_chi"];
    $ghi_chu = $_POST["ghi_chu"];
    $trang_thai = $_POST["trang_thai"];

    $sql_update = "
        UPDATE donhang 
        SET ho_ten_nhan=?, so_dien_thoai_nhan=?, dia_chi_nhan=?, ghi_chu=?, trang_thai=?
        WHERE id_don_hang=?
    ";

    $stmt_up = $conn->prepare($sql_update);
    $stmt_up->execute([$ho_ten, $so_dien_thoai, $dia_chi, $ghi_chu, $trang_thai, $id]);

    header("Location: xem.php?id=" . $id);
    exit;
}

?>

<style>
.form-card {
    background: var(--card-bg);
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    max-width: 700px;
}

.form-card h3 {
    margin-top: 0;
    font-size: 18px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    font-size: 14px;
    font-weight: 600;
}

.form-group input,
.form-group textarea,
.form-group select {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ddd;
    margin-top: 5px;
}

.btn-save {
    background: #4f46e5;
    padding: 10px 16px;
    color: white;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    margin-top: 10px;
}

.items-box {
    margin-top: 25px;
    padding: 15px;
    background: var(--card-bg);
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.item-row {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.item-row img {
    width: 55px;
    height: 55px;
    border-radius: 8px;
    object-fit: cover;
    margin-right: 15px;
}

.item-info {
    font-size: 14px;
}
</style>

<h2 class="page-title">Chỉnh sửa đơn hàng #<?= $don["id_don_hang"] ?></h2>

<div class="form-card">

<form method="post">

    <h3>Thông tin khách hàng</h3>

    <div class="form-group">
        <label>Họ tên</label>
        <input type="text" name="ho_ten" value="<?= $don["ho_ten_nhan"] ?>" required>
    </div>

    <div class="form-group">
        <label>Điện thoại</label>
        <input type="text" name="so_dien_thoai" value="<?= $don["so_dien_thoai_nhan"] ?>" required>
    </div>

    <div class="form-group">
        <label>Địa chỉ</label>
        <input type="text" name="dia_chi" value="<?= $don["dia_chi_nhan"] ?>" required>
    </div>

    <div class="form-group">
        <label>Ghi chú</label>
        <textarea name="ghi_chu" rows="3"><?= $don["ghi_chu"] ?></textarea>
    </div>

    <div class="form-group">
        <label>Trạng thái đơn hàng</label>
        <select name="trang_thai">
            <option <?= $don["trang_thai"] === "Chờ xác nhận" ? "selected" : "" ?>>Chờ xác nhận</option>
            <option <?= $don["trang_thai"] === "Đã xác nhận" ? "selected" : "" ?>>Đã xác nhận</option>
            <option <?= $don["trang_thai"] === "Đang giao" ? "selected" : "" ?>>Đang giao</option>
            <option <?= $don["trang_thai"] === "Đã giao" ? "selected" : "" ?>>Đã giao</option>
            <option <?= $don["trang_thai"] === "Hủy" ? "selected" : "" ?>>Hủy</option>
        </select>
    </div>

    <button class="btn-save">Lưu thay đổi</button>
</form>

</div>

<div class="items-box">
    <h3>Sản phẩm trong đơn</h3>

    <?php foreach ($items as $it): ?>
    <div class="item-row">
        <img src="/webnhom7/assets/img/<?= $it["hinh_anh"] ?>">
        <div class="item-info">
            <strong><?= $it["ten_san_pham"] ?></strong><br>
            Số lượng: <?= $it["so_luong"] ?><br>
            Giá: <?= number_format($it["gia"]) ?> đ
        </div>
    </div>
    <?php endforeach; ?>

</div>
