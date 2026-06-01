<?php
class register {
    /**
     * Hiển thị trang đăng ký
     */
    public function showRegister() {
        include "views/dangky.php";
    }

    /**
     * Xử lý đăng ký tài khoản mới
     */
    public function processRegister() {
        $thongbao = "";
        $error = "";
        if (isset($_POST['dangky'])) {
            $user = trim($_POST['user']);
            $email = trim($_POST['email']);
            $pass = $_POST['pass'];
            $repass = $_POST['repass'];

            if ($pass !== $repass) {
                $error = "Mật khẩu xác nhận không khớp!";
            } else {
                try {
                    insert_taikhoan($user, $pass, $email);
                    $thongbao = "Đăng ký thành công! Hãy đăng nhập để trải nghiệm.";
                } catch (Exception $e) {
                    $error = "Tên đăng nhập hoặc Email đã tồn tại trong hệ thống.";
                }
            }
        }
        include "views/dangky.php";
    }
}
?>
