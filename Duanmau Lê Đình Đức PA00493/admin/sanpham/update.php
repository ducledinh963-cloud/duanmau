<?php
if (isset($sp) && is_array($sp)) {
    extract($sp);
    $hinh_path = get_product_image($img);
} else {
    echo "<div class='admin-container'><p class='admin-alert admin-alert-danger'>Sản phẩm không tồn tại.</p></div>";
    return;
}
?>
<div class="admin-container">
    <div class="admin-card" style="max-width: 800px; margin: 0 auto;">
        <div class="card-header">
            <h2 class="card-title"><i class="fa-solid fa-pen-to-square"></i> CẬP NHẬT SẢN PHẨM</h2>
            <a href="index.php?act=listsanpham" class="btn btn-info btn-sm"><i class="fa-solid fa-list"></i> Xem danh sách</a>
        </div>

        <form action="index.php?act=updatesp" method="POST" enctype="multipart/form-data">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <!-- Category Select -->
                <div class="admin-form-group">
                    <label for="iddm">Danh mục sản phẩm *</label>
                    <select name="iddm" id="iddm" class="admin-form-control" required>
                        <option value="">--- Chọn danh mục ---</option>
                        <?php
                        if (isset($listdanhmuc) && is_array($listdanhmuc)) {
                            foreach ($listdanhmuc as $dm) {
                                $selected = ($dm['id'] == $id_danhmuc) ? 'selected' : '';
                                echo '<option value="' . $dm['id'] . '" ' . $selected . '>' . htmlspecialchars($dm['name']) . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <!-- Product Name -->
                <div class="admin-form-group">
                    <label for="tensp">Tên sản phẩm *</label>
                    <input type="text" name="tensp" id="tensp" class="admin-form-control" value="<?= htmlspecialchars($name) ?>" required>
                </div>

                <!-- Price -->
                <div class="admin-form-group">
                    <label for="giasp">Giá bán (VNĐ) *</label>
                    <input type="number" name="giasp" id="giasp" class="admin-form-control" value="<?= htmlspecialchars($price) ?>" required min="0">
                </div>

                <!-- Image Upload & Preview -->
                <div class="admin-form-group">
                    <label for="hinh">Hình ảnh sản phẩm (để trống nếu giữ ảnh cũ)</label>
                    <input type="file" name="hinh" id="hinh" class="admin-form-control" accept="image/*">
                    <div style="margin-top: 10px; display: flex; align-items: center; gap: 10px;">
                        <span style="font-size: 0.85rem; color: var(--text-muted);">Ảnh hiện tại:</span>
                        <img src="<?= $hinh_path ?>" alt="Ảnh hiện tại" style="width: 50px; height: 50px; object-fit: cover; border-radius: 6px; border: 1px solid var(--border-color);">
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="admin-form-group">
                <label for="mota">Mô tả sản phẩm</label>
                <textarea name="mota" id="mota" class="admin-form-control"><?= htmlspecialchars($mota) ?></textarea>
            </div>

            <input type="hidden" name="id" value="<?= $id ?>">
            
            <div style="display: flex; gap: 10px; margin-top: 30px;">
                <button type="submit" name="capnhat" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> CẬP NHẬT</button>
                <a href="index.php?act=listsanpham" class="btn btn-danger" style="background-color: #94a3b8;"><i class="fa-solid fa-ban"></i> Hủy bỏ</a>
            </div>
        </form>
    </div>
</div>
