<?php
require_once __DIR__ . '/../giao_dien/header.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<link rel="stylesheet" href="../assets/css/auth.css">

<div class="auth-container">
    <div class="auth-box">

        <h2>Đăng ký tài khoản</h2>

        <?php if (isset($_GET['err'])): ?>
            <div class="auth-error"><?= htmlspecialchars($_GET['err']) ?></div>
        <?php endif; ?>

        <form action="xu_ly_dang_ky.php" method="post">

            <div class="auth-input">
                <label>Tên đăng nhập *</label>
                <input type="text" name="ten_dang_nhap" required>
            </div>

            <div class="auth-input">
                <label>Email *</label>
                <input type="email" name="email" required>
            </div>

            <div class="auth-input">
                <label>Mật khẩu *</label>
                <input type="password" name="mat_khau" required>
            </div>

            <div class="auth-input">
                <label>Nhập lại mật khẩu *</label>
                <input type="password" name="mat_khau2" required>
            </div>

            <button type="submit" class="btn-auth">Đăng ký</button>

            <p class="auth-switch">
                Đã có tài khoản? <a href="dang_nhap.php">Đăng nhập</a>
            </p>

        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../giao_dien/footer.php'; ?>
