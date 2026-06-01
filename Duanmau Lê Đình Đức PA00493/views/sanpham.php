<!-- BREADCRUMBS -->
<div class="breadcrumb-nav">
    <a href="index.php">TRANG CHỦ</a> / <span>SHOP</span>
</div>

<div class="container">
    <div class="shop-layout">
        <!-- SIDEBAR -->
        <aside class="shop-sidebar">
            
            <!-- WIDGET 1: DANH MỤC SẢN PHẨM -->
            <div class="sidebar-widget">
                <span class="widget-title">Danh mục sản phẩm</span>
                <ul class="filter-list">
                    <li class="<?= (!isset($_GET['iddm']) || $_GET['iddm'] == 0) ? 'active' : '' ?>" style="margin-bottom: 8px;">
                        <a href="index.php?act=sanpham" style="font-size: 0.9rem; display: block; font-weight: 500; padding: 4px 0;">Tất cả sản phẩm</a>
                    </li>
                    <?php
                    if (isset($dsdm) && is_array($dsdm)) {
                        foreach ($dsdm as $dm) {
                            extract($dm);
                            $active_class = (isset($_GET['iddm']) && $_GET['iddm'] == $id) ? 'active' : '';
                            echo '<li class="' . $active_class . '" style="margin-bottom: 8px; border-bottom: 1px dashed var(--border-color); padding-bottom: 6px;">
                                    <a href="index.php?act=sanpham&iddm=' . $id . '" style="font-size: 0.9rem; display: block;">
                                        ' . htmlspecialchars($name) . '
                                    </a>
                                  </li>';
                        }
                    }
                    ?>
                </ul>
            </div>

            <!-- WIDGET 2: TIN TỨC MỚI NHẤT -->
            <div class="sidebar-widget">
                <span class="widget-title">Tin tức mới nhất</span>
                <div class="sidebar-news-list">
                    <?php
                    if (isset($listtintuc) && is_array($listtintuc) && count($listtintuc) > 0) {
                        foreach ($listtintuc as $news) {
                            extract($news);
                            // Tách ngày và tháng để hiển thị vòng tròn
                            // Giả định ngày lưu dạng "25 Th7", ta có thể tách hoặc in thẳng
                            $parts = explode(" ", $date);
                            $day = isset($parts[0]) ? $parts[0] : '25';
                            $month = isset($parts[1]) ? $parts[1] : 'Th7';
                            ?>
                            <div class="sidebar-news-item">
                                <div class="news-date-badge">
                                    <span class="day"><?= htmlspecialchars($day) ?></span>
                                    <span class="month"><?= htmlspecialchars($month) ?></span>
                                </div>
                                <a href="index.php?act=tintuc_detail&id=<?= $id ?>" class="news-sidebar-title" onclick="alert('Đang chuyển hướng đến chi tiết tin tức: <?= htmlspecialchars($title) ?>')">
                                    <?= htmlspecialchars($title) ?>
                                </a>
                            </div>
                            <?php
                        }
                    } else {
                        // Dữ liệu tĩnh dự phòng nếu chưa có CSDL
                        $mock_news = [
                            ['title' => 'Hồng treo gió và 4 món ăn cực lạ miệng', 'day' => '25', 'month' => 'Th7'],
                            ['title' => 'Chương trình khuyến mãi – Happy Weekend – Cuối tuần sale lớn', 'day' => '25', 'month' => 'Th7'],
                            ['title' => 'Bơ Tứ Quý dẻo bùi, thơm ngon nổi tiếng vùng Đắk Lắk', 'day' => '25', 'month' => 'Th7']
                        ];
                        foreach ($mock_news as $mn) {
                            ?>
                            <div class="sidebar-news-item">
                                <div class="news-date-badge">
                                    <span class="day"><?= $mn['day'] ?></span>
                                    <span class="month"><?= $mn['month'] ?></span>
                                </div>
                                <a href="#" class="news-sidebar-title" onclick="alert('Tin tức: <?= $mn['title'] ?>')">
                                    <?= $mn['title'] ?>
                                </a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>

            <!-- WIDGET 3: SẢN PHẨM MỚI -->
            <div class="sidebar-widget">
                <span class="widget-title">Sản phẩm mới</span>
                <div class="sidebar-product-list">
                    <?php
                    if (isset($sidebar_sp) && is_array($sidebar_sp) && count($sidebar_sp) > 0) {
                        // Lấy 5 sản phẩm đầu
                        $count = 0;
                        foreach ($sidebar_sp as $sp) {
                            if ($count >= 5) break;
                            extract($sp);
                            $linksp = "index.php?act=chitiet&idsp=" . $id;
                            $hinh_path = get_product_image($img);
                            $gia_format = number_format($price, 0, ',', '.') . 'đ';
                            ?>
                            <div class="sidebar-product-item">
                                <a href="<?= $linksp ?>">
                                    <img src="<?= $hinh_path ?>" alt="<?= htmlspecialchars($name) ?>" class="sidebar-product-thumb">
                                </a>
                                <div class="sidebar-product-info">
                                    <a href="<?= $linksp ?>" class="sidebar-product-name"><?= htmlspecialchars($name) ?></a>
                                    <span class="sidebar-product-price"><?= $gia_format ?></span>
                                    <div class="product-rating" style="font-size: 0.7rem; margin-bottom: 0;">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $count++;
                        }
                    }
                    ?>
                </div>
            </div>

            <!-- WIDGET 4: LỌC THEO GIÁ (ĐÃ CÓ TRONG BÀI) -->
            <div class="sidebar-widget" style="padding: 15px 20px;">
                <span class="widget-title" style="background-color: var(--secondary-color);">Lọc theo giá</span>
                <ul class="filter-list">
                    <li style="margin-bottom: 8px;"><a href="index.php?act=sanpham<?= isset($_GET['iddm']) ? '&iddm='.$_GET['iddm'] : '' ?>&price_max=30000" style="font-size: 0.85rem;">Dưới 30.000đ</a></li>
                    <li style="margin-bottom: 8px;"><a href="index.php?act=sanpham<?= isset($_GET['iddm']) ? '&iddm='.$_GET['iddm'] : '' ?>&price_min=30000&price_max=100000" style="font-size: 0.85rem;">30.000đ - 100.000đ</a></li>
                    <li style="margin-bottom: 8px;"><a href="index.php?act=sanpham<?= isset($_GET['iddm']) ? '&iddm='.$_GET['iddm'] : '' ?>&price_min=100000" style="font-size: 0.85rem;">Trên 100.000đ</a></li>
                </ul>
                <a href="index.php?act=sanpham" class="form-btn" style="display: block; text-align: center; text-transform: uppercase; font-size: 0.75rem; padding: 8px 10px; margin-top: 15px; background-color: #94a3b8;">Xóa bộ lọc</a>
            </div>

        </aside>

        <!-- MAIN SHOP CONTENT -->
        <main class="shop-content">
            
            <!-- SORT AND RESULTS ROW -->
            <div class="shop-sort-row">
                <div>
                    Hiển thị tất cả <strong><?= is_array($listsanpham) ? count($listsanpham) : 0 ?></strong> kết quả
                </div>
                <div>
                    <select onchange="alert('Tính năng sắp xếp đang được phát triển!')">
                        <option value="">Thứ tự mặc định</option>
                        <option value="price_asc">Giá tăng dần</option>
                        <option value="price_desc">Giá giảm dần</option>
                        <option value="name_asc">Tên A-Z</option>
                    </select>
                </div>
            </div>

            <!-- PRODUCT GRID -->
            <div class="product-grid">
                <?php
                if (isset($listsanpham) && is_array($listsanpham) && count($listsanpham) > 0) {
                    foreach ($listsanpham as $sp) {
                        extract($sp);
                        $linksp = "index.php?act=chitiet&idsp=" . $id;
                        $hinh_path = get_product_image($img);
                        $gia_format = number_format($price, 0, ',', '.') . 'đ';
                        ?>
                        <div class="product-card">
                            <div class="product-img-wrapper">
                                <a href="<?= $linksp ?>"><img class="product-img" src="<?= $hinh_path ?>" alt="<?= htmlspecialchars($name) ?>"></a>
                            </div>
                            <div class="product-info">
                                <span class="product-category">Nông Sản Sạch</span>
                                <a href="<?= $linksp ?>"><h3 class="product-name"><?= htmlspecialchars($name) ?></h3></a>
                                <div class="product-rating">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <span>(4.8)</span>
                                </div>
                                <div class="product-price-row">
                                    <span class="product-price"><?= $gia_format ?></span>
                                    <button class="add-to-cart-btn" onclick="window.location.href='index.php?act=addtocart&id=<?= $id ?>'">+</button>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div style="grid-column: 1/-1; text-align: center; padding: 40px 0;">
                            <i class="fa-regular fa-folder-open" style="font-size: 3rem; color: var(--text-muted); margin-bottom: 15px; display: block;"></i>
                            <p style="color: var(--text-muted);">Không tìm thấy sản phẩm nào phù hợp với bộ lọc.</p>
                          </div>';
                }
                ?>
            </div>
        </main>
    </div>
</div>
