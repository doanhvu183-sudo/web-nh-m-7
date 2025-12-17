<?php
// Lấy dữ liệu đơn hàng từ controller
// $orders đã có sẵn

// Hàm bỏ dấu tiếng Việt để filter
function vn_clean($str) {
    $accents = [
        'à','á','ạ','ả','ã','â','ầ','ấ','ậ','ẩ','ẫ','ă','ằ','ắ','ặ','ẳ','ẵ',
        'è','é','ẹ','ẻ','ẽ','ê','ề','ế','ệ','ể','ễ',
        'ì','í','ị','ỉ','ĩ',
        'ò','ó','ọ','ỏ','õ','ô','ồ','ố','ộ','ổ','ỗ','ơ','ờ','ớ','ợ','ở','ỡ',
        'ù','ú','ụ','ủ','ũ','ư','ừ','ứ','ự','ử','ữ',
        'ỳ','ý','ỵ','ỷ','ỹ',
        'đ',
        'À','Á','Ạ','Ả','Ã','Â','Ầ','Ấ','Ậ','Ẩ','Ẫ','Ă','Ằ','Ắ','Ặ','Ẳ','Ẵ',
        'È','É','Ẹ','Ẻ','Ẽ','Ê','Ề','Ế','Ệ','Ể','Ễ',
        'Ì','Í','Ị','Ỉ','Ĩ',
        'Ò','Ó','Ọ','Ỏ','Õ','Ô','Ồ','Ố','Ộ','Ổ','Ỗ','Ơ','Ờ','Ớ','Ợ','Ở','Ỡ',
        'Ù','Ú','Ụ','Ủ','Ũ','Ư','Ừ','Ứ','Ự','Ử','Ữ',
        'Ỳ','Ý','Ỵ','Ỷ','Ỹ',
        'Đ'
    ];
    $no_accents = [
        'a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a',
        'e','e','e','e','e','e','e','e','e','e','e',
        'i','i','i','i','i',
        'o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o',
        'u','u','u','u','u','u','u','u','u','u','u',
        'y','y','y','y','y',
        'd',
        'A','A','A','A','A','A','A','A','A','A','A','A','A','A','A','A','A',
        'E','E','E','E','E','E','E','E','E','E','E',
        'I','I','I','I','I',
        'O','O','O','O','O','O','O','O','O','O','O','O','O','O','O','O','O',
        'U','U','U','U','U','U','U','U','U','U','U',
        'Y','Y','Y','Y','Y',
        'D'
    ];
    return strtolower(str_replace($accents, $no_accents, $str));
}
?>

<style>
.page-title {
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 18px;
}

.order-wrapper {
    background: var(--card-bg);
    padding: 18px;
    border-radius: 14px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
}

/* FILTER */
.order-filter {
    display: flex;
    gap: 10px;
    margin-bottom: 16px;
}
.filter-btn {
    padding: 7px 16px;
    border-radius: 20px;
    background: #f3f4f6;
    font-size: 14px;
    cursor: pointer;
    transition: 0.2s;
}
.filter-btn.active {
    background: #111827;
    color: white;
}

/* TABLE */
.order-table {
    width: 100%;
    border-collapse: collapse;
}

.order-table th,
.order-table td {
    padding: 14px 10px;
    font-size: 14px;
}

.order-table th {
    background: #f8f9fa;
    color: #555;
    border-bottom: 1px solid #e5e7eb;
}

.order-table tr:hover {
    background: #f4f4f4;
}

