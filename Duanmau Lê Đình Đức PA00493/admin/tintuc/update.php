<?php
if (isset($tin) && is_array($tin)) {
    extract($tin);
    $hinh_path = get_news_image($img);
}
?>
<div class="admin-container">
    <div class="admin-card" style="max-width: 800px; margin: 0 auto;">
        <div class="card-header">
            <h2 class="card-title"><i class="fa-solid fa-pen-to-square"></i> CẬP NHẬT BÀI VIẾT / TIN TỨC</h2>
            <a href="index.php?act=listtintuc" class="btn btn-info btn-sm"><i class="fa-solid fa-list"></i> Xem danh sách</a>
        </div>

        <form action="index.php?act=updatetintuc" method="POST" enctype="multipart/form-data">
            <!-- Hidden ID -->
            <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">

            <div style="display: grid; grid-template-columns: 80px 2fr 1fr; gap: 20px;">
                <!-- Article ID -->
                <div class="admin-form-group">
                    <label>Mã tin</label>
                    <input type="text" class="admin-form-control" value="TT-<?= isset($id) ? $id : '' ?>" disabled style="background-color: #f1f5f9; cursor: not-allowed; text-align: center; font-weight: bold;">
                </div>

                <!-- Article Title -->
                <div class="admin-form-group">
                    <label for="title">Tiêu đề bài viết *</label>
                    <input type="text" name="title" id="title" class="admin-form-control" value="<?= isset($title) ? htmlspecialchars($title) : '' ?>" required>
                </div>

                <!-- Date Published -->
                <div class="admin-form-group">
                    <label for="date">Ngày đăng bài</label>
                    <input type="text" name="date" id="date" class="admin-form-control" value="<?= isset($date) ? htmlspecialchars($date) : '' ?>" placeholder="Ví dụ: 25 Th7">
                </div>
            </div>

            <!-- Image Upload and Preview -->
            <div style="display: grid; grid-template-columns: 100px 1fr; gap: 20px; margin-top: 15px; align-items: center;">
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 0.85rem; color: #475569;">Ảnh hiện tại</label>
                    <?php if (isset($hinh_path) && $hinh_path != ""): ?>
                        <img src="<?= $hinh_path ?>" alt="Ảnh bài viết" style="width: 100px; height: 70px; object-fit: cover; border-radius: 6px; border: 1px solid var(--border-color);">
                    <?php else: ?>
                        <span style="color: #94a3b8; font-size: 0.8rem;">Chưa có ảnh</span>
                    <?php endif; ?>
                </div>
                <div class="admin-form-group">
                    <label for="hinh">Chọn hình ảnh mới (nếu muốn thay đổi)</label>
                    <input type="file" name="hinh" id="hinh" class="admin-form-control" accept="image/*">
                </div>
            </div>

            <!-- Content Description -->
            <div class="admin-form-group" style="margin-top: 20px;">
                <label for="mota">Nội dung tóm tắt / chi tiết bài viết</label>
                <textarea name="mota" id="mota" class="admin-form-control" rows="8" placeholder="Nhập nội dung mô tả của bài viết tin tức này..." style="resize: vertical; min-height: 120px;"><?= isset($mota) ? htmlspecialchars($mota) : '' ?></textarea>
            </div>

            <div style="display: flex; gap: 10px; margin-top: 30px;">
                <button type="submit" name="capnhat" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> LƯU THAY ĐỔI</button>
                <a href="index.php?act=listtintuc" class="btn btn-danger" style="background-color: #94a3b8; color: white; display: flex; align-items: center; justify-content: center; text-decoration: none;"><i class="fa-solid fa-ban" style="margin-right: 5px;"></i> Hủy bỏ</a>
            </div>
        </form>
    </div>
</div>
