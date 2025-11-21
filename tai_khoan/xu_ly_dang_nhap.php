<?php
// tai_khoan/xu_ly_dang_nhap.php
require_once __DIR__ . '/../cau_hinh/ket_noi.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $mat_khau = trim($_POST['mat_khau'] ?? '');

    if ($email === '' || $mat_khau === '') {
        $_SESSION['error_login'] = "Vui lòng nhập đầy đủ Email và Mật khẩu.";
        header('Location: dang_nhap.php');
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM NGUOI_DUNG WHERE email = :email LIMIT 1");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Ở đây mình dùng mật khẩu chưa mã hóa cho dễ test
    // Nếu bạn đã dùng password_hash thì đổi lại thành password_verify()
    if ($user && $user['mat_khau'] === $mat_khau) {
        $_SESSION['user'] = [
            'id'     => $user['id'],
            'ho_ten' => $user['ho_ten'],
            'email'  => $user['email'],
            'vai_tro'=> $user['vai_tro']
        ];
        header('Location: ../trang_nguoi_dung/trang_chu.php');
        exit;
    } else {
        $_SESSION['error_login'] = "Email hoặc mật khẩu không đúng.";
        header('Location: dang_nhap.php');
        exit;
    }
}
