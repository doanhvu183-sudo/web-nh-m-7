<?php
// trang_nguoi_dung/danh_muc.php

require_once __DIR__ . '/../giao_dien/header.php';
require_once __DIR__ . '/../cau_hinh/ket_noi.php';
require_once __DIR__ . '/../cau_hinh/ham.php';

// ====== 1. Nhận tham số ======
$loai = isset($_GET['loai']) ? trim($_GET['loai']) : 'tatca';
$q    = isset($_GET['q']) ? trim($_GET['q']) : '';
$sort = isset($_GET['sort']) ? trim($_GET['sort']) : 'moi_nhat';
$min  = isset($_GET['min']) ? (float)$_GET['min'] : null;
$max  = isset($_GET['max']) ? (float)$_GET['max'] : null;

// ====== 2. Map danh mục (bạn chỉnh ID tại đây cho đúng DB của bạn) ======
$MAP_DANH_MUC = [
    'nam'      => 1,
    'nu'       => 2,
    'tre_em'   => 3,
    'sandals'  => 1,  // tạm map, bạn đổi nếu khác
    'jibbitz'  => 3,  // tạm map, vì data charm đang id=3
    'xu_huong' => 1,
    'uu_dai'   => 2,
    'hangmoi'  => null,
    'banchay'  => null,
    'giaydecao'=> null,
    'collab'   => null,
    'thethao'  => null,
    'tatca'    => null,
];

// ====== 3. Tiêu đề trang ======
$TITLE_MAP = [
    'nam'      => 'Nam',
    'nu'       => 'Nữ',
    'tre_em'   => 'Trẻ Em',
    'sandals'  => 'Sandals',
    'jibbitz'  => 'Jibbitz™',
    'xu_huong' => 'Xu Hướng',
    'uu_dai'   => 'Ưu Đãi',
    'hangmoi'  => 'Hàng Mới',
    'banchay'  => 'Bán Chạy',
    'giaydecao'=> 'Giày Đế Cao',
    'collab'   => 'Collab',
    'thethao'  => 'Thể Thao',
    'tatca'    => 'Tất Cả Sản Phẩm',
];

$page_title = $TITLE_MAP[$loai] ?? 'Danh Mục';

// ====== 4. Xây query an toàn ======
$where = [];
$params = [];

// lọc theo id_danh_muc nếu có
if (array_key_exists($loai, $MAP_DANH_MUC) && $MAP_DANH_MUC[$loai] !== null) {
    $where[] = "id_danh_muc = :id_danh_muc";
    $params[':id_danh_muc'] = $MAP_DANH_MUC[$loai];
}

// các danh mục đặc biệt nếu bạn chưa có bảng danh mục: lọc theo tên
if (in_array($loai, ['hangmoi','banchay','giaydecao','collab','thethao','xu_huong','uu_dai']) && $MAP_DANH_MUC[$loai] === null) {
    // Ví dụ lọc theo từ khóa trong tên / mô tả (bạn có thể đổi rules)
    if ($loai === 'hangmoi') {
        // hàng mới = newest => không cần where, chỉ sort
    } else {
        $keywordMap = [
            'banchay'   => 'bán chạy',
            'giaydecao' => 'đế cao',
            'collab'    => 'collab',
            'thethao'   => 'thể thao',
            'xu_huong'  => 'xu hướng',
            'uu_dai'    => 'sale',
        ];
        if (isset($keywordMap[$loai])) {
            $where[] = "(ten_san_pham LIKE :kw OR mo_ta LIKE :kw)";
            $params[':kw'] = '%'.$keywordMap[$loai].'%';
        }
    }
}

// tìm kiếm trong bộ sưu tập
if ($q !== '') {
    $where[] = "(ten_san_pham LIKE :q OR mo_ta LIKE :q)";
    $params[':q'] = '%'.$q.'%';
}

// lọc giá
if ($min !== null) {
    $where[] = "gia >= :min";
    $params[':min'] = $min;
}
if ($max !== null && $max > 0) {
    $where[] = "gia <= :max";
    $params[':max'] = $max;
}

$whereSQL = count($where) ? ("WHERE ".implode(" AND ", $where)) : "";

// sắp xếp
$orderSQL = "ORDER BY id_san_pham DESC";
if ($sort === 'gia_tang')  $orderSQL = "ORDER BY gia ASC";
if ($sort === 'gia_giam')  $orderSQL = "ORDER BY gia DESC";
if ($sort === 'moi_nhat')  $orderSQL = "ORDER BY id_san_pham DESC";

// phân trang
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$perPage = 12;
$offset = ($page - 1) * $perPage;

// đếm total
$sqlCount = "SELECT COUNT(*) FROM SANPHAM $whereSQL";
$stmtCount = $pdo->prepare($sqlCount);
$stmtCount->execute($params);
$total = (int)$stmtCount->fetchColumn();
$totalPages = max(1, ceil($total / $perPage));

// lấy sản phẩm
$sql = "SELECT * FROM SANPHAM $whereSQL $orderSQL LIMIT $perPage OFFSET $offset";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$san_pham = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="../assets/css/danh_muc.css">

