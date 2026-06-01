<div class="admin-container">
    <div class="admin-card" style="max-width: 600px; margin: 0 auto;">
        <div class="card-header">
            <h2 class="card-title"><i class="fa-solid fa-folder-plus"></i> THÊM DANH MỤC SẢN PHẨM MỚI</h2>
            <a href="index.php?act=listdanhmuc" class="btn btn-info btn-sm"><i class="fa-solid fa-list"></i> Xem danh sách</a>
        </div>

        <form action="index.php?act=adddanhmuc" method="POST">
            <div class="admin-form-group">
                <label for="maloai">Mã loại sản phẩm</label>
                <input type="text" id="maloai" class="admin-form-control" value="Tự động tăng" disabled style="background-color: #f1f5f9; cursor: not-allowed;">
            </div>

            <div class="admin-form-group">
                <label for="tenloai">Tên danh mục mới *</label>
                <input type="text" name="tenloai" id="tenloai" class="admin-form-control" placeholder="Nhập tên danh mục (Ví dụ: Rau Củ Đà Lạt)" required>
            </div>

            <div style="display: flex; gap: 10px; margin-top: 30px;">
                <button type="submit" name="themmoi" class="btn btn-primary"><i class="fa-solid fa-circle-check"></i> THÊM MỚI</button>
                <button type="reset" class="btn btn-danger" style="background-color: #94a3b8;"><i class="fa-solid fa-rotate-left"></i> Nhập lại</button>
            </div>
        </form>
    </div>
</div>
