<?php
include_once __DIR__ . "/../includes/db.php";

/* 1) ĐƠN THEO NGÀY */
$sql = "SELECT DATE(ngay_dat) AS d, COUNT(*) AS total FROM donhang GROUP BY DATE(ngay_dat)";
$don_raw = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);

$don = [
    "labels" => [],
    "values" => []
];
foreach ($don_raw as $r) {
    $don["labels"][] = $r["d"];
    $don["values"][] = (int)$r["total"];
}

/* 2) DOANH THU */
$sql2 = "SELECT DATE(ngay_dat) AS d, SUM(tong_tien) AS total FROM donhang WHERE trang_thai='Đã giao' GROUP BY DATE(ngay_dat)";
$doanh_raw = $conn->query($sql2)->fetchAll(PDO::FETCH_ASSOC);

$doanh = [
    "labels" => [],
    "values" => []
];
foreach ($doanh_raw as $r) {
    $doanh["labels"][] = $r["d"];
    $doanh["values"][] = (int)$r["total"];
}

/* 3) TRẠNG THÁI */
$sql3 = "SELECT trang_thai AS name, COUNT(*) AS total FROM donhang GROUP BY trang_thai";
$status = $conn->query($sql3)->fetchAll(PDO::FETCH_ASSOC);

/* 4) KPI */
$kpi = [
    "tong_don" => $conn->query("SELECT COUNT(*) FROM donhang")->fetchColumn(),
    "da_giao"  => $conn->query("SELECT COUNT(*) FROM donhang WHERE trang_thai='Đã giao'")->fetchColumn(),
    "doanh_thu" => $conn->query("SELECT SUM(tong_tien) FROM donhang WHERE trang_thai='Đã giao'")->fetchColumn() ?: 0,
];

/* 5) 5 đơn hàng mới nhất */
$sql5 = "
SELECT id_don_hang, ho_ten_nhan AS khach, tong_tien AS tong,
(SELECT hinh_anh FROM sanpham sp JOIN chitiet_donhang ct ON ct.id_san_pham=sp.id_san_pham WHERE ct.id_don_hang=dh.id_don_hang LIMIT 1) AS hinh
FROM donhang dh
ORDER BY ngay_dat DESC
LIMIT 5
";
$recent = $conn->query($sql5)->fetchAll(PDO::FETCH_ASSOC);

/* OUTPUT */
echo json_encode([
    "don" => $don,
    "doanh" => $doanh,
    "status" => $status,
    "recent" => $recent,
    "kpi" => $kpi
]);
