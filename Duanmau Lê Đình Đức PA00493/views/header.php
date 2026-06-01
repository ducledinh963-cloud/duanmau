<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>foodmap.asia - Nông Sản Sạch & Đặc Sản Vùng Miền</title>
    <!-- CSS chính -->
    <link rel="stylesheet" href="css/style.css?v=4.0">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- TOP BAR -->
    <div class="top-bar">
        <div>
            <i class="fa-solid fa-phone"></i> HOTLINE: <strong style="color: #ff9f00;">037 53 12345</strong> | <i class="fa-solid fa-gift"></i> Khuyến mãi ngập tràn!
        </div>
        <div class="top-bar-right">
            <a href="index.php?act=gioithieu"><i class="fa-solid fa-circle-info"></i> Giới thiệu</a>
            <a href="index.php?act=lienhe"><i class="fa-solid fa-envelope"></i> Liên hệ</a>
            <?php if (isset($_SESSION['user'])): ?>
                <span style="color: #ff9f00; font-weight: 600;">Chào, <?= $_SESSION['user']['user'] ?></span>
                <?php if ($_SESSION['user']['role'] == 1): ?>
                    <a href="admin/index.php" style="color: #4ade80;"><i class="fa-solid fa-user-shield"></i> Trang Quản trị</a>
                <?php endif; ?>
                <a href="index.php?act=thoat"><i class="fa-solid fa-right-from-bracket"></i> Thoát</a>
            <?php else: ?>
                <a href="index.php?act=dangnhap"><i class="fa-solid fa-lock"></i> Đăng nhập</a>
                <a href="index.php?act=dangky"><i class="fa-solid fa-user-plus"></i> Đăng ký</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- MAIN HEADER -->
    <header class="main-header">
        <div class="logo">
            <a href="index.php">
                <i class="fa-solid fa-leaf"></i> foodmap<span>.asia</span>
            </a>
        </div>

        <div class="search-box">
            <form action="index.php?act=sanpham" method="POST">
                <input type="text" name="kyw" placeholder="Tìm sản phẩm tươi ngon, đặc sản vùng miền..." value="<?= isset($_POST['kyw']) ? htmlspecialchars($_POST['kyw']) : '' ?>">
                <button type="submit" name="timkiem"><i class="fa-solid fa-magnifying-glass"></i> Tìm kiếm</button>
            </form>
        </div>

        <div class="header-actions">
            <?php if (isset($_SESSION['user'])): ?>
                <a href="index.php?act=edit_taikhoan" class="user-btn">
                    <i class="fa-regular fa-user"></i> Tài khoản
                </a>
            <?php else: ?>
                <a href="index.php?act=dangnhap" class="user-btn">
                    <i class="fa-regular fa-user"></i> Đăng nhập
                </a>
            <?php endif; ?>

            <?php
            $cart_count = 0;
            $cart_total = 0;
            if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $item) {
                    $cart_count += $item['qty'];
                    $cart_total += $item['price'] * $item['qty'];
                }
            }
            ?>
            <a href="index.php?act=viewcart" class="cart-btn">
                <i class="fa-solid fa-cart-shopping"></i> Giỏ hàng / <?= number_format($cart_total, 0, ',', '.') ?>đ <span class="cart-count"><?= $cart_count ?></span>
            </a>
        </div>
    </header>

    <!-- NAVIGATION BAR -->
    <nav>
        <div class="nav-container">
            <div class="category-dropdown-btn">
                <i class="fa-solid fa-bars"></i> DANH MỤC SẢN PHẨM
            </div>
            <ul class="nav-menu">
                <li><a href="index.php">TRANG CHỦ</a></li>
                <?php
                if (isset($dsdm) && is_array($dsdm)) {
                    foreach ($dsdm as $dm) {
                        extract($dm);
                        echo '<li><a href="index.php?act=sanpham&iddm=' . $id . '">' . htmlspecialchars(mb_strtoupper($name, 'UTF-8')) . '</a></li>';
                    }
                } else {
                    echo '<li><a href="index.php?act=sanpham">SẢN PHẨM</a></li>';
                }
                ?>
            </ul>
        </div>
    </nav>
