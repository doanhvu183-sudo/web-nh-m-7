<?php
require_once __DIR__ . '/../giao_dien/header.php';

if (!isset($_SESSION['user'])) {
    header("Location: ../tai_khoan/dang_nhap.php");
    exit;
}
?>

<link rel="stylesheet" href="../assets/css/auth.css">

<div class="auth-container">
    <div class="auth-box">
        <h2>Đổi mật khẩu</h2>

        <?php if (isset($_GET['msg'])): ?>
            <div class="auth-error"><?= htmlspecialchars($_GET['msg']) ?></div>
        <?php endif; ?>

        <form action="xu_ly_doi_mat_khau.php" method="post">

            <div class="auth-input">
                <label>Mật khẩu hiện tại</label>
                <input type="password" name="mk_cu" required>
            </div>

            <div class="auth-input">
                <label>Mật khẩu mới</label>
                <input type="password" name="mk_moi" required>
            </div>

            <div class="auth-input">
                <label>Nhập lại mật khẩu mới</label>
                <input type="password" name="mk_moi2" required>
            </div>

            <button type="submit" class="btn-auth">Cập nhật</button>

        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../giao_dien/footer.php'; ?>
