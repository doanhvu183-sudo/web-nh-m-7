<?php 
require_once __DIR__ . '/../../giao_dien/header_admin.php';
require_once __DIR__ . '/../../cau_hinh/ket_noi.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM CHUCNANG WHERE id_chuc_nang = :id");
$stmt->execute([':id' => $id]);
$cn = $stmt->fetch();
?>

<div class="admin-container">
    <h2>Sửa chức năng</h2>

    <form action="xu_ly_sua.php" method="post" class="admin-form">

        <input type="hidden" name="id" value="<?= $cn['id_chuc_nang'] ?>">

        <label>Tên chức năng:</label>
        <input type="text" name="ten_chuc_nang" value="<?= $cn['ten_chuc_nang'] ?>" required>

        <label>Mô tả:</label>
        <textarea name="mo_ta"><?= $cn['mo_ta'] ?></textarea>

        <button class="btn-primary">Cập nhật</button>

    </form>
</div>

<?php require_once __DIR__ . '/../../giao_dien/footer_admin.php'; ?>
