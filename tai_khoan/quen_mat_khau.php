<?php
require_once __DIR__ . '/../giao_dien/header.php';

if (session_status() === PHP_SESSION_NONE) session_start();
?>

<link rel="stylesheet" href="../assets/css/auth.css">

<div class="auth-container">
    <div class="auth-box">
        <h2>Quên mật khẩu</h2>

        <?php if (isset($_GET['msg'])): ?>
            <div class="auth-error"><?= htmlspecialchars($_GET['msg']) ?></div>
        <?php endif; ?>

        <form action="xu_ly_quen_mat_khau.php" method="post">

            <div class="auth-input">
                <label>Nhập Email của bạn</label>
                <input type="email" name="email" placeholder="email@gmail.com" required>
            </div>

            <button type="submit" class="btn-auth">Gửi yêu cầu</button>

            <p class="auth-switch">
                Nhớ mật khẩu? <a href="dang_nhap.php">Quay lại đăng nhập</a>
            </p>

        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../giao_dien/footer.php'; ?>
