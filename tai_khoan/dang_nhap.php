<?php
require_once __DIR__ . '/../giao_dien/header.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<link rel="stylesheet" href="../assets/css/auth.css">

<div class="auth-container">
    <div class="auth-box">

        <h2>Đăng nhập</h2>

        <?php if (isset($_GET['err'])): ?>
            <div class="auth-error"><?= htmlspecialchars($_GET['err']) ?></div>
        <?php endif; ?>

        <form action="xu_ly_dang_nhap.php" method="post">

            <div class="auth-input">
                <label>Tên đăng nhập</label>
                <input type="text" name="ten_dang_nhap" placeholder="Nhập username..." required>
            </div>

            <div class="auth-input">
                <label>Mật khẩu</label>
                <input type="password" name="mat_khau" placeholder="********" required>
            </div>

            <button type="submit" class="btn-auth">Đăng nhập</button>

            <p class="auth-switch">
                Chưa có tài khoản? <a href="dang_ky.php">Đăng ký ngay</a>
            </p>

        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../giao_dien/footer.php'; ?>
