<?php
class danhmuc {
    /**
     * Danh sách danh mục
     */
    public function adminList() {
        $kyw = "";
        if (isset($_POST['listok'])) {
            $kyw = trim($_POST['kyw']);
        }
        $listdanhmuc = loadall_danhmuc($kyw);
        include "danhmuc/list.php";
    }

    /**
     * Thêm danh mục mới
     */
    public function adminAdd() {
        $thongbao = "";
        $error = "";
        if (isset($_POST['themmoi'])) {
            $tenloai = trim($_POST['tenloai']);
            if ($tenloai != "") {
                try {
                    insert_danhmuc($tenloai);
                    $thongbao = "Thêm danh mục mới thành công!";
                } catch (Exception $e) {
                    $error = "Có lỗi xảy ra hoặc danh mục đã tồn tại.";
                }
            } else {
                $error = "Tên danh mục không được để trống!";
            }
        }
        include "danhmuc/add.php";
    }

    /**
     * Trang chỉnh sửa danh mục
     */
    public function adminEdit() {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $dm = loadone_danhmuc((int)$_GET['id']);
        }
        include "danhmuc/update.php";
    }

    /**
     * Cập nhật danh mục
     */
    public function adminUpdate() {
        $thongbao = "";
        $error = "";
        if (isset($_POST['capnhat'])) {
            $id = (int)$_POST['id'];
            $tenloai = trim($_POST['tenloai']);
            if ($tenloai != "") {
                update_danhmuc($id, $tenloai);
                $thongbao = "Cập nhật danh mục thành công!";
            } else {
                $error = "Tên danh mục không được để trống!";
            }
        }
        $listdanhmuc = loadall_danhmuc();
        include "danhmuc/list.php";
    }

    /**
     * Xóa danh mục
     */
    public function adminDelete() {
        $thongbao = "";
        $error = "";
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            try {
                delete_danhmuc((int)$_GET['id']);
                $thongbao = "Xóa danh mục thành công!";
            } catch (Exception $e) {
                $error = "Không thể xóa danh mục này vì có sản phẩm đang thuộc danh mục này.";
            }
        }
        $listdanhmuc = loadall_danhmuc();
        include "danhmuc/list.php";
    }
}
?>
