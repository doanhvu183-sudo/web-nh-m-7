<?php
session_start();
require_once "../includes/db.php";
require_once "../includes/functions_cart.php";

$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM sanpham WHERE id_san_pham = ?");
$stmt->execute([$id]);
$sp = $stmt->fetch();

if(!$sp){
    die("Sản phẩm không tồn tại");
}
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8" />
    <title><?= htmlspecialchars($sp['ten_san_pham']) ?></title>
    <link rel="stylesheet" href="../assets/css/shop.css">
    <link rel="stylesheet" href="../assets/css/trang_chu.css"><!-- nếu cần header cũ -->
</head>
<body>

<?php include "../giao_dien/header.php"; ?>

<div class="container product-detail">
    <div class="pd-left">
        <div class="pd-main-img">
            <img src="../assets/img/<?= htmlspecialchars($sp['hinh_anh']) ?>" alt="">
        </div>

        <!-- thumbnail mock (sau có nhiều ảnh thì làm mảng) -->
        <div class="pd-thumbs">
            <img class="active" src="../assets/img/<?= htmlspecialchars($sp['hinh_anh']) ?>" alt="">
            <img src="../assets/img/<?= htmlspecialchars($sp['hinh_anh']) ?>" alt="">
            <img src="../assets/img/<?= htmlspecialchars($sp['hinh_anh']) ?>" alt="">
        </div>
    </div>

    <div class="pd-right">
        <div class="pd-breadcrumb">
            <a href="trang_chu.php">Trang chủ</a> /
            <a href="danh_muc.php?loai=all">Sản phẩm</a> /
            <span><?= htmlspecialchars($sp['ten_san_pham']) ?></span>
        </div>

        <h1 class="pd-title"><?= htmlspecialchars($sp['ten_san_pham']) ?></h1>
        <div class="pd-price"><?= format_vnd($sp['gia']) ?></div>

        <div class="pd-section">
            <div class="pd-label">Màu sắc</div>
            <div class="pd-color">
                <span class="color-dot"></span>
                <span class="color-name">Mặc định</span>
            </div>
        </div>

        <div class="pd-section">
            <div class="pd-label">Kích thước</div>
            <div class="pd-sizes">
                <?php
                // demo size như Crocs, sau này lấy từ bảng size thì đổi
                $sizes = ["US W5","US W6","US W7","US W8","US W9","US W10"];
                foreach($sizes as $i=>$s){
                    echo '<button type="button" class="size-btn '.($i==0?'active':'').'">'.$s.'</button>';
                }
                ?>
            </div>
            <div class="pd-note">
                Sản phẩm form ôm nhẹ. Nếu chân to, nên tăng 1 size.
            </div>
        </div>

        <div class="pd-section pd-stock">
            <span class="dot green"></span>
            Còn hàng, sẵn sàng giao (tồn: <?= (int)$sp['so_luong'] ?>)
        </div>

        <form class="pd-actions" action="them_vao_gio.php" method="post">
            <input type="hidden" name="id_san_pham" value="<?= (int)$sp['id_san_pham'] ?>">
            <div class="qty-box">
                <button type="button" class="qty-btn" data-action="minus">-</button>
                <input name="so_luong" id="qtyInput" type="number" min="1" value="1">
                <button type="button" class="qty-btn" data-action="plus">+</button>
            </div>

            <button class="btn btn-outline" type="submit" name="action" value="add">
                Thêm vào giỏ
            </button>
            <button class="btn btn-primary" type="submit" name="action" value="buy">
                Mua ngay
            </button>
        </form>

        <div class="pd-desc">
            <h3>Mô tả</h3>
            <p><?= nl2br(htmlspecialchars($sp['mo_ta'])) ?></p>
        </div>
    </div>
</div>

<?php include "../giao_dien/footer.php"; ?>

<script>
    // qty +/- 
    const qtyInput = document.getElementById("qtyInput");
    document.querySelectorAll(".qty-btn").forEach(b=>{
        b.addEventListener("click", ()=>{
            let v = parseInt(qtyInput.value||1);
            if(b.dataset.action==="minus") v = Math.max(1, v-1);
            else v = v+1;
            qtyInput.value = v;
        })
    });

    // size active UI only
    document.querySelectorAll(".size-btn").forEach(btn=>{
        btn.addEventListener("click", ()=>{
            document.querySelectorAll(".size-btn").forEach(x=>x.classList.remove("active"));
            btn.classList.add("active");
        });
    });
</script>
</body>
</html>
