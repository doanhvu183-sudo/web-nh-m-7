<?php 
require_once __DIR__ . '/../../giao_dien/header_admin.php';
require_once __DIR__ . '/../../cau_hinh/ket_noi.php';
?>

<link rel="stylesheet" href="../../assets/css/admin_table.css">

<div class="admin-container">
    <h2>Quản lý chức năng</h2>

    <a href="them.php" class="btn-add">+ Thêm chức năng</a>

    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên chức năng</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
            <?php 
            $stmt = $pdo->query("SELECT * FROM CHUCNANG ORDER BY id_chuc_nang ASC");
            foreach ($stmt as $row):
            ?>
                <tr>
                    <td><?= $row['id_chuc_nang'] ?></td>
                    <td><?= $row['ten_chuc_nang'] ?></td>
                    <td><?= $row['mo_ta'] ?></td>
                    <td>
                        <a href="sua.php?id=<?= $row['id_chuc_nang'] ?>" class="btn-edit">Sửa</a>
                        <a href="xoa.php?id=<?= $row['id_chuc_nang'] ?>" 
                           onclick="return confirm('Xóa chức năng này?')"
                           class="btn-del">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
</div>

<?php require_once __DIR__ . '/../../giao_dien/footer_admin.php'; ?>
