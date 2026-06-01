<div class="container">
    <div class="form-card">
        <h2 class="form-title"><i class="fa-solid fa-lock"></i> Đăng Nhập Hệ Thống</h2>

        <?php
        if (isset($thongbao) && $thongbao != "") {
            echo '<div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> ' . $thongbao . '</div>';
        }
        if (isset($error) && $error != "") {
            echo '<div class="alert alert-danger"><i class="fa-solid fa-triangle-exclamation"></i> ' . $error . '</div>';
        }
        ?>

        <form action="index.php?act=dangnhap" method="POST">
            <div class="form-group">
                <label for="user">Tên đăng nhập *</label>
                <input type="text" name="user" id="user" class="form-control" placeholder="Nhập tên đăng nhập" required>
            </div>

            <div class="form-group">
                <label for="pass">Mật khẩu *</label>
                <input type="password" name="pass" id="pass" class="form-control" placeholder="Nhập mật khẩu" required>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; font-size: 0.85rem;">
                <label style="display: flex; align-items: center; gap: 6px; cursor: pointer;">
                    <input type="checkbox" name="remember"> Ghi nhớ đăng nhập
                </label>
                <a href="#" onclick="alert('Tính năng quên mật khẩu chưa được tích hợp!')" style="color: var(--primary-color);">Quên mật khẩu?</a>
            </div>

            <button type="submit" name="dangnhap" class="form-btn">ĐĂNG NHẬP</button>
        </form>

        <div class="form-footer">
            Bạn chưa có tài khoản? <a href="index.php?act=dangky">Đăng ký thành viên mới</a>
        </div>
    </div>
</div>
