<?php
include_once __DIR__ . "/../../includes/db.php";

/* ================================
   1) ĐƠN THEO NGÀY – 7 NGÀY GẦN NHẤT
================================== */

$sql1 = "
    SELECT DATE(ngay_dat) AS ngay, COUNT(*) AS so_don
    FROM donhang
    WHERE ngay_dat >= CURDATE() - INTERVAL 6 DAY
    GROUP BY DATE(ngay_dat)
    ORDER BY ngay ASC
";
$raw_don = $conn->query($sql1)->fetchAll(PDO::FETCH_ASSOC);

/* Fill missing days */
$don = [];
for ($i = 6; $i >= 0; $i--) {
    $day = date("Y-m-d", strtotime("-$i days"));
    $don[$day] = 0;
}
foreach ($raw_don as $r) {
    $don[$r["ngay"]] = (int)$r["so_don"];
}


/* ================================
   2) DOANH THU THEO NGÀY – CHỈ ĐƠN ĐÃ GIAO
================================== */

$sql2 = "
    SELECT DATE(ngay_dat) AS ngay, SUM(tong_tien) AS doanh_thu
    FROM donhang
    WHERE trang_thai='Đã giao'
    AND ngay_dat >= CURDATE() - INTERVAL 6 DAY
    GROUP BY DATE(ngay_dat)
    ORDER BY ngay ASC
";
$raw_doanh = $conn->query($sql2)->fetchAll(PDO::FETCH_ASSOC);

/* Fill missing days */
$doanh = [];
for ($i = 6; $i >= 0; $i--) {
    $day = date("Y-m-d", strtotime("-$i days"));
    $doanh[$day] = 0;
}
foreach ($raw_doanh as $r) {
    $doanh[$r["ngay"]] = (int)$r["doanh_thu"];
}


/* ================================
   3) TỶ LỆ TRẠNG THÁI ĐƠN
================================== */

$sql3 = "
    SELECT LOWER(trang_thai) AS trang_thai, COUNT(*) AS so_luong
    FROM donhang
    GROUP BY trang_thai
";
$status = $conn->query($sql3)->fetchAll(PDO::FETCH_ASSOC);


/* ================================
   4) TOP 5 SẢN PHẨM BÁN CHẠY
================================== */

$sql4 = "
    SELECT sp.ten_san_pham, SUM(ct.so_luong) AS so_luong
    FROM chitiet_donhang ct
    JOIN sanpham sp ON ct.id_san_pham = sp.id_san_pham
    GROUP BY ct.id_san_pham
    ORDER BY so_luong DESC
    LIMIT 5
";
$top_sp = $conn->query($sql4)->fetchAll(PDO::FETCH_ASSOC);


/* ================================
   TRẢ JSON VỀ CHO CHART
================================== */
echo json_encode([
    "don" => $don,
    "doanh" => $doanh,
    "status" => $status,
    "top_sp" => $top_sp
]);
