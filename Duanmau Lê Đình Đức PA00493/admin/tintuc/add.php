<div class="admin-container">
    <div class="admin-card" style="max-width: 800px; margin: 0 auto;">
        <div class="card-header">
            <h2 class="card-title"><i class="fa-solid fa-newspaper"></i> THÊM BÀI VIẾT / TIN TỨC MỚI</h2>
            <a href="index.php?act=listtintuc" class="btn btn-info btn-sm"><i class="fa-solid fa-list"></i> Xem danh sách</a>
        </div>

        <form action="index.php?act=addtintuc" method="POST" enctype="multipart/form-data">
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
                <!-- Article Title -->
                <div class="admin-form-group">
                    <label for="title">Tiêu đề bài viết *</label>
                    <input type="text" name="title" id="title" class="admin-form-control" placeholder="Nhập tiêu đề bài viết..." required>
                </div>

                <!-- Date Published -->
                <div class="admin-form-group">
                    <label for="date">Ngày đăng bài</label>
                    <input type="text" name="date" id="date" class="admin-form-control" placeholder="Ví dụ: 25 Th7 hoặc bỏ trống để tự động lấy hôm nay">
                </div>
            </div>

            <!-- Image Upload -->
            <div class="admin-form-group" style="margin-top: 15px;">
                <label for="hinh">Hình ảnh bài viết *</label>
                <input type="file" name="hinh" id="hinh" class="admin-form-control" required accept="image/*">
                <small style="color: #64748b; font-size: 0.8rem; display: block; margin-top: 5px;">Chọn ảnh giới thiệu cho bài viết (JPEG, PNG, v.v.)</small>
            </div>

            <!-- Content Description -->
            <div class="admin-form-group" style="margin-top: 15px;">
                <label for="mota">Nội dung tóm tắt / chi tiết bài viết</label>
                <textarea name="mota" id="mota" class="admin-form-control" rows="8" placeholder="Nhập nội dung mô tả của bài viết tin tức này..." style="resize: vertical; min-height: 120px;"></textarea>
            </div>

            <div style="display: flex; gap: 10px; margin-top: 30px;">
                <button type="submit" name="themmoi" class="btn btn-primary"><i class="fa-solid fa-circle-check"></i> THÊM MỚI</button>
                <button type="reset" class="btn btn-danger" style="background-color: #94a3b8;"><i class="fa-solid fa-rotate-left"></i> Nhập lại</button>
            </div>
        </form>
    </div>
</div>
