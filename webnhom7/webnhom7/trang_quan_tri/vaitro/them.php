<?php require_once __DIR__ . '/../../giao_dien/header_admin.php'; ?>

<div class="admin-container">
    <h2>Thêm vai trò</h2>

    <form action="xu_ly_them.php" method="post" class="admin-form">
        <label>Tên vai trò:</label>
        <input type="text" name="ten_vai_tro" required>

        <label>Mô tả:</label>
        <textarea name="mo_ta"></textarea>

        <button class="btn-primary">Thêm mới</button>
    </form>
</div>

<?php require_once __DIR__ . '/../../giao_dien/footer_admin.php'; ?>
