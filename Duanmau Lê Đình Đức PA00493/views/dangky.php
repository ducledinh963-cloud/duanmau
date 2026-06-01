<div class="container">
    <div class="form-card">
        <h2 class="form-title"><i class="fa-solid fa-user-plus"></i> Đăng Ký Thành Viên</h2>
        
        <?php
        if (isset($thongbao) && $thongbao != "") {
            echo '<div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> ' . $thongbao . '</div>';
        }
        if (isset($error) && $error != "") {
            echo '<div class="alert alert-danger"><i class="fa-solid fa-triangle-exclamation"></i> ' . $error . '</div>';
        }
        ?>

        <form action="index.php?act=dangky" method="POST" id="registerForm">
            <div class="form-group">
                <label for="user">Tên đăng nhập *</label>
                <input type="text" name="user" id="user" class="form-control" placeholder="Nhập tên tài khoản" required>
            </div>
            
            <div class="form-group">
                <label for="email">Địa chỉ Email *</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="example@gmail.com" required>
            </div>

            <div class="form-group">
                <label for="pass">Mật khẩu *</label>
                <input type="password" name="pass" id="pass" class="form-control" placeholder="Tối thiểu 6 ký tự" required minlength="6">
            </div>

            <div class="form-group">
                <label for="repass">Nhập lại mật khẩu *</label>
                <input type="password" name="repass" id="repass" class="form-control" placeholder="Xác nhận lại mật khẩu" required minlength="6">
            </div>

            <button type="submit" name="dangky" class="form-btn">ĐĂNG KÝ TÀI KHOẢN</button>
        </form>

        <div class="form-footer">
            Bạn đã có tài khoản? <a href="index.php?act=dangnhap">Đăng nhập ngay</a>
        </div>
    </div>
</div>

<script>
document.getElementById('registerForm').addEventListener('submit', function(e) {
    let pass = document.getElementById('pass').value;
    let repass = document.getElementById('repass').value;
    if (pass !== repass) {
        e.preventDefault();
        alert('Mật khẩu nhập lại không khớp!');
    }
});
</script>
