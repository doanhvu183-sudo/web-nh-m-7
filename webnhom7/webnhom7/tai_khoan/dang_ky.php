<?php
require_once __DIR__ . '/../giao_dien/header.php';
?>

<section class="auth-section">
    <h2>Đăng ký tài khoản</h2>

    <?php if (!empty($_GET['err'])): ?>
        <p class="auth-error">
            <?= htmlspecialchars($_GET['err']) ?>
        </p>
    <?php endif; ?>

    <form action="xu_ly_dang_ky.php" method="post" class="auth-form">
        <label>Họ tên *</label>
        <input type="text" name="ho_ten" required>

        <label>Tên đăng nhập *</label>
        <input type="text" name="ten_dang_nhap" required>

        <label>Mật khẩu *</label>
        <input type="password" name="mat_khau" required>

        <label>Email</label>
        <input type="email" name="email">

        <label>Số điện thoại</label>
        <input type="text" name="so_dien_thoai">

        <label>Địa chỉ</label>
        <textarea name="dia_chi" rows="3"></textarea>

        <button type="submit" class="btn btn-primary">Đăng ký</button>
    </form>
</section>

<?php
require_once __DIR__ . '/../giao_dien/footer.php';
