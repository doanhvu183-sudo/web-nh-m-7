<link rel="stylesheet" href="san_pham.css">

<h2 class="page-title">Thêm sản phẩm mới</h2>

<div class="form-wrap">

<form method="post" action="xu_ly_them.php" enctype="multipart/form-data">

    <label>Tên sản phẩm</label>
    <input type="text" name="ten" required>

    <label>Giá bán</label>
    <input type="number" name="gia" required>

    <label>Giá gốc (không bắt buộc)</label>
    <input type="number" name="gia_goc">

    <label>Số lượng</label>
    <input type="number" name="so_luong" value="0" required>

    <label>Danh mục</label>
    <select name="id_dm" required>
        <option value="">-- Chọn danh mục --</option>
        <?php foreach ($ds_dm as $dm): ?>
            <option value="<?= $dm['id_danh_muc'] ?>"><?= $dm['ten_danh_muc'] ?></option>
        <?php endforeach; ?>
    </select>

    <label>Hình ảnh</label>
    <input type="file" name="anh" required>

    <label>Mô tả</label>
    <textarea name="mo_ta" rows="4"></textarea>

    <button type="submit" class="btn-submit">Thêm sản phẩm</button>

</form>

</div>
