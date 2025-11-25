<?php
$ma = $_GET['ma'] ?? '';
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8" />
    <title>Đặt hàng thành công</title>
    <link rel="stylesheet" href="../assets/css/shop.css">
</head>
<body>
<div class="container thankyou">
    <h1>Đặt hàng thành công 🎉</h1>
    <p>Mã đơn hàng của bạn: <strong><?= htmlspecialchars($ma) ?></strong></p>
    <a class="btn btn-primary" href="trang_chu.php">Về trang chủ</a>
</div>
</body>
</html>
