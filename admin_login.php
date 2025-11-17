<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>

<link rel="stylesheet" href="assets/css/admin_login.css">

<div class="admin-login-container">

    <div class="admin-login-box">
        <h2>Đăng nhập Admin</h2>

        <?php if (isset($_GET['err'])): ?>
            <div class="admin-error"><?= htmlspecialchars($_GET['err']) ?></div>
        <?php endif; ?>

        <form action="admin_login_xuly.php" method="post">

            <label>Tên đăng nhập</label>
            <input type="text" name="username" required>

            <label>Mật khẩu</label>
            <input type="password" name="password" required>

            <button class="btn-admin-login">Đăng nhập</button>
        </form>
    </div>
</div>
