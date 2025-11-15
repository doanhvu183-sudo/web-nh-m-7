<?php 
require_once __DIR__ . '/../../giao_dien/header_admin.php';
require_once __DIR__ . '/../../cau_hinh/ket_noi.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM VAITRO WHERE id_vai_tro = :id");
$stmt->execute([':id' => $id]);
$row = $stmt->fetch();
?>

<div class="admin-container">
    <h2>Sửa vai trò</h2>

    <form action="xu_ly_sua.php" method="post" class="admin-form">
        <input type="hidden" name="id" value="<?= $row['id_vai_tro'] ?>">

        <label>Tên vai trò:</label>
        <input type="text" name="ten_vai_tro" value="<?= $row['ten_vai_tro'] ?>" required>

        <label>Mô tả:</label>
        <textarea name="mo_ta"><?= $row['mo_ta'] ?></textarea>

        <button class="btn-primary">Cập nhật</button>
    </form>
</div>

<?php require_once __DIR__ . '/../../giao_dien/footer_admin.php'; ?>
