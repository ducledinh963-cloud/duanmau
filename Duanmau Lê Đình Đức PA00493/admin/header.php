<?php
session_start();
// Kiểm tra quyền truy cập Admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
    header("Location: ../index.php?act=dangnhap");
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị - foodmap.asia</title>
    <!-- CSS Quản trị (Thêm tham số v=3.0 để tránh bị cache trình duyệt) -->
    <link rel="stylesheet" href="../css/admin.css?v=3.0">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- ADMIN HEADER -->
    <header class="admin-header">
        <div class="admin-title">
            <h1><i class="fa-solid fa-user-gear"></i> FOODMAP <span>ADMIN</span></h1>
        </div>
        <ul class="admin-nav">
            <li class="<?= (!isset($_GET['act']) || $_GET['act'] == '' || strpos($_GET['act'], 'danhmuc') !== false) ? 'active' : '' ?>">
                <a href="index.php?act=listdanhmuc"><i class="fa-solid fa-folder"></i> Danh mục</a>
            </li>
            <li class="<?= (isset($_GET['act']) && strpos($_GET['act'], 'sanpham') !== false) ? 'active' : '' ?>">
                <a href="index.php?act=listsanpham"><i class="fa-solid fa-box-open"></i> Sản phẩm</a>
            </li>
            <li class="<?= (isset($_GET['act']) && strpos($_GET['act'], 'tintuc') !== false) ? 'active' : '' ?>">
                <a href="index.php?act=listtintuc"><i class="fa-solid fa-newspaper"></i> Bài viết</a>
            </li>
            <li class="<?= (isset($_GET['act']) && strpos($_GET['act'], 'donhang') !== false) ? 'active' : '' ?>">
                <a href="index.php?act=listdonhang"><i class="fa-solid fa-cart-shopping"></i> Đơn hàng</a>
            </li>
            <li class="<?= (isset($_GET['act']) && strpos($_GET['act'], 'taikhoan') !== false) ? 'active' : '' ?>">
                <a href="index.php?act=listtaikhoan"><i class="fa-solid fa-users"></i> Khách hàng</a>
            </li>
            <li class="<?= (isset($_GET['act']) && strpos($_GET['act'], 'binhluan') !== false) ? 'active' : '' ?>">
                <a href="index.php?act=listbinhluan"><i class="fa-solid fa-comments"></i> Bình luận</a>
            </li>
            <li class="<?= (isset($_GET['act']) && strpos($_GET['act'], 'thongke') !== false) ? 'active' : '' ?>">
                <a href="index.php?act=thongke"><i class="fa-solid fa-chart-line"></i> Thống kê</a>
            </li>
            <li>
                <a href="../index.php" target="_blank" class="nav-link-client"><i class="fa-solid fa-globe"></i> Xem Website client</a>
            </li>
            <li>
                <a href="index.php?act=thoat" class="nav-link-logout"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
            </li>
        </ul>
    </header>
