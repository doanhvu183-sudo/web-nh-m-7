<?php
include_once __DIR__ . "/../includes/db.php";

$id = $_GET["id"] ?? 0;
$action = $_GET["action"] ?? "";

/* LẤY TRẠNG THÁI HIỆN TẠI */
$stmt = $conn->prepare("SELECT trang_thai FROM donhang WHERE id_don_hang=?");
$stmt->execute([$id]);
$don = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$don) die("Không tìm thấy đơn hàng!");

$current = $don["trang_thai"];

/* =========================
   AUTO FLOW (theo nút lớn)
   ========================= */

$autoFlow = [
    "Chờ xác nhận" => "Đã xác nhận",
    "Đã xác nhận"  => "Đang giao",
    "Đang giao"    => "Đã giao",
];

/* =========================
    MANUAL FLOW (dropdown)
   ========================= */

$manualFlow = [
    "xac_nhan"    => "Đã xác nhận",
    "bat_dau_giao"=> "Đang giao",
    "da_giao"     => "Đã giao",
    "huy"         => "Hủy",
    "tu_choi"     => "Từ chối"
];

/* =========================
        XỬ LÝ ACTION
   ========================= */

$newStatus = null;

/* 1) AUTO FLOW */
if ($action === "xac_nhan_auto") {
    $newStatus = $autoFlow[$current] ?? $current;
}

/* 2) MANUAL FLOW (from dropdown) */
elseif (isset($manualFlow[$action])) {
    $newStatus = $manualFlow[$action];
}

/* Nếu không hợp lệ → giữ nguyên */
if (!$newStatus) {
    $newStatus = $current;
}

/* =========================
         UPDATE DB
   ========================= */

$stmtUp = $conn->prepare("UPDATE donhang SET trang_thai=? WHERE id_don_hang=?");
$stmtUp->execute([$newStatus, $id]);

/* QUAY LẠI TRANG XEM */
header("Location: xem.php?id=" . $id);
exit;
