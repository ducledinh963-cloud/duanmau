<?php
// Bật hiển thị lỗi để dễ gỡ lỗi khi phát triển
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Import các model cần thiết từ thư mục cha
include_once "../models/pdo.php";
include_once "../models/danhmuc.php";
include_once "../models/sanpham.php";
include_once "../models/taikhoan.php";
include_once "../models/tintuc.php";
include_once "../models/donhang.php";
include_once "../models/thongke.php";
include_once "../models/binhluan.php";

// Import các controllers cho admin
include_once "../controllers/danhmuc.php";
include_once "../controllers/sanpham.php";

// Khởi tạo các controller class
$danhmucCtrl = new danhmuc();
$sanphamCtrl = new sanpham();

// Tự động tạo thư mục uploads nếu chưa tồn tại để lưu trữ hình ảnh tải lên
if (!file_exists("../uploads")) {
    mkdir("../uploads", 0777, true);
}

// Bắt đầu include phần header dùng chung của admin (đã chứa session_start() và check quyền)
include "header.php";

// Phân luồng điều hướng của trang quản trị (Admin Routing)
if (isset($_GET['act']) && $_GET['act'] != "") {
    $act = $_GET['act'];
    switch ($act) {
        
        /* ==================== QUẢN LÝ DANH MỤC ==================== */
        case 'adddanhmuc':
            $danhmucCtrl->adminAdd();
            break;
            
        case 'listdanhmuc':
            $danhmucCtrl->adminList();
            break;
            
        case 'xoadm':
            $danhmucCtrl->adminDelete();
            break;
            
        case 'suadm':
            $danhmucCtrl->adminEdit();
            break;
            
        case 'updatedm':
            $danhmucCtrl->adminUpdate();
            break;
            
        /* ==================== QUẢN LÝ SẢN PHẨM ==================== */
        case 'addsanpham':
            $sanphamCtrl->adminAdd();
            break;
            
        case 'listsanpham':
            $sanphamCtrl->adminList();
            break;
            
        case 'xoasp':
            $sanphamCtrl->adminDelete();
            break;
            
        case 'suasp':
            $sanphamCtrl->adminEdit();
            break;
            
        case 'updatesp':
            $sanphamCtrl->adminUpdate();
            break;

        /* ==================== QUẢN LÝ BÀI VIẾT / TIN TỨC ==================== */
        case 'addtintuc':
            if (isset($_POST['themmoi'])) {
                $title = trim($_POST['title']);
                $date = trim($_POST['date']);
                $mota = trim($_POST['mota']);
                
                // Xử lý tải ảnh tin tức lên
                $hinh = "";
                if (isset($_FILES['hinh']['name']) && $_FILES['hinh']['name'] != "") {
                    $target_dir = "../uploads/";
                    $filename = time() . "_" . basename($_FILES['hinh']['name']);
                    $target_file = $target_dir . $filename;
                    
                    if (move_uploaded_file($_FILES['hinh']['tmp_name'], $target_file)) {
                        $hinh = $filename;
                    }
                }

                if ($title != "") {
                    if ($date == "") {
                        $date = date('d/m/Y');
                    }
                    insert_tintuc($title, $date, $hinh, $mota);
                    $thongbao = "Thêm bài viết mới thành công!";
                } else {
                    $error = "Tiêu đề bài viết không được để trống!";
                }
            }
            include "tintuc/add.php";
            break;
            
        case 'listtintuc':
            $kyw = "";
            if (isset($_POST['listok'])) {
                $kyw = trim($_POST['kyw']);
            }
            $listtintuc = loadall_tintuc_admin($kyw);
            include "tintuc/list.php";
            break;
            
        case 'xoatintuc':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                delete_tintuc((int)$_GET['id']);
                $thongbao = "Xóa bài viết thành công!";
            }
            $listtintuc = loadall_tintuc_admin();
            include "tintuc/list.php";
            break;
            
        case 'suatintuc':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $tin = loadone_tintuc((int)$_GET['id']);
            }
            include "tintuc/update.php";
            break;
            
        case 'updatetintuc':
            if (isset($_POST['capnhat'])) {
                $id = (int)$_POST['id'];
                $title = trim($_POST['title']);
                $date = trim($_POST['date']);
                $mota = trim($_POST['mota']);
                
                // Xử lý tải ảnh tin tức (nếu có tải ảnh mới)
                $hinh = "";
                if (isset($_FILES['hinh']['name']) && $_FILES['hinh']['name'] != "") {
                    $target_dir = "../uploads/";
                    $filename = time() . "_" . basename($_FILES['hinh']['name']);
                    $target_file = $target_dir . $filename;
                    
                    if (move_uploaded_file($_FILES['hinh']['tmp_name'], $target_file)) {
                        $hinh = $filename;
                    }
                }

                if ($title != "") {
                    if ($date == "") {
                        $date = date('d/m/Y');
                    }
                    update_tintuc($id, $title, $date, $hinh, $mota);
                    $thongbao = "Cập nhật bài viết thành công!";
                } else {
                    $error = "Tiêu đề bài viết không được để trống!";
                }
            }
            $listtintuc = loadall_tintuc_admin();
            include "tintuc/list.php";
            break;

        /* ==================== QUẢN LÝ ĐƠN HÀNG ==================== */
        case 'listdonhang':
            $kyw = "";
            if (isset($_POST['listok'])) {
                $kyw = trim($_POST['kyw']);
            }
            $listdonhang = loadall_donhang($kyw);
            include "donhang/list.php";
            break;

        case 'chitietdonhang':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = (int)$_GET['id'];
                $dh = loadone_donhang($id);
                if ($dh) {
                    $list_chitiet = loadall_donhang_chitiet($id);
                    include "donhang/detail.php";
                } else {
                    $error = "Đơn hàng không tồn tại.";
                    $listdonhang = loadall_donhang();
                    include "donhang/list.php";
                }
            } else {
                $listdonhang = loadall_donhang();
                include "donhang/list.php";
            }
            break;

        case 'updatedonhang':
            if (isset($_POST['capnhat'])) {
                $id = (int)$_POST['id'];
                $status = (int)$_POST['status'];
                update_donhang_status($id, $status);
                $thongbao = "Cập nhật trạng thái đơn hàng thành công!";
            }
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = (int)$_GET['id'];
            } else {
                $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
            }
            $dh = loadone_donhang($id);
            if ($dh) {
                $list_chitiet = loadall_donhang_chitiet($id);
                include "donhang/detail.php";
            } else {
                $listdonhang = loadall_donhang();
                include "donhang/list.php";
            }
            break;

        case 'xoadonhang':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                delete_donhang((int)$_GET['id']);
                $thongbao = "Xóa đơn hàng thành công!";
            }
            $listdonhang = loadall_donhang();
            include "donhang/list.php";
            break;

        /* ==================== QUẢN LÝ TÀI KHOẢN / KHÁCH HÀNG ==================== */
        case 'listtaikhoan':
            $kyw = "";
            if (isset($_POST['listok'])) {
                $kyw = trim($_POST['kyw']);
            }
            $listtaikhoan = loadall_taikhoan($kyw);
            include "taikhoan/list.php";
            break;

        case 'xoataikhoan':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = (int)$_GET['id'];
                if ($id == $_SESSION['user']['id']) {
                    $error = "Bạn không thể tự xóa tài khoản của chính mình!";
                } else {
                    delete_taikhoan($id);
                    $thongbao = "Xóa tài khoản thành công!";
                }
            }
            $listtaikhoan = loadall_taikhoan();
            include "taikhoan/list.php";
            break;

        /* ==================== QUẢN LÝ BÌNH LUẬN ==================== */
        case 'listbinhluan':
            $listbinhluan = loadall_binhluan_admin();
            include "binhluan/list.php";
            break;

        case 'xoabinhluan':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                delete_binhluan((int)$_GET['id']);
                $thongbao = "Xóa bình luận thành công!";
            }
            $listbinhluan = loadall_binhluan_admin();
            include "binhluan/list.php";
            break;

        /* ==================== BÁO CÁO & THỐNG KÊ ==================== */
        case 'thongke':
            $listthongke = loadall_thongke_sanpham();
            $revenue_stats = load_revenue_statistics();
            $total_customers = count_total_customers();
            $top_selling = load_top_selling_products();
            include "thongke/list.php";
            break;

        case 'thoat':
            session_destroy();
            header("Location: ../index.php");
            exit();

        default:
            $listdanhmuc = loadall_danhmuc();
            include "danhmuc/list.php";
            break;
    }
} else {
    // Mặc định tải trang danh sách danh mục
    $listdanhmuc = loadall_danhmuc();
    include "danhmuc/list.php";
}

// Bắt đầu include phần footer dùng chung của admin
include "footer.php";
?>
