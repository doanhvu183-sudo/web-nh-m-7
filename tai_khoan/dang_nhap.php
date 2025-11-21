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

            <div class="auth-input"><?php
require_once __DIR__ . '/../giao_dien/header.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = $_SESSION['error_login'] ?? '';
unset($_SESSION['error_login']);
?>

<link rel="stylesheet" href="../assets/css/tai_khoan.css">

<div class="auth-wrapper">
    <div class="auth-box">
        <h2>Đăng nhập</h2>

        <?php if ($error): ?>
            <div class="auth-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="xu_ly_dang_nhap.php" method="post" class="auth-form">
            <label>Email</label>
            <input type="email" name="email" required>

            <label>Mật khẩu</label>
            <input type="password" name="mat_khau" required>

            <button type="submit" class="btn-primary">Đăng nhập</button>

            <p class="auth-note">
                Chưa có tài khoản?
                <a href="dang_ky.php">Đăng ký ngay</a>
            </p>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../giao_dien/footer.php'; ?>

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
