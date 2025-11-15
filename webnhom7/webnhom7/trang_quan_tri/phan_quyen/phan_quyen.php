<?php
require_once __DIR__ . '/../../giao_dien/header_admin.php';
require_once __DIR__ . '/../../cau_hinh/ket_noi.php';

$id_vt = $_GET['id'];

// Lấy thông tin vai trò
$stmt = $pdo->prepare("SELECT * FROM VAITRO WHERE id_vai_tro = :id");
$stmt->execute([':id' => $id_vt]);
$role = $stmt->fetch();

// Lấy danh sách chức năng
$cn = $pdo->query("SELECT * FROM CHUCNANG")->fetchAll();

// Lấy quyền hiện tại
$stmt = $pdo->prepare("SELECT id_chuc_nang FROM VAITRO_CHUCNANG WHERE id_vai_tro = :id");
$stmt->execute([':id' => $id_vt]);
$current = $stmt->fetchAll(PDO::FETCH_COLUMN);
?>

<div class="admin-container">
    <h2>Phân quyền: <?= $role['ten_vai_tro'] ?></h2>

    <form action="xu_ly_phan_quyen.php" method="post">

        <input type="hidden" name="id_vai_tro" value="<?= $id_vt ?>">

        <?php foreach ($cn as $c): ?>
            <label style="display:block; margin-bottom:6px;">
                <input type="checkbox" 
                       name="chuc_nang[]" 
                       value="<?= $c['id_chuc_nang'] ?>"
                       <?= in_array($c['id_chuc_nang'], $current) ? 'checked' : '' ?>>
                <?= $c['ten_chuc_nang'] ?>
            </label>
        <?php endforeach; ?>

        <button class="btn-primary" style="margin-top:15px;">Lưu thay đổi</button>
    </form>
</div>

<?php require_once __DIR__ . '/../../giao_dien/footer_admin.php'; ?>