/* BADGES */
.badge {
    padding: 6px 14px;
    border-radius: 16px;
    font-size: 12px;
    font-weight: 600;
    color: white;
}
.badge-wait   { background: #f59e0b; }
.badge-confirm{ background: #2563eb; }
.badge-ship   { background: #3b82f6; }
.badge-done   { background: #16a34a; }
.badge-cancel { background: #dc2626; }

/* IMAGE */
.thumb {
    width: 50px;
    height: 50px;
    border-radius: 6px;
    object-fit: cover;
}

/* ACTION */
.btn-action {
    padding: 6px 8px;
    background: #f3f4f6;
    border-radius: 8px;
    margin-right: 6px;
    display: inline-flex;
}
.btn-action:hover {
    background: #e5e7eb;
}
.action-col { width: 125px; text-align: center; }
</style>

<h2 class="page-title">Danh sách đơn hàng</h2>

<div class="order-wrapper">

    <div class="order-filter">
        <span class="filter-btn active" data-filter="all">Tất cả</span>
        <span class="filter-btn" data-filter="cho xac nhan">Chờ xác nhận</span>
        <span class="filter-btn" data-filter="da xac nhan">Đã xác nhận</span>
        <span class="filter-btn" data-filter="dang giao">Đang giao</span>
        <span class="filter-btn" data-filter="da giao">Đã giao</span>
        <span class="filter-btn" data-filter="huy">Hủy</span>
        <span class="filter-btn" data-filter="tu choi">Từ chối</span>
    </div>

    <table class="order-table">
        <thead>
        <tr>
            <th style="width:70px;">Mã đơn</th>
            <th style="width:70px;">Ảnh</th>
            <th style="width:180px;">Khách hàng</th>
            <th style="width:120px;">Tổng tiền</th>
            <th style="width:150px;">Trạng thái</th>
            <th style="width:150px;">Ngày đặt</th>
            <th class="action-col">Hành động</th>
        </tr>
        </thead>

        <tbody>

        <?php foreach ($orders as $o): ?>

            <?php
            // Lấy ảnh đầu
            $sql_img = "
                SELECT sp.hinh_anh
                FROM chitiet_donhang ct
                JOIN sanpham sp ON ct.id_san_pham = sp.id_san_pham
                WHERE ct.id_don_hang=?
                LIMIT 1
            ";
            $st = $conn->prepare($sql_img);
            $st->execute([$o["id_don_hang"]]);
            $anh = $st->fetchColumn();

            // Chuẩn hóa trạng thái để filter
            $statusNorm = vn_clean($o["trang_thai"]);

            // Badge màu
            $badgeClass = [
                "cho xac nhan" => "badge-wait",
                "da xac nhan"  => "badge-confirm",
                "dang giao"    => "badge-ship",
                "da giao"      => "badge-done",
                "huy"          => "badge-cancel",
                "tu choi"      => "badge-cancel"
            ][$statusNorm] ?? "badge-wait";
            ?>

            <tr data-status="<?= $statusNorm ?>">
                <td>#<?= $o["id_don_hang"] ?></td>

                <td>
                    <img src="/webnhom7/assets/img/<?= $anh ?>" class="thumb">
                </td>

                <td><?= $o["ten_khach"] ?></td>
                <td><?= number_format($o["tong_tien"]) ?> đ</td>

                <td>
                    <span class="badge <?= $badgeClass ?>"><?= $o["trang_thai"] ?></span>
                </td>

                <td><?= date("d/m/Y H:i", strtotime($o["ngay_dat"])) ?></td>

                <td class="action-col">
                    <a class="btn-action" href="xem.php?id=<?= $o["id_don_hang"] ?>">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                    <a class="btn-action" href="sua.php?id=<?= $o["id_don_hang"] ?>">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                </td>
            </tr>

        <?php endforeach; ?>

        </tbody>
    </table>
</div>

<script>
// FILTER
document.querySelectorAll(".filter-btn").forEach(btn => {
    btn.onclick = () => {
        document.querySelectorAll(".filter-btn").forEach(b => b.classList.remove("active"));
        btn.classList.add("active");

        let filter = btn.dataset.filter;
        document.querySelectorAll("tbody tr").forEach(row => {
            let s = row.dataset.status;
            row.style.display = (filter === "all" || s === filter) ? "" : "none";
        });
    };
});
</script>
