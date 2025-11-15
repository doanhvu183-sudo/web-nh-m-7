<?php
require_once __DIR__ . '/../cau_hinh/ket_noi.php';

// Lấy dữ liệu từ form
$ho_ten       = trim($_POST['ho_ten'] ?? '');
$ten_dn       = trim($_POST['ten_dang_nhap'] ?? '');
$mat_khau_raw = trim($_POST['mat_khau'] ?? '');
$email        = trim($_POST['email'] ?? '');
$sdt          = trim($_POST['so_dien_thoai'] ?? '');
$dia_chi      = trim($_POST['dia_chi'] ?? '');

if ($ho_ten === '' || $ten_dn === '' || $mat_khau_raw === '') {
    header('Location: dang_ky.php?err=' . urlencode('Vui lòng nhập đầy đủ các trường bắt buộc.'));
    exit;
}

// TODO: Đồ án thực tế nên dùng password_hash.
// Bài tập đơn giản: lưu thẳng (CHO DỄ TEST), thầy/cô hay bạn bè dễ check.
$mat_khau = $mat_khau_raw;

// Kiểm tra trùng tên đăng nhập
$stmt = $pdo->prepare("SELECT * FROM NGUOIDUNG WHERE ten_dang_nhap = :tdn");
$stmt->execute([':tdn' => $ten_dn]);
if ($stmt->fetch()) {
    header('Location: dang_ky.php?err=' . urlencode('Tên đăng nhập đã tồn tại.'));
    exit;
}

// Mặc định vai trò Khách hàng (id_vai_tro = 3 theo SQL trước đó)
$id_vai_tro_mac_dinh = 3;

$sql = "INSERT INTO NGUOIDUNG 
        (ten_dang_nhap, mat_khau, ho_ten, email, so_dien_thoai, dia_chi, id_vai_tro) 
        VALUES 
        (:tdn, :mk, :ht, :em, :sdt, :dc, :vt)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':tdn' => $ten_dn,
    ':mk'  => $mat_khau,
    ':ht'  => $ho_ten,
    ':em'  => $email,
    ':sdt' => $sdt,
    ':dc'  => $dia_chi,
    ':vt'  => $id_vai_tro_mac_dinh
]);

// Sau khi đăng ký xong => tự đăng nhập luôn cho tiện
$id_nguoi_dung = $pdo->lastInsertId();
$stmt = $pdo->prepare("SELECT * FROM NGUOIDUNG WHERE id_nguoi_dung = :id");
$stmt->execute([':id' => $id_nguoi_dung]);
$user = $stmt->fetch();

$_SESSION['user'] = $user;

// Nếu có return_url (ví dụ từ trang thanh toán), quay về đó
$return_url = $_GET['return_url'] ?? '../trang_nguoi_dung/trang_chu.php';
header('Location: ' . $return_url);
exit;
