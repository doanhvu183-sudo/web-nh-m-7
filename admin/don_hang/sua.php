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

/* UPDATE */
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
.grid-2 {
    display: grid;
    grid-template-columns: 2fr 1.2fr;
    gap: 25px;
}

.card {
    background: var(--card-bg);
    padding: 22px;
    border-radius: 14px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    margin-bottom: 20px;
}

.card h3 {
    margin: 0 0 18px 0;
    font-size: 18px;
    font-weight: 700;
}

.form-group {
    margin-bottom: 18px;
}

.form-group label {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 6px;
    display: block;
}

.form-group input,
.form-group textarea,
.form-group select {
    width: 100%;
    padding: 11px 12px;
    border-radius: 10px;
    border: 1px solid #d7d7d7;
    background: #fff;
    font-size: 15px;
}

.btn-save {
    width: 100%;
    background: #4f46e5;
    padding: 12px;
    font-size: 16px;
    font-weight: 600;
    margin-top: 12px;
    border-radius: 10px;
    border: none;
    cursor: pointer;
    color: white;
    transition: 0.2s;
}

.btn-save:hover {
    background: #4338ca;
}

/* SẢN PHẨM */
.product-item {
    display: flex;
    gap: 14px;
    margin-bottom: 16px;
}

.product-item img {
    width: 60px;
    height: 60px;
    border-radius: 10px;
    object-fit: cover;
}

.product-info {
    font-size: 14.5px;
}
.product-info strong {
    font-size: 15px;
}
</style>

<h2 class="page-title">Chỉnh sửa đơn hàng #<?= $don["id_don_hang"] ?></h2>

<div class="grid-2">

    <!-- CỘT TRÁI -->
    <div>
        <div class="card">
            <h3>Thông tin khách hàng</h3>

            <form method="post">

                <div class="form-group">
                    <label>Họ tên</label>
                    <input type="text" name="ho_ten" value="<?= $don["ho_ten_nhan"] ?>" required>
                </div>

                <div class="form-group">
                    <label>Số điện thoại</label>
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
                        <?php 
                        $statusList = ["Chờ xác nhận", "Đã xác nhận", "Đang giao", "Đã giao", "Hủy", "Từ chối"];
                        foreach ($statusList as $st): ?>
                            <option value="<?= $st ?>" <?= $don["trang_thai"] === $st ? "selected" : "" ?>>
                                <?= $st ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button class="btn-save">Lưu thay đổi</button>
            </form>
        </div>
    </div>

    <!-- CỘT PHẢI -->
    <div>

        <div class="card">
            <h3>Sản phẩm trong đơn</h3>

            <?php foreach ($items as $it): ?>
                <div class="product-item">
                    <img src="/webnhom7/assets/img/<?= $it["hinh_anh"] ?>">
                    <div class="product-info">
                        <strong><?= $it["ten_san_pham"] ?></strong><br>
                        Số lượng: <?= $it["so_luong"] ?><br>
                        Giá: <?= number_format($it["gia"]) ?> đ
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

</div>
