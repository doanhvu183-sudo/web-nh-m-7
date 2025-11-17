<?php
require_once __DIR__ . '/../cau_hinh/ket_noi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $ten = trim($_POST['ten_dang_nhap']);
    $mk  = trim($_POST['mat_khau']);

    $sql = $pdo->prepare("
        SELECT * FROM NGUOIDUNG
        WHERE ten_dang_nhap = :t AND mat_khau = :m
        LIMIT 1
    ");

    $sql->execute([
        ':t' => $ten,
        ':m' => $mk
    ]);

    $user = $sql->fetch(PDO::FETCH_ASSOC);

    if ($user) {

        $_SESSION['user'] = [
            'id'   => $user['id_nguoi_dung'],
            'ten'  => $user['ho_ten'],
            'role' => $user['id_vai_tro']
        ];

        header("Location: ../trang_nguoi_dung/trang_chu.php");
        exit;

    } else {
        echo "<script>alert('Sai tên đăng nhập hoặc mật khẩu!');history.back();</script>";
        exit;
    }
}
?>
