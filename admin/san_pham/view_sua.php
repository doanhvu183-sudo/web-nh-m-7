<link rel="stylesheet" href="san_pham.css">

<h2 class="page-title">Sửa sản phẩm #<?= $sp['id_san_pham'] ?></h2>

<div class="form-wrap">

<form method="post" action="xu_ly_sua.php" enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?= $sp['id_san_pham'] ?>">

    <label>Tên sản phẩm</label>
    <input type="text" name="ten" value="<?= $sp['ten_san_pham'] ?>" required>

    <label>Giá bán</label>
    <input type="number" name="gia" value="<?= $sp['gia'] ?>" required>

    <label>Giá gốc</label>
    <input type="number" name="gia_goc" value="<?= $sp['gia_goc'] ?>">

    <label>Số lượng</label>
    <input type="number" name="so_luong" value="<?= $sp['so_luong'] ?>">

    <label>Danh mục</label>
    <select name="id_dm">
        <?php foreach ($ds_dm as $dm): ?>
            <option value="<?= $dm['id_danh_muc'] ?>"
                <?= $sp['id_danh_muc'] == $dm['id_danh_muc'] ? 'selected' : '' ?>>
                <?= $dm['ten_danh_muc'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Ảnh hiện tại</label><br>
    <img src="/webnhom7/assets/img/<?= $sp['hinh_anh'] ?>" style="width:120px;border-radius:8px">
    <br><br>

    <label>Đổi ảnh (không bắt buộc)</label>
    <input type="file" name="anh">

    <label>Mô tả</label>
    <textarea name="mo_ta" rows="4"><?= $sp['mo_ta'] ?></textarea>

    <button type="submit" class="btn-submit">Lưu thay đổi</button>

</form>

</div>