<main class="page-danh-muc">

    <!-- Heading -->
    <div class="dm-heading">
        <h1><?= htmlspecialchars($page_title) ?></h1>
        <p><a href="danh_muc.php?loai=tatca">Xem tất cả</a> · <?= $total ?> sản phẩm</p>
    </div>

    <div class="dm-layout">

        <!-- Sidebar Filter -->
        <aside class="dm-sidebar">
            <form method="get" class="filter-box">
                <input type="hidden" name="loai" value="<?= htmlspecialchars($loai) ?>">

                <div class="filter-group">
                    <div class="filter-title">Giá</div>
                    <label><input type="radio" name="price" value="0-500"
                        <?= (isset($_GET['price']) && $_GET['price']=='0-500')?'checked':''; ?>
                        onclick="this.form.min.value=0;this.form.max.value=500000;this.form.submit();">
                        Dưới 500.000đ
                    </label>
                    <label><input type="radio" name="price" value="500-1000"
                        <?= (isset($_GET['price']) && $_GET['price']=='500-1000')?'checked':''; ?>
                        onclick="this.form.min.value=500000;this.form.max.value=1000000;this.form.submit();">
                        500.000đ - 1.000.000đ
                    </label>
                    <label><input type="radio" name="price" value="1000-1500"
                        <?= (isset($_GET['price']) && $_GET['price']=='1000-1500')?'checked':''; ?>
                        onclick="this.form.min.value=1000000;this.form.max.value=1500000;this.form.submit();">
                        1.000.000đ - 1.500.000đ
                    </label>
                    <label><input type="radio" name="price" value="1500-2000"
                        <?= (isset($_GET['price']) && $_GET['price']=='1500-2000')?'checked':''; ?>
                        onclick="this.form.min.value=1500000;this.form.max.value=2000000;this.form.submit();">
                        1.500.000đ - 2.000.000đ
                    </label>
                    <label><input type="radio" name="price" value="2000+"
                        <?= (isset($_GET['price']) && $_GET['price']=='2000+')?'checked':''; ?>
                        onclick="this.form.min.value=2000000;this.form.max.value='';this.form.submit();">
                        Trên 2.000.000đ
                    </label>

                    <!-- hidden min max -->
                    <input type="hidden" name="min" value="<?= htmlspecialchars($min ?? '') ?>">
                    <input type="hidden" name="max" value="<?= htmlspecialchars($max ?? '') ?>">
                </div>

                <div class="filter-group">
                    <div class="filter-title">Tìm trong danh mục</div>
                    <div class="filter-search">
                        <input type="text" name="q" value="<?= htmlspecialchars($q) ?>"
                               placeholder="Tìm kiếm sản phẩm trong bộ sưu tập này">
                        <button type="submit">Tìm</button>
                    </div>
                </div>

                <div class="filter-group">
                    <a class="filter-reset" href="danh_muc.php?loai=<?= htmlspecialchars($loai) ?>">Xóa bộ lọc</a>
                </div>
            </form>
        </aside>

        <!-- Content -->
        <section class="dm-content">

            <!-- Search + Sort bar -->
            <div class="dm-toolbar">
                <form method="get" class="toolbar-left">
                    <input type="hidden" name="loai" value="<?= htmlspecialchars($loai) ?>">
                    <input type="text" name="q" value="<?= htmlspecialchars($q) ?>"
                           placeholder="Tìm kiếm sản phẩm trong bộ sưu tập này">
                    <button type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </form>

                <form method="get" class="toolbar-right">
                    <input type="hidden" name="loai" value="<?= htmlspecialchars($loai) ?>">
                    <?php if ($q !== ''): ?>
                        <input type="hidden" name="q" value="<?= htmlspecialchars($q) ?>">
                    <?php endif; ?>
                    <?php if ($min !== null): ?>
                        <input type="hidden" name="min" value="<?= htmlspecialchars($min) ?>">
                    <?php endif; ?>
                    <?php if ($max !== null): ?>
                        <input type="hidden" name="max" value="<?= htmlspecialchars($max) ?>">
                    <?php endif; ?>

                    <select name="sort" onchange="this.form.submit()">
                        <option value="moi_nhat" <?= $sort=='moi_nhat'?'selected':''; ?>>Mới nhất</option>
                        <option value="gia_tang" <?= $sort=='gia_tang'?'selected':''; ?>>Giá tăng dần</option>
                        <option value="gia_giam" <?= $sort=='gia_giam'?'selected':''; ?>>Giá giảm dần</option>
                    </select>
                </form>
            </div>

            <!-- Grid products -->
            <?php if (!$san_pham): ?>
                <div class="dm-empty">Không có sản phẩm nào trong danh mục này.</div>
            <?php else: ?>
                <div class="dm-grid">
                    <?php foreach ($san_pham as $sp): ?>
                        <a class="dm-card"
                           href="chi_tiet_san_pham.php?id=<?= $sp['id_san_pham'] ?>">
                            <div class="dm-thumb">
                                <img src="../assets/img/<?= htmlspecialchars($sp['hinh_anh']) ?>"
                                     alt="<?= htmlspecialchars($sp['ten_san_pham']) ?>">
                            </div>

                            <div class="dm-info">
                                <div class="dm-name"><?= htmlspecialchars($sp['ten_san_pham']) ?></div>
                                <div class="dm-desc"><?= htmlspecialchars($sp['mo_ta']) ?></div>
                                <div class="dm-price"><?= dinh_dang_gia($sp['gia']) ?></div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
                <div class="dm-pagination">
                    <?php for ($i=1; $i<=$totalPages; $i++): ?>
                        <a class="<?= $i==$page?'active':''; ?>"
                           href="?loai=<?= urlencode($loai) ?>&q=<?= urlencode($q) ?>&sort=<?= urlencode($sort) ?>&min=<?= urlencode($min ?? '') ?>&max=<?= urlencode($max ?? '') ?>&page=<?= $i ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>

        </section>

    </div>

</main>

<?php require_once __DIR__ . '/../giao_dien/footer.php'; ?>
