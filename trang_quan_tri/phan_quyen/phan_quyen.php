<?php
require_once __DIR__ . '/../../giao_dien/header_admin.php';
require_once __DIR__ . '/../../cau_hinh/ket_noi.php';
require_once __DIR__ . '/../../cau_hinh/bao_mat.php';

yeu_cau_admin();

// Lấy id vai trò
if (!isset($_GET['id'])) {
    die("<h2>Thiếu ID vai trò!</h2>");
}
$id_vt = (int)$_GET['id'];

// Lấy thông tin vai trò
$stmt = $pdo->prepare("SELECT * FROM VAITRO WHERE id_vai_tro = :id");
$stmt->execute([':id' => $id_vt]);
$role = $stmt->fetch();

if (!$role) {
    die("<h2>Không tìm thấy vai trò!</h2>");
}

// Lấy tất cả chức năng
$ds_cn = $pdo->query("SELECT * FROM CHUCNANG ORDER BY id_chuc_nang ASC")->fetchAll();

// Lấy các id_chuc_nang mà vai trò này đang có
$stmt2 = $pdo->prepare("
    SELECT id_chuc_nang 
    FROM VAITRO_CHUCNANG 
    WHERE id_vai_tro = :id AND quyen_truy_cap = 'Có'
");
$stmt2->execute([':id' => $id_vt]);
$cn_hien_tai = $stmt2->fetchAll(PDO::FETCH_COLUMN);
?>

<link rel="stylesheet" href="../../assets/css/admin_table.css">

<div class="admin-container">
    <h2>Phân quyền cho vai trò: <?= htmlspecialchars($role['ten_vai_tro']) ?></h2>

    <form action="xu_ly_phan_quyen.php" method="post" class="admin-form">

        <input type="hidden" name="id_vai_tro" value="<?= $id_vt ?>">

        <?php foreach ($ds_cn as $cn): ?>
            <label style="display:block; margin-bottom:8px;">
                <input type="checkbox"
                       name="chuc_nang[]"
                       value="<?= $cn['id_chuc_nang'] ?>"
                       <?= in_array($cn['id_chuc_nang'], $cn_hien_tai) ? 'checked' : '' ?>>
                <strong><?= htmlspecialchars($cn['ten_chuc_nang']) ?></strong>
                <?php if (!empty($cn['mo_ta'])): ?>
                    – <small><?= htmlspecialchars($cn['mo_ta']) ?></small>
                <?php endif; ?>
            </label>
        <?php endforeach; ?>

        <button type="submit" class="btn-primary" style="margin-top:15px;">
            Lưu thay đổi
        </button>
    </form>
</div>

<?php require_once __DIR__ . '/../../giao_dien/footer_admin.php'; ?>
