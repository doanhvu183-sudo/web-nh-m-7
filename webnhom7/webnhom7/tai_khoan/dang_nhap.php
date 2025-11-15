<?php
require_once __DIR__ . '/../giao_dien/header.php';

$return_url = $_GET['return_url'] ?? '../trang_nguoi_dung/trang_chu.php';
?>

<section class="auth-section">
    <h2>Đăng nhập</h2>

    <?php if (!empty($_GET['err'])): ?>
        <p class="auth-error">
            <?= htmlspecialchars($_GET['err']) ?>
        </p>
    <?php endif; ?>

    <form action="xu_ly_dang_nhap.php" method="post" class="auth-form">
        <input type="hidden" name="return_url" value="<?= htmlspecialchars($return_url) ?>">

        <label>Tên đăng nhập</label>
        <input type="text" name="ten_dang_nhap" required>

        <label>Mật khẩu</label>
        <input type="password" name="mat_khau" required>

        <button type="submit" class="btn btn-primary">Đăng nhập</button>

        <p class="auth-note">
            Chưa có tài khoản?
            <a href="dang_ky.php?return_url=<?= urlencode($return_url) ?>">Đăng ký ngay</a>
        </p>
    </form>
</section>

<?php
require_once __DIR__ . '/../giao_dien/footer.php';
