<div class="container">
    <div class="form-card" style="max-width: 500px;">
        <h2 class="form-title"><i class="fa-regular fa-id-card"></i> Cập Nhật Tài Khoản</h2>

        <?php
        if (isset($thongbao) && $thongbao != "") {
            echo '<div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> ' . $thongbao . '</div>';
        }
        if (isset($error) && $error != "") {
            echo '<div class="alert alert-danger"><i class="fa-solid fa-triangle-exclamation"></i> ' . $error . '</div>';
        }

        if (isset($_SESSION['user']) && is_array($_SESSION['user'])) {
            extract($_SESSION['user']);
        }
        ?>

        <form action="index.php?act=edit_taikhoan" method="POST">
            <div class="form-group">
                <label for="user">Tên đăng nhập *</label>
                <input type="text" name="user" id="user" class="form-control" value="<?= htmlspecialchars($user) ?>" required>
            </div>

            <div class="form-group">
                <label for="pass">Mật khẩu *</label>
                <input type="password" name="pass" id="pass" class="form-control" value="<?= htmlspecialchars($pass) ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Địa chỉ Email *</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($email) ?>" required>
            </div>

            <div class="form-group">
                <label for="address">Địa chỉ nhận hàng</label>
                <input type="text" name="address" id="address" class="form-control" value="<?= htmlspecialchars($address ?? '') ?>" placeholder="Số nhà, đường, phường/xã, quận/huyện...">
            </div>

            <div class="form-group">
                <label for="tel">Số điện thoại liên lạc</label>
                <input type="text" name="tel" id="tel" class="form-control" value="<?= htmlspecialchars($tel ?? '') ?>" placeholder="Nhập số điện thoại">
            </div>

            <input type="hidden" name="id" value="<?= $id ?>">
            <button type="submit" name="capnhat" class="form-btn">CẬP NHẬT THÔNG TIN</button>
        </form>

        <div class="form-footer">
            <a href="index.php"><i class="fa-solid fa-arrow-left"></i> Quay lại trang chủ</a>
        </div>
    </div>
</div>
