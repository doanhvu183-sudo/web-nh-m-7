<?php session_start(); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập Admin</title>
    <link rel="stylesheet" href="../assets/css/giao_dien_admin.css">
</head>

<body class="nen_dang_nhap">

<div class="hop_dang_nhap">
    <h2>Đăng nhập quản trị</h2>

    <?php if(isset($_SESSION['loi'])): ?>
        <p class="loi"><?php echo $_SESSION['loi']; unset($_SESSION['loi']); ?></p>
    <?php endif; ?>

    <form method="post" action="xu_ly_dang_nhap.php">

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Mật khẩu</label>
    <input type="password" name="mat_khau" required>

    <button type="submit">Đăng nhập</button>
</form>
</div>

</body>
</html>
