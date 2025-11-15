<?php 
require_once __DIR__ . '/../../giao_dien/header_admin.php';
require_once __DIR__ . '/../../cau_hinh/ket_noi.php';
?>

<link rel="stylesheet" href="../../assets/css/admin_table.css">

<div class="admin-container">
    <h2>Phân quyền vai trò</h2>

    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên vai trò</th>
                <th>Mô tả</th>
                <th>Phân quyền</th>
            </tr>
        </thead>

        <tbody>
            <?php 
            $stmt = $pdo->query("SELECT * FROM VAITRO");
            foreach ($stmt as $vt):
            ?>
                <tr>
                    <td><?= $vt['id_vai_tro'] ?></td>
                    <td><?= $vt['ten_vai_tro'] ?></td>
                    <td><?= $vt['mo_ta'] ?></td>
                    <td>
                        <a class="btn-edit" 
                           href="phan_quyen.php?id=<?= $vt['id_vai_tro'] ?>">
                            Cập nhật quyền
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../../giao_dien/footer_admin.php'; ?>
