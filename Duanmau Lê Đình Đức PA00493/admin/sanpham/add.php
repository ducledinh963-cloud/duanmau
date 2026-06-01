<div class="admin-container">
    <div class="admin-card" style="max-width: 800px; margin: 0 auto;">
        <div class="card-header">
            <h2 class="card-title"><i class="fa-solid fa-box-archive"></i> THÊM MỚI SẢN PHẨM</h2>
            <a href="index.php?act=listsanpham" class="btn btn-info btn-sm"><i class="fa-solid fa-list"></i> Xem danh sách</a>
        </div>

        <form action="index.php?act=addsanpham" method="POST" enctype="multipart/form-data">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <!-- Category Select -->
                <div class="admin-form-group">
                    <label for="iddm">Danh mục sản phẩm *</label>
                    <select name="iddm" id="iddm" class="admin-form-control" required>
                        <option value="">--- Chọn danh mục ---</option>
                        <?php
                        if (isset($listdanhmuc) && is_array($listdanhmuc)) {
                            foreach ($listdanhmuc as $dm) {
                                extract($dm);
                                echo '<option value="' . $id . '">' . htmlspecialchars($name) . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <!-- Product Name -->
                <div class="admin-form-group">
                    <label for="tensp">Tên sản phẩm *</label>
                    <input type="text" name="tensp" id="tensp" class="admin-form-control" placeholder="Nhập tên sản phẩm (Ví dụ: Cam Sành Vĩnh Long)" required>
                </div>

                <!-- Price -->
                <div class="admin-form-group">
                    <label for="giasp">Giá bán (VNĐ) *</label>
                    <input type="number" name="giasp" id="giasp" class="admin-form-control" placeholder="Ví dụ: 45000" required min="0">
                </div>

                <!-- Image Upload -->
                <div class="admin-form-group">
                    <label for="hinh">Hình ảnh sản phẩm *</label>
                    <input type="file" name="hinh" id="hinh" class="admin-form-control" required accept="image/*">
                </div>
            </div>

            <!-- Description -->
            <div class="admin-form-group">
                <label for="mota">Mô tả sản phẩm</label>
                <textarea name="mota" id="mota" class="admin-form-control" placeholder="Nhập mô tả chi tiết của sản phẩm..."></textarea>
            </div>

            <div style="display: flex; gap: 10px; margin-top: 30px;">
                <button type="submit" name="themmoi" class="btn btn-primary"><i class="fa-solid fa-circle-check"></i> THÊM MỚI</button>
                <button type="reset" class="btn btn-danger" style="background-color: #94a3b8;"><i class="fa-solid fa-rotate-left"></i> Nhập lại</button>
            </div>
        </form>
    </div>
</div>
