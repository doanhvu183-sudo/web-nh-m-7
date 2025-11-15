<?php 
require_once __DIR__ . '/../../giao_dien/header_admin.php';
require_once __DIR__ . '/../../cau_hinh/ket_noi.php';
?>

<link rel="stylesheet" href="../../assets/css/admin_table.css">

<div class="admin-container">
    <h2>Quản lý vai trò</h2>

    <a href="them.php" class="btn-add">+ Thêm vai trò</a>

    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên vai trò</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
            <?php 
            $stmt = $pdo->query("SELECT * FROM VAITRO ORDER BY id_vai_tro ASC");
            foreach ($stmt as $row):
            ?>
                <tr>
                    <td><?= $row['id_vai_tro'] ?></td>
                    <td><?= $row['ten_vai_tro'] ?></td>
                    <td><?= $row['mo_ta'] ?></td>
                    <td>
                        <a href="sua.php?id=<?= $row['id_vai_tro'] ?>" class="btn-edit">Sửa</a>
                        <a href="xoa.php?id=<?= $row['id_vai_tro'] ?>" 
                           onclick="return confirm('Xóa vai trò này?')"
                           class="btn-del">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../../giao_dien/footer_admin.php'; ?>
