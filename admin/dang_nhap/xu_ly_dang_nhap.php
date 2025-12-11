<?php
session_start();
require "../../includes/db.php";

$email = $_POST['email'];
$mat_khau = $_POST['mat_khau'];

if (!isset($_SESSION['so_lan_sai'])) {
    $_SESSION['so_lan_sai'] = 0;
}

if ($_SESSION['so_lan_sai'] >= 5) {
    $_SESSION['loi'] = "Bạn đã nhập sai quá 5 lần. Tài khoản bị khóa tạm thời!";
    header("Location: dang_nhap.php");
    exit();
}

$sql = "SELECT * FROM admin WHERE email = :email LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([':email' => $email]);
$admin = $stmt->fetch();

if ($admin) {

    // ❗ So sánh mật khẩu trực tiếp (vì DB chưa dùng bcrypt)
    if ($mat_khau == $admin['mat_khau']) {

        $_SESSION['so_lan_sai'] = 0;

        $_SESSION['admin_da_dang_nhap'] = true;
        $_SESSION['ten_admin'] = $admin['ten_admin'];

        // Ghi log
        $ip = $_SERVER['REMOTE_ADDR'];
        $time = date("Y-m-d H:i:s");

        $sql_log = "INSERT INTO login_log (email, ip_address, thoi_gian) VALUES (:email, :ip, :tg)";
        $stmt_log = $pdo->prepare($sql_log);
        $stmt_log->execute([
            ':email' => $email,
            ':ip'    => $ip,
            ':tg'    => $time
        ]);

        header("Location: ../trang_chu/index.php");
        exit();
    }
}

// Sai thông tin
$_SESSION['so_lan_sai']++;
$_SESSION['loi'] = "Sai email hoặc mật khẩu!";
header("Location: dang_nhap.php");
exit();
?>
