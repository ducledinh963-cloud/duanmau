<?php
class sanpham {
    /**
     * Hiển thị danh sách sản phẩm (theo từ khóa hoặc danh mục)
     */
    public function list() {
        $kyw = "";
        $iddm = 0;
        $price_min = 0;
        $price_max = 0;
        $title_danhmuc = "Tất cả sản phẩm";

        if (isset($_POST['timkiem'])) {
            $kyw = trim($_POST['kyw']);
        }
        if (isset($_GET['iddm']) && $_GET['iddm'] > 0) {
            $iddm = (int)$_GET['iddm'];
            $dm = loadone_danhmuc($iddm);
            if ($dm) {
                $title_danhmuc = $dm['name'];
            }
        }
        
        $listsanpham = loadall_sanpham($kyw, $iddm, $price_min, $price_max);
        include "views/sanpham.php";
    }

    /**
     * Chi tiết sản phẩm (kèm tăng lượt xem, bình luận, sản phẩm liên quan)
     */
    public function detail() {
        if (isset($_GET['idsp']) && $_GET['idsp'] > 0) {
            $id = (int)$_GET['idsp'];
            
            // Xử lý gửi bình luận (Thêm comment)
            if (isset($_POST['guibinhluan']) && isset($_SESSION['user'])) {
                $noidung = trim($_POST['noidung']);
                $iduser = $_SESSION['user']['id'];
                $idpro = $id;
                $ngaybinhluan = date('H:i:s d/m/Y');
                if ($noidung != "") {
                    insert_binhluan($noidung, $iduser, $idpro, $ngaybinhluan);
                    echo "<script>window.location.href='index.php?act=chitiet&idsp=" . $id . "';</script>";
                    exit();
                }
            }
            
            increase_view($id);
            $onesp = loadone_sanpham($id);
            if ($onesp) {
                $sp_cung_loai = load_sanpham_cungloai($id, $onesp['id_danhmuc']);
                $listbinhluan = loadall_binhluan($id);
                include "views/chitiet.php";
            } else {
                echo "<div class='container'><p class='alert alert-danger'>Sản phẩm không tồn tại.</p></div>";
            }
        } else {
            echo "<script>window.location.href='index.php';</script>";
        }
    }

    /* ==================== ADMIN CRUD SẢN PHẨM ==================== */
    
    /**
     * Danh sách sản phẩm của trang quản trị
     */
    public function adminList() {
        $kyw = "";
        $iddm = 0;
        if (isset($_POST['listok'])) {
            $kyw = trim($_POST['kyw']);
            $iddm = (int)$_POST['iddm'];
        }
        $listsanpham = loadall_sanpham($kyw, $iddm);
        $listdanhmuc = loadall_danhmuc();
        include "sanpham/list.php";
    }

    /**
     * Thêm sản phẩm mới ở admin
     */
    public function adminAdd() {
        $thongbao = "";
        $error = "";
        if (isset($_POST['themmoi'])) {
            $iddm = (int)$_POST['iddm'];
            $tensp = trim($_POST['tensp']);
            $giasp = (double)$_POST['giasp'];
            $mota = trim($_POST['mota']);
            
            $hinh = "";
            if (isset($_FILES['hinh']['name']) && $_FILES['hinh']['name'] != "") {
                $target_dir = "../uploads/";
                $filename = time() . "_" . basename($_FILES['hinh']['name']);
                $target_file = $target_dir . $filename;
                if (move_uploaded_file($_FILES['hinh']['tmp_name'], $target_file)) {
                    $hinh = $filename;
                }
            }

            if ($tensp != "" && $iddm > 0) {
                insert_sanpham($tensp, $giasp, $hinh, $mota, $iddm);
                $thongbao = "Thêm sản phẩm mới thành công!";
            } else {
                $error = "Tên sản phẩm và Danh mục là bắt buộc!";
            }
        }
        $listdanhmuc = loadall_danhmuc();
        include "sanpham/add.php";
    }

    /**
     * Trang chỉnh sửa sản phẩm ở admin
     */
    public function adminEdit() {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $sp = loadone_sanpham((int)$_GET['id']);
        }
        $listdanhmuc = loadall_danhmuc();
        include "sanpham/update.php";
    }

    /**
     * Cập nhật thông tin sản phẩm ở admin
     */
    public function adminUpdate() {
        $thongbao = "";
        $error = "";
        if (isset($_POST['capnhat'])) {
            $id = (int)$_POST['id'];
            $iddm = (int)$_POST['iddm'];
            $tensp = trim($_POST['tensp']);
            $giasp = (double)$_POST['giasp'];
            $mota = trim($_POST['mota']);
            
            $hinh = "";
            if (isset($_FILES['hinh']['name']) && $_FILES['hinh']['name'] != "") {
                $target_dir = "../uploads/";
                $filename = time() . "_" . basename($_FILES['hinh']['name']);
                $target_file = $target_dir . $filename;
                if (move_uploaded_file($_FILES['hinh']['tmp_name'], $target_file)) {
                    $hinh = $filename;
                }
            }

            if ($tensp != "" && $iddm > 0) {
                update_sanpham($id, $tensp, $giasp, $hinh, $mota, $iddm);
                $thongbao = "Cập nhật sản phẩm thành công!";
            } else {
                $error = "Tên sản phẩm và Danh mục là bắt buộc!";
            }
        }
        $listsanpham = loadall_sanpham();
        $listdanhmuc = loadall_danhmuc();
        include "sanpham/list.php";
    }

    /**
     * Xóa sản phẩm ở admin
     */
    public function adminDelete() {
        $thongbao = "";
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            delete_sanpham((int)$_GET['id']);
            $thongbao = "Xóa sản phẩm thành công!";
        }
        $listsanpham = loadall_sanpham();
        $listdanhmuc = loadall_danhmuc();
        include "sanpham/list.php";
    }
}
?>
