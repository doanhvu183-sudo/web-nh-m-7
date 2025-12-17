<style>
.page-title{
    font-size:22px;
    font-weight:600;
    margin-bottom:18px;
}

.product-wrap{
    background:#fff;
    padding:18px;
    border-radius:14px;
    box-shadow:0 2px 10px rgba(0,0,0,0.05);
}

/* TOP BAR */
.top-bar{
    display:flex;
    justify-content:space-between;
    margin-bottom:16px;
    flex-wrap:wrap;
    gap:10px;
}

.search-box input{
    padding:8px 12px;
    border:1px solid #ddd;
    border-radius:8px;
    width:230px;
}

.select-box select{
    padding:8px 12px;
    border:1px solid #ddd;
    border-radius:8px;
}

/* TABLE */
.table{
    width:100%;
    border-collapse:collapse;
}

.table th{
    background:#f4f4f4;
    padding:12px;
    font-size:13px;
    color:#666;
    text-align:left;
}

.table td{
    padding:12px;
    border-bottom:1px solid #eee;
}

/* IMAGE PREVIEW */
.sp-img{
    width:58px;
    height:58px;
    border-radius:8px;
    object-fit:cover;
    cursor:pointer;
}

.preview-box{
    position:absolute;
    left:75px;
    top:0;
    background:white;
    padding:6px;
    border-radius:10px;
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
    display:none;
}

.sp-img:hover + .preview-box{
    display:block;
}

.btn{
    padding:6px 10px;
    border-radius:8px;
    background:#eee;
    margin-right:4px;
    display:inline-flex;
}
.btn:hover{
    background:#ddd;
}
</style>

<h2 class="page-title">Quản lý sản phẩm</h2>

<div class="product-wrap">

    <div class="top-bar">

        <!-- SEARCH -->
        <form class="search-box" method="get">
            <input type="text" name="q" value="<?= htmlspecialchars($q) ?>"
                   placeholder="Tìm sản phẩm...">
        </form>

        <!-- FILTER DANH MỤC -->
        <form class="select-box" method="get">
            <select name="dm" onchange="this.form.submit()">
                <option value="">Tất cả danh mục</option>

                <?php foreach ($ds_dm as $row): ?>
                    <option value="<?= $row['id_danh_muc'] ?>"
                        <?= ($dm == $row['id_danh_muc']) ? 'selected' : '' ?>>
                        <?= $row['ten_danh_muc'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>

        <a href="them.php" class="btn" style="background:#111;color:white">+ Thêm sản phẩm</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th style="width:80px">ID</th>
                <th style="width:80px">Ảnh</th>
                <th>Tên sản phẩm</th>
                <th style="width:120px">Giá bán</th>
                <th style="width:120px">Giá gốc</th>
                <th style="width:140px">Danh mục</th>
                <th style="width:120px">Hành động</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($ds_sp as $sp): ?>
            <tr>
                <td>#<?= $sp['id_san_pham'] ?></td>

                <td style="position:relative;">
                    <img src="/webnhom7/assets/img/<?= $sp['hinh_anh'] ?>" class="sp-img">
                    <div class="preview-box">
                        <img src="/webnhom7/assets/img/<?= $sp['hinh_anh'] ?>"
                             style="width:140px;height:140px;border-radius:10px;">
                    </div>
                </td>

                <td><?= $sp['ten_san_pham'] ?></td>

                <td><?= number_format($sp['gia']) ?> đ</td>

                <td style="color:#888">
                    <?= $sp['gia_goc'] ? number_format($sp['gia_goc']) . " đ" : "-" ?>
                </td>

                <td><?= $sp['ten_danh_muc'] ?? '-' ?></td>

                <td>
                    <a class="btn" href="sua.php?id=<?= $sp['id_san_pham'] ?>">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                    <a class="btn" style="background:#ffdad6"
                       onclick="return confirm('Xóa sản phẩm này?')"
                       href="xoa.php?id=<?= $sp['id_san_pham'] ?>">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>

</div>
