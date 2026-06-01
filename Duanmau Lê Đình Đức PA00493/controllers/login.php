<?php
class login {
    /**
     * Hiển thị trang đăng nhập
     */
    public function showLogin() {
        include "views/dangnhap.php";
    }

    /**
     * Xử lý đăng nhập tài khoản
     */
    public function processLogin() {
        $error = "";
        if (isset($_POST['dangnhap'])) {
            $user = trim($_POST['user']);
            $pass = $_POST['pass'];
            
            $check = checkuser($user, $pass);
            if (is_array($check)) {
                $_SESSION['user'] = $check;
                echo "<script>window.location.href='index.php';</script>";
                exit();
            } else {
                $error = "Tài khoản hoặc mật khẩu không chính xác.";
            }
        }
        include "views/dangnhap.php";
    }

    /**
     * Đăng xuất tài khoản
     */
    public function logout() {
        session_destroy();
        echo "<script>window.location.href='index.php';</script>";
        exit();
    }

    /**
     * Cập nhật thông tin tài khoản người dùng
     */
    public function editAccount() {
        $thongbao = "";
        $error = "";
        if (isset($_POST['capnhat'])) {
            $id = (int)$_POST['id'];
            $user = trim($_POST['user']);
            $pass = $_POST['pass'];
            $email = trim($_POST['email']);
            $address = trim($_POST['address']);
            $tel = trim($_POST['tel']);

            try {
                update_taikhoan($id, $user, $pass, $email, $address, $tel);
                $_SESSION['user'] = checkuser($user, $pass);
                $thongbao = "Cập nhật tài khoản thành công!";
            } catch (Exception $e) {
                $error = "Có lỗi xảy ra: Tên tài khoản hoặc Email có thể đã bị trùng.";
            }
        }
        include "views/edit_taikhoan.php";
    }
}
?>
