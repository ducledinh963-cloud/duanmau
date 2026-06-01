<?php
if (isset($dm) && is_array($dm)) {
    extract($dm);
} else {
    echo "<div class='admin-container'><p class='admin-alert admin-alert-danger'>Danh mục không tồn tại.</p></div>";
    return;
}
?>
<div class="admin-container">
    <div class="admin-card" style="max-width: 600px; margin: 0 auto;">
        <div class="card-header">
            <h2 class="card-title"><i class="fa-solid fa-file-pen"></i> CẬP NHẬT DANH MỤC SẢN PHẨM</h2>
            <a href="index.php?act=listdanhmuc" class="btn btn-info btn-sm"><i class="fa-solid fa-list"></i> Danh sách</a>
        </div>

        <form action="index.php?act=updatedm" method="POST">
            <div class="admin-form-group">
                <label for="maloai">Mã loại sản phẩm</label>
                <input type="text" id="maloai" class="admin-form-control" value="DM-<?= $id ?>" disabled style="background-color: #f1f5f9; cursor: not-allowed;">
            </div>

            <div class="admin-form-group">
                <label for="tenloai">Tên danh mục *</label>
                <input type="text" name="tenloai" id="tenloai" class="admin-form-control" value="<?= htmlspecialchars($name) ?>" required>
            </div>

            <input type="hidden" name="id" value="<?= $id ?>">
            
            <div style="display: flex; gap: 10px; margin-top: 30px;">
                <button type="submit" name="capnhat" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> CẬP NHẬT</button>
                <a href="index.php?act=listdanhmuc" class="btn btn-danger" style="background-color: #94a3b8;"><i class="fa-solid fa-ban"></i> Hủy bỏ</a>
            </div>
        </form>
    </div>
</div>
