<?php
require_once __DIR__ . '/../giao_dien/header.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = $_SESSION['error_register'] ?? '';
$success = $_SESSION['success_register'] ?? '';
unset($_SESSION['error_register'], $_SESSION['success_register']);
?>

<link rel="stylesheet" href="../assets/css/tai_khoan.css">

<div class="auth-wrapper">
    <div class="auth-box">
        <h2>Đăng ký</h2>

        <?php if ($error): ?>
            <div class="auth-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="auth-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form action="xu_ly_dang_ky.php" method="post" class="auth-form">
            <label>Họ tên</label>
            <input type="text" name="ho_ten" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Mật khẩu</label>
            <input type="password" name="mat_khau" required>

            <label>Nhập lại mật khẩu</label>
            <input type="password" name="nhap_lai" required>

            <button type="submit" class="btn-primary">Đăng ký</button>

            <p class="auth-note">
                Đã có tài khoản?
                <a href="dang_nhap.php">Đăng nhập</a>
            </p>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../giao_dien/footer.php'; ?>
