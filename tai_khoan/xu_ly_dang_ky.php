<?php
require_once __DIR__ . '/../cau_hinh/ket_noi.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ho_ten = trim($_POST['ho_ten'] ?? '');
    $email  = trim($_POST['email'] ?? '');
    $mat_khau = trim($_POST['mat_khau'] ?? '');
    $nhap_lai = trim($_POST['nhap_lai'] ?? '');

    if ($ho_ten === '' || $email === '' || $mat_khau === '' || $nhap_lai === '') {
        $_SESSION['error_register'] = "Vui lòng nhập đầy đủ thông tin.";
        header('Location: dang_ky.php');
        exit;
    }

    if ($mat_khau !== $nhap_lai) {
        $_SESSION['error_register'] = "Mật khẩu nhập lại không khớp.";
        header('Location: dang_ky.php');
        exit;
    }

    // Kiểm tra email trùng
    $stmt = $pdo->prepare("SELECT id FROM NGUOI_DUNG WHERE email = :email");
    $stmt->execute([':email' => $email]);
    if ($stmt->fetch()) {
        $_SESSION['error_register'] = "Email này đã được sử dụng.";
        header('Location: dang_ky.php');
        exit;
    }

    // Chưa dùng hash cho dễ test
    $stmt = $pdo->prepare(
        "INSERT INTO NGUOI_DUNG (ho_ten, email, mat_khau) VALUES (:ho_ten,:email,:mat_khau)"
    );
    $stmt->execute([
        ':ho_ten'   => $ho_ten,
        ':email'    => $email,
        ':mat_khau' => $mat_khau
    ]);

    $_SESSION['success_register'] = "Đăng ký thành công, hãy đăng nhập.";
    header('Location: dang_nhap.php');
    exit;
}
