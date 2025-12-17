<?php
include_once __DIR__ . "/../includes/db.php";

$id = $_GET["id"] ?? 0;

/* =================== LẤY ĐƠN =================== */
$stmt = $conn->prepare("SELECT * FROM donhang WHERE id_don_hang=?");
$stmt->execute([$id]);
$don = $stmt->fetch();
if (!$don) die("Không tìm thấy đơn hàng!");

/* =================== LẤY SẢN PHẨM =================== */
$stmt2 = $conn->prepare("
    SELECT ct.*, sp.ten_san_pham, sp.hinh_anh, sp.gia
    FROM chitiet_donhang ct
    JOIN sanpham sp ON sp.id_san_pham = ct.id_san_pham
    WHERE ct.id_don_hang = ?
");
$stmt2->execute([$id]);
$items = $stmt2->fetchAll();

/* =================== MAP TRẠNG THÁI =================== */
$statusStyle = [
    "Chờ xác nhận" => ["badge-wait", "Xác nhận đơn hàng", "xac_nhan"],
    "Đã xác nhận"  => ["badge-info", "Bắt đầu giao hàng", "bat_dau_giao"],
    "Đang giao"    => ["badge-ship", "Đánh dấu đã giao", "da_giao"],
    "Đã giao"      => ["badge-done", "", ""],
    "Hủy"          => ["badge-cancel", "", ""],
    "Từ chối"      => ["badge-cancel", "", ""],
];

list($badgeClass, $autoText, $autoAction) = $statusStyle[$don["trang_thai"]] ?? [];
?>

<style>
/* ================= GLOBAL ================= */
.page-title {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 28px;
}

.layout {
    display: grid;
    grid-template-columns: 1.2fr 1.8fr;
    gap: 28px;
}

/* ================= CARD ================= */
.card {
    background: var(--card-bg);
    border-radius: 14px;
    padding: 26px;
    box-shadow: 0 2px 12px rgba(0,0,0,.05);
}

.card h3 {
    margin-bottom: 18px;
    font-size: 18px;
    font-weight: 600;
}

/* ================= BADGE ================= */
.badge {
    display: inline-block;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    color: white;
}
.badge-wait { background: #f59e0b; }
.badge-info { background: #38bdf8; }
.badge-ship { background: #3b82f6; }
.badge-done { background: #10b981; }
.badge-cancel { background: #ef4444; }

/* ================= BUTTON ================= */
.btn {
    width: 100%;
    padding: 12px 0;
    border-radius: 8px;
    margin-bottom: 12px;
    font-size: 15px;
    font-weight: 600;
    text-align: center;
    color: white;
    display: block;
}

.btn-primary { background: #4f46e5; }
.btn-red { background: #dc2626; }
.btn-orange { background: #f59e0b; }

/* ================= PRODUCT TABLE ================= */
.table {
    width: 100%;
    border-collapse: collapse;
}
.table th {
    background: #f3f4f6;
    padding: 12px;
    font-size: 14px;
}
.table td {
    padding: 14px 12px;
    border-bottom: 1px solid #e5e7eb45;
    font-size: 15px;
}
.thumb {
    width: 70px;
    height: 70px;
    border-radius: 10px;
    object-fit: cover;
}
.select {
    width: 100%;
    padding: 10px;
    margin-top: 4px;
    border-radius: 8px;
    border: 1px solid #ddd;
}

</style>


<h2 class="page-title">Chi tiết đơn hàng #<?= $id ?></h2>

<div class="layout">

    <!-- ================= CỘT TRÁI ================= -->
    <div>

        <div class="card">
            <h3>Trạng thái & xử lý</h3>

            <p><strong>Trạng thái hiện tại:</strong>
                <span class="badge <?= $badgeClass ?>"><?= $don["trang_thai"] ?></span>
            </p>

            <!-- AUTO FLOW (A) -->
            <?php if ($autoAction): ?>
                <a href="update_status.php?id=<?= $id ?>&action=<?= $autoAction ?>"
                   class="btn btn-primary">
                    <?= $autoText ?>
                </a>
            <?php endif; ?>

            <!-- MANUAL FLOW (B) -->
            <form action="update_status.php" method="get" style="margin-top:14px;">
                <input type="hidden" name="id" value="<?= $id ?>">

                <label style="font-size:14px; font-weight:600;">Chọn trạng thái thủ công:</label>
                <select name="action" class="select">
                    <option value="xac_nhan">Đã xác nhận</option>
                    <option value="bat_dau_giao">Đang giao</option>
                    <option value="da_giao">Đã giao</option>
                    <option value="huy">Hủy đơn</option>
                    <option value="tu_choi">Từ chối</option>
                </select>

                <button class="btn btn-orange" style="margin-top:10px;">Cập nhật thủ công</button>
            </form>

            <a href="update_status.php?id=<?= $id ?>&action=huy" class="btn btn-red">Hủy đơn</a>
            <a href="update_status.php?id=<?= $id ?>&action=tu_choi" class="btn btn-orange">Từ chối đơn</a>
        </div>

        <div class="card" style="margin-top:26px;">
            <h3>Thông tin khách hàng</h3>
            <p><strong>Họ tên:</strong> <?= $don["ho_ten_nhan"] ?></p>
            <p><strong>SĐT:</strong> <?= $don["so_dien_thoai_nhan"] ?></p>
            <p><strong>Địa chỉ:</strong> <?= $don["dia_chi_nhan"] ?></p>
        </div>

    </div>

    <!-- ================= CỘT PHẢI ================= -->
    <div>

        <div class="card">
            <h3>Sản phẩm trong đơn</h3>

            <table class="table">
                <thead>
                    <tr>
                        <th>Ảnh</th>
                        <th>Sản phẩm</th>
                        <th>SL</th>
                        <th>Giá</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $it): ?>
                    <tr>
                        <td><img class="thumb" src="/webnhom7/assets/img/<?= $it["hinh_anh"] ?>"></td>
                        <td><?= $it["ten_san_pham"] ?></td>
                        <td><?= $it["so_luong"] ?></td>
                        <td><?= number_format($it["gia"]) ?> đ</td>
                        <td><?= number_format($it["gia"] * $it["so_luong"]) ?> đ</td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

        <div class="card" style="margin-top:26px;">
            <h3>Thông tin thanh toán</h3>
            <p><strong>Phương thức:</strong> <?= $don["phuong_thuc"] ?></p>
            <p><strong>Ghi chú:</strong> <?= $don["ghi_chu"] ?></p>
        </div>

    </div>

</div>
