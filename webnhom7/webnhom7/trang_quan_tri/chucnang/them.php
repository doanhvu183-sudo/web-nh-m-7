<?php require_once __DIR__ . '/../../giao_dien/header_admin.php'; ?>

<div class="admin-container">
    <h2>Thêm chức năng</h2>

    <form action="xu_ly_them.php" method="post" class="admin-form">

        <label>Tên chức năng:</label>
        <input type="text" name="ten_chuc_nang" required>

        <label>Mô tả:</label>
        <textarea name="mo_ta"></textarea>

        <button class="btn-primary">Thêm mới</button>

    </form>
</div>

<?php require_once __DIR__ . '/../../giao_dien/footer_admin.php'; ?>
