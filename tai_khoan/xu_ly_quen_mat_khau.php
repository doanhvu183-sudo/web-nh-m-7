<?php
require_once __DIR__ . '/../cau_hinh/ket_noi.php';

$email = $_POST['email'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM NGUOIDUNG WHERE email = :email LIMIT 1");
$stmt->execute([':email' => $email]);
$user = $stmt->fetch();

if (!$user) {
    header("Location: quen_mat_khau.php?msg=Email không tồn tại!");
    exit;
}

// Giả lập: gửi link reset mật khẩu
header("Location: quen_mat_khau.php?msg=Yêu cầu đã được gửi! Vui lòng kiểm tra email.");
exit;
