<!-- HERO BANNER -->
<div class="hero-banner">
    <!-- MAIN SLIDER -->
    <div class="main-slider">
        <img class="slider-img" src="https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=1200" alt="Mua Sắm Nông Sản Sạch">
        <div class="slider-content">
            <h2>MUA SẮM TRƯỚC - TRẢ TIỀN SAU</h2>
            <p>Giảm ngay 50% tối đa 100k khi thanh toán trực tuyến. Áp dụng cho mọi loại nông sản & đặc sản.</p>
        </div>
    </div>

    <!-- SIDE BANNERS -->
    <div class="side-banners">
        <div class="side-banner-item">
            <img src="https://images.unsplash.com/photo-1498837167922-ddd27525d352?q=80&w=500" alt="Tin nổi bật 1">
            <div style="position: absolute; bottom: 10px; left: 10px; color: white; text-shadow: 1px 1px 3px black; font-weight: 600; font-size: 0.9rem;">
                Mật Ong Hoa Tràm - Mua 1 Tặng 1
            </div>
        </div>
        <div class="side-banner-item">
            <img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?q=80&w=500" alt="Tin nổi bật 2">
            <div style="position: absolute; bottom: 10px; left: 10px; color: white; text-shadow: 1px 1px 3px black; font-weight: 600; font-size: 0.9rem;">
                Thanh nhãn thơm ngon - Chỉ từ 59K
            </div>
        </div>
    </div>
</div>

<!-- CONTAINER -->
<div class="container">
    <!-- KHU VỰC ĐI CHỢ ONLINE -->
    <div class="section-header">
        <h2 class="section-title">ĐI CHỢ ONLINE</h2>
        <div class="category-tabs" id="dicho-tabs">
            <span class="category-tab-item active" data-target="ready-to-cook">Ready to cook</span>
            <span class="category-tab-item" data-target="rau-cu-qua">Rau củ quả</span>
            <span class="category-tab-item" data-target="thit-hai-san">Thịt – Hải sản</span>
            <span class="category-tab-item" data-target="nhu-yeu-pham">Nhu yếu phẩm</span>
            <span class="category-tab-item" data-target="do-say-an-vat">Đồ sấy ăn vặt</span>
        </div>
    </div>

    <div class="di-cho-online-layout" style="display: grid; grid-template-columns: 280px 1fr; gap: 25px; margin-bottom: 50px;">
        <!-- BANNER BÊN TRÁI -->
        <div class="di-cho-online-banner" style="border-radius: 16px; overflow: hidden; position: relative; box-shadow: var(--shadow-sm); transition: var(--transition);">
            <img src="uploads/banner_dicho.png" alt="Đi Chợ Online" style="width: 100%; height: 100%; object-fit: cover; display: block;">
            <div class="banner-overlay" style="position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.6)); display: flex; flex-direction: column; justify-content: space-between; padding: 25px; color: white;">
                <div>
                    <h3 style="font-size: 1.8rem; font-weight: 800; text-shadow: 1px 1px 3px rgba(0,0,0,0.8); line-height: 1.2; margin: 0;">Rau củ quả<br>Đà Lạt</h3>
                    <h4 style="font-size: 1.3rem; font-weight: 700; text-shadow: 1px 1px 3px rgba(0,0,0,0.8); margin-top: 10px; color: #ff9f00; margin-bottom: 0;">Thịt cá<br>tươi ngon</h4>
                </div>
                <div style="text-align: center;">
                    <p style="font-size: 1.3rem; font-weight: 800; color: #fef08a; text-shadow: 2px 2px 4px rgba(0,0,0,0.9); text-transform: uppercase; border: 2px dashed #fef08a; padding: 6px; border-radius: 8px; margin: 0; line-height: 1.3;">QUẸO LỰA<br>BÀ KONG ƠI !!!</p>
                </div>
            </div>
        </div>

        <!-- GRID SẢN PHẨM BÊN PHẢI -->
        <div class="product-grid">
            <?php
            if (isset($sp_dicho) && is_array($sp_dicho) && count($sp_dicho) > 0) {
                // Lọc sản phẩm thuộc danh mục Đi Chợ Online (id_danhmuc = 1)
                $sp_dicho_section = [];
                foreach ($sp_dicho as $sp) {
                    if ($sp['id_danhmuc'] == 1) {
                        $sp_dicho_section[] = $sp;
                    }
                }
                if (empty($sp_dicho_section)) {
                    $sp_dicho_section = array_slice($sp_dicho, 0, 8);
                }

                foreach ($sp_dicho_section as $sp) {
                    extract($sp);
                    $linksp = "index.php?act=chitiet&idsp=" . $id;
                    $hinh_path = get_product_image($img);
                    $gia_format = number_format($price, 0, ',', '.') . 'đ';
                    
                    // Phân loại danh mục cho tính năng lọc
                    $cat_class = 'nhu-yeu-pham';
                    $name_lower = mb_strtolower($name, 'UTF-8');
                    
                    if (strpos($name_lower, 'thịt') !== false || strpos($name_lower, 'cá ') !== false || strpos($name_lower, 'chả mực') !== false || strpos($name_lower, 'hải sản') !== false) {
                        $cat_class = 'thit-hai-san';
                    } elseif (strpos($name_lower, 'rau') !== false || strpos($name_lower, 'củ') !== false || strpos($name_lower, 'quả') !== false || strpos($name_lower, 'bơ') !== false || strpos($name_lower, 'sầu riêng') !== false || strpos($name_lower, 'bưởi') !== false || strpos($name_lower, 'cherry') !== false || strpos($name_lower, 'cam') !== false || strpos($name_lower, 'chuối') !== false || strpos($name_lower, 'xoài') !== false || strpos($name_lower, 'nhãn') !== false || strpos($name_lower, 'ớt') !== false || strpos($name_lower, 'cà chua') !== false || strpos($name_lower, 'bắp cải') !== false || strpos($name_lower, 'xà lách') !== false || strpos($name_lower, 'khoai') !== false || strpos($name_lower, 'bí đỏ') !== false || strpos($name_lower, 'nấm') !== false || strpos($name_lower, 'tỏi') !== false || strpos($name_lower, 'gừng') !== false || strpos($name_lower, 'hành') !== false || strpos($name_lower, 'mướp') !== false || strpos($name_lower, 'dưa leo') !== false || strpos($name_lower, 'cải') !== false || strpos($name_lower, 'su su') !== false || strpos($name_lower, 'đậu') !== false || strpos($name_lower, 'măng tây') !== false) {
                        $cat_class = 'rau-cu-qua';
                    } elseif (strpos($name_lower, 'kẹo') !== false || strpos($name_lower, 'cơm cháy') !== false || strpos($name_lower, 'nem') !== false || strpos($name_lower, 'tré') !== false || strpos($name_lower, 'mè xửng') !== false || strpos($name_lower, 'sấy') !== false) {
                        $cat_class = 'do-say-an-vat';
                    } elseif (strpos($name_lower, 'mì') !== false || strpos($name_lower, 'ready') !== false || strpos($name_lower, 'ăn liền') !== false || strpos($name_lower, 'lẩu') !== false || strpos($name_lower, 'bánh ép') !== false || strpos($name_lower, 'bánh cóng') !== false) {
                        $cat_class = 'ready-to-cook';
                    }
                    
                    $is_default = 'true';
                    $display_style = 'display: flex;';
                    ?>
                    <div class="product-card" data-category="<?= $cat_class ?>" data-default="<?= $is_default ?>" style="<?= $display_style ?> transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); opacity: 1;">
                        <div class="product-img-wrapper">
                            <a href="<?= $linksp ?>"><img class="product-img" src="<?= $hinh_path ?>" alt="<?= htmlspecialchars($name) ?>"></a>
                            <span class="product-tag">Hot</span>
                        </div>
                        <div class="product-info">
                            <span class="product-category">Đi Chợ Online</span>
                            <a href="<?= $linksp ?>"><h3 class="product-name" style="font-size: 0.9rem; font-weight: 600; line-height: 1.3; height: 36px; overflow: hidden;"><?= htmlspecialchars($name) ?></h3></a>
                            <div class="product-rating" style="font-size: 0.75rem; color: #ffc107; margin-bottom: 5px;">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <span>(5.0)</span>
                            </div>
                            <div class="product-price-row">
                                <span class="product-price" style="color: var(--danger-color); font-weight: 700; font-size: 1.1rem;"><?= $gia_format ?></span>
                                <button class="add-to-cart-btn" onclick="window.location.href='index.php?act=addtocart&id=<?= $id ?>'">+</button>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<p style="grid-column: 1/-1; text-align: center; color: var(--text-muted);">Không có sản phẩm nào cho Đi Chợ Online.</p>';
            }
            ?>
        </div>
    </div>

    <!-- 4 BANNER CHƯƠNG TRÌNH KHUYẾN MÃI -->
    <div class="promo-banners-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 25px; margin-top: 30px;">
        <!-- BANNER 1 -->
        <div class="promo-banner-card" style="height: 160px; border-radius: 16px; overflow: hidden; position: relative; box-shadow: var(--shadow-sm); transition: var(--transition);">
            <img src="https://images.unsplash.com/photo-1611080626919-7cf5a9dbab5b?q=80&w=500" alt="Mua 2 Tặng 1" style="width: 100%; height: 100%; object-fit: cover; display: block;">
            <div class="promo-overlay" style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(251, 191, 36, 0.45), rgba(217, 119, 6, 0.45)); display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 15px; text-align: center; color: white;">
                <h3 style="font-size: 1.3rem; font-weight: 800; text-shadow: 2px 2px 4px rgba(0,0,0,0.8); margin: 0; color: #fffbeb; text-transform: uppercase;">MUA 2 TẶNG 1</h3>
                <span style="font-size: 0.8rem; font-weight: 700; text-shadow: 1px 1px 3px rgba(0,0,0,0.8); background: #ff9f00; padding: 3px 10px; border-radius: 15px; margin-top: 8px; border: 1px dashed white; text-transform: uppercase; line-height: 1.2;">GIÁ CHỈ TỪ 19K</span>
            </div>
        </div>
        
        <!-- BANNER 2 -->
        <div class="promo-banner-card" style="height: 160px; border-radius: 16px; overflow: hidden; position: relative; box-shadow: var(--shadow-sm); transition: var(--transition);">
            <img src="https://images.unsplash.com/photo-1527661591475-527312dd65f5?q=80&w=500" alt="Hàng Mới Về" style="width: 100%; height: 100%; object-fit: cover; display: block;">
            <div class="promo-overlay" style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(56, 189, 248, 0.45), rgba(3, 105, 161, 0.45)); display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 15px; text-align: center; color: white;">
                <h3 style="font-size: 1.3rem; font-weight: 800; text-shadow: 2px 2px 4px rgba(0,0,0,0.8); margin: 0; color: #f0fdfa; text-transform: uppercase;">HÀNG MỚI VỀ</h3>
                <span style="font-size: 0.8rem; font-weight: 700; text-shadow: 1px 1px 3px rgba(0,0,0,0.8); background: #0284c7; padding: 3px 10px; border-radius: 15px; margin-top: 8px; border: 1px dashed white; text-transform: uppercase; line-height: 1.2;">CỰC KỲ TƯƠI NGON</span>
            </div>
        </div>
        
        <!-- BANNER 3 -->
        <div class="promo-banner-card" style="height: 160px; border-radius: 16px; overflow: hidden; position: relative; box-shadow: var(--shadow-sm); transition: var(--transition);">
            <img src="https://images.unsplash.com/photo-1602470520998-f4a52199a3d6?q=80&w=500" alt="Giảm đến 50%" style="width: 100%; height: 100%; object-fit: cover; display: block;">
            <div class="promo-overlay" style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(248, 113, 113, 0.45), rgba(185, 28, 28, 0.45)); display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 15px; text-align: center; color: white;">
                <h3 style="font-size: 1.3rem; font-weight: 800; text-shadow: 2px 2px 4px rgba(0,0,0,0.8); margin: 0; color: #fef2f2; text-transform: uppercase;">GIẢM ĐẾN 50%</h3>
                <span style="font-size: 0.8rem; font-weight: 700; text-shadow: 1px 1px 3px rgba(0,0,0,0.8); background: #dc2626; padding: 3px 10px; border-radius: 15px; margin-top: 8px; border: 1px dashed white; text-transform: uppercase; line-height: 1.2;">SĂN DEAL HỜI NGAY</span>
            </div>
        </div>
        
        <!-- BANNER 4 -->
        <div class="promo-banner-card" style="height: 160px; border-radius: 16px; overflow: hidden; position: relative; box-shadow: var(--shadow-sm); transition: var(--transition);">
            <img src="https://images.unsplash.com/photo-1628134785735-688e51626fd2?q=80&w=500" alt="Mua là có quà" style="width: 100%; height: 100%; object-fit: cover; display: block;">
            <div class="promo-overlay" style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(74, 222, 128, 0.45), rgba(21, 128, 61, 0.45)); display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 15px; text-align: center; color: white;">
                <h3 style="font-size: 1.3rem; font-weight: 800; text-shadow: 2px 2px 4px rgba(0,0,0,0.8); margin: 0; color: #f0fdf4; text-transform: uppercase;">MUA LÀ CÓ QUÀ</h3>
                <span style="font-size: 0.8rem; font-weight: 700; text-shadow: 1px 1px 3px rgba(0,0,0,0.8); background: #16a34a; padding: 3px 10px; border-radius: 15px; margin-top: 8px; border: 1px dashed white; text-transform: uppercase; line-height: 1.2;">QUÀ TẶNG TRỊ GIÁ 50K</span>
            </div>
        </div>
    </div>

    <!-- BANNER COUPON NGANG -->
    <div class="coupon-banner-wrapper" style="margin-bottom: 35px; border-radius: 16px; overflow: hidden; box-shadow: var(--shadow-sm); transition: var(--transition);">
        <img src="uploads/coupon_banner.png" alt="Voucher Ưu Đãi" style="width: 100%; display: block; height: auto; max-height: 140px; object-fit: cover;">
    </div>

    <!-- KHU VỰC TABS SẢN PHẨM TRANG CHỦ -->
    <div class="section-header" style="margin-top: 40px;">
        <div class="category-tabs" id="homepage-custom-tabs" style="width: 100%; display: flex; justify-content: flex-start; gap: 15px; border-bottom: none;">
            <span class="category-tab-item" data-target="giam-soc">GIẢM SỐC HÔM NAY</span>
            <span class="category-tab-item" data-target="trai-cay">TRÁI CÂY TƯƠI NGON</span>
            <span class="category-tab-item" data-target="an-ngon">ĂN NGON - NẤU NGON</span>
            <span class="category-tab-item active" data-target="an-sach" style="background-color: var(--primary-color); color: white; border-color: var(--primary-color);">ĂN SẠCH - SỐNG SẠCH</span>
        </div>
    </div>

    <div class="product-grid" id="homepage-custom-grid">
        <?php
        if (isset($sp_new) && is_array($sp_new) && count($sp_new) > 0) {
            // Danh sách hiển thị mặc định của ĂN SẠCH - SỐNG SẠCH
            $ansach_names = [
                'Bánh Ép Huế Gia Truyền Vị BBQ',
                'Cherry Mỹ Tươi Ngon, Giòn Ngọt, Size 9',
                'Sầu riêng Ri6 - Tươi, Hái già (Hộp 500g)',
                'Cam Sành Vĩnh Long Kiến Vàng Vắt Nước'
            ];

            foreach ($sp_new as $sp) {
                extract($sp);
                $linksp = "index.php?act=chitiet&idsp=" . $id;
                $hinh_path = get_product_image($img);
                $gia_format = number_format($price, 0, ',', '.') . 'đ';
                
                // Phân loại danh mục cho grid tabs dưới
                $tab_cat = 'an-sach'; // mặc định
                $name_lower = mb_strtolower($name, 'UTF-8');
                
                if ($price < 30000) {
                    $tab_cat = 'giam-soc';
                } elseif (strpos($name_lower, 'thịt') !== false || strpos($name_lower, 'cá') !== false || strpos($name_lower, 'trứng') !== false || strpos($name_lower, 'gạo') !== false) {
                    $tab_cat = 'an-ngon';
                } elseif (strpos($name_lower, 'cherry') !== false || strpos($name_lower, 'cam') !== false || strpos($name_lower, 'bơ') !== false || strpos($name_lower, 'sầu riêng') !== false || strpos($name_lower, 'bưởi') !== false) {
                    $tab_cat = 'trai-cay';
                }
                
                // Đảm bảo các sản phẩm mẫu nằm đúng mục Ăn Sạch - Sống Sạch
                if (in_array($name, $ansach_names)) {
                    $tab_cat = 'an-sach';
                }
                
                // Hiển thị các sản phẩm thuộc tab ĂN SẠCH - SỐNG SẠCH trước tiên, ẩn các sản phẩm khác
                $is_ansach = ($tab_cat == 'an-sach') ? 'true' : 'false';
                $display_style = ($is_ansach == 'true') ? 'display: flex;' : 'display: none;';
                ?>
                <div class="product-card" data-category="<?= $tab_cat ?>" data-ansach="<?= $is_ansach ?>" style="<?= $display_style ?> transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); opacity: 1;">
                    <div class="product-img-wrapper">
                        <a href="<?= $linksp ?>"><img class="product-img" src="<?= $hinh_path ?>" alt="<?= htmlspecialchars($name) ?>"></a>
                        <span class="product-tag" style="background-color: var(--primary-color);">Ăn sạch</span>
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
            echo '<p style="grid-column: 1/-1; text-align: center; color: var(--text-muted);">Không có sản phẩm nào mới.</p>';
        }
        ?>
    </div>

    <!-- KHU VỰC TRÁI CÂY TƯƠI NGON -->
    <div class="section-header" style="margin-top: 50px;">
        <h2 class="section-title">TRÁI CÂY TƯƠI NGON</h2>
        <div class="category-tabs" id="traicay-tabs">
            <span class="category-tab-item" data-target="nhap-khau">Nhập khẩu</span>
            <span class="category-tab-item" data-target="noi-dia">Nội địa</span>
            <span class="category-tab-item" data-target="cay-say">Trái cây sấy</span>
            <span class="category-tab-item" data-target="dong-lanh">Trái cây đông lạnh</span>
            <span class="category-tab-item active" data-target="all">Xem tất cả</span>
        </div>
    </div>

    <div class="trai-cay-layout" style="display: grid; grid-template-columns: 1fr 280px; gap: 25px; margin-bottom: 50px;">
        <!-- GRID SẢN PHẨM BÊN TRÁI -->
        <div class="product-grid" id="traicay-grid" style="grid-template-columns: repeat(4, 1fr);">
            <?php
            if (isset($sp_dicho) && is_array($sp_dicho) && count($sp_dicho) > 0) {
                // Lọc sản phẩm thuộc danh mục Trái Cây Tươi Ngon (id_danhmuc = 2)
                $sp_traicay = [];
                foreach ($sp_dicho as $sp) {
                    if ($sp['id_danhmuc'] == 2) {
                        $sp_traicay[] = $sp;
                    }
                }
                if (empty($sp_traicay)) {
                    $sp_traicay = array_slice($sp_dicho, 0, 4);
                }

                foreach ($sp_traicay as $sp) {
                    extract($sp);
                    $linksp = "index.php?act=chitiet&idsp=" . $id;
                    $hinh_path = get_product_image($img);
                    $gia_format = number_format($price, 0, ',', '.') . 'đ';
                    
                    // Phân loại danh mục cho phần Trái Cây
                    $tc_cat = 'noi-dia'; // mặc định
                    $name_lower = mb_strtolower($name, 'UTF-8');
                    
                    if (strpos($name_lower, 'cherry') !== false || strpos($name_lower, 'nhập khẩu') !== false || strpos($name_lower, 'mỹ') !== false) {
                        $tc_cat = 'nhap-khau';
                    } elseif (strpos($name_lower, 'sấy') !== false || strpos($name_lower, 'khô') !== false || strpos($name_lower, 'kẹo') !== false) {
                        $tc_cat = 'cay-say';
                    } elseif (strpos($name_lower, 'đông lạnh') !== false || strpos($name_lower, 'lạnh') !== false) {
                        $tc_cat = 'dong-lanh';
                    }
                    
                    $is_tc_default = 'true';
                    $display_style = 'display: flex;';
                    ?>
                    <div class="product-card" data-category="<?= $tc_cat ?>" data-default="<?= $is_tc_default ?>" style="<?= $display_style ?> transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); opacity: 1;">
                        <div class="product-img-wrapper">
                            <a href="<?= $linksp ?>"><img class="product-img" src="<?= $hinh_path ?>" alt="<?= htmlspecialchars($name) ?>"></a>
                            <?php if (strpos($name_lower, 'mật dừa nước cô đặc') !== false): ?>
                                <span class="product-tag" style="background-color: var(--secondary-color);">5 Sao</span>
                            <?php endif; ?>
                        </div>
                        <div class="product-info">
                            <span class="product-category">Trái cây & Đặc sản</span>
                            <a href="<?= $linksp ?>"><h3 class="product-name" style="font-size: 0.9rem; font-weight: 600; line-height: 1.3; height: 36px; overflow: hidden;"><?= htmlspecialchars($name) ?></h3></a>
                            <div class="product-rating" style="font-size: 0.75rem; color: #ffc107; margin-bottom: 5px;">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <span>(5.0)</span>
                            </div>
                            <div class="product-price-row">
                                <span class="product-price" style="color: var(--danger-color); font-weight: 700; font-size: 1.1rem;"><?= $gia_format ?></span>
                                <button class="add-to-cart-btn" onclick="window.location.href='index.php?act=addtocart&id=<?= $id ?>'">+</button>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

        <!-- BANNER BÊN PHẢI -->
        <div class="trai-cay-banner" style="border-radius: 16px; overflow: hidden; position: relative; box-shadow: var(--shadow-sm); transition: var(--transition);">
            <img src="uploads/orange_banner.png" alt="Cam Kiến Vàng" style="width: 100%; height: 100%; object-fit: cover; display: block;">
        </div>
    </div>
    <!-- KHU VỰC TRÀ – CÀ PHÊ – SÔCÔLA -->
    <div class="section-header" style="margin-top: 50px;">
        <h2 class="section-title">TRÀ – CÀ PHÊ – SÔCÔLA</h2>
        <div class="category-tabs" id="tea-tabs">
            <span class="category-tab-item" data-target="tea-nhap-khau">Nhập khẩu</span>
            <span class="category-tab-item" data-target="tea-noi-dia">Nội địa</span>
            <span class="category-tab-item" data-target="tea-cay-say">Trái cây sấy</span>
            <span class="category-tab-item" data-target="tea-dong-lanh">Trái cây đông lạnh</span>
            <span class="category-tab-item active" data-target="all">Xem tất cả</span>
        </div>
    </div>

    <div class="tea-layout" style="display: grid; grid-template-columns: 280px 1fr; gap: 25px; margin-bottom: 50px;">
        <!-- BANNER BÊN TRÁI -->
        <div class="tea-left-banners" style="display: flex; flex-direction: column; gap: 20px;">
            <div style="border-radius: 16px; overflow: hidden; box-shadow: var(--shadow-sm); flex: 1;">
                <img src="uploads/tea_banner1.png" alt="Tea Promo 1" style="width: 100%; height: 100%; object-fit: cover; display: block;">
            </div>
            <div style="border-radius: 16px; overflow: hidden; box-shadow: var(--shadow-sm); flex: 1;">
                <img src="uploads/tea_banner2.png" alt="Tea Promo 2" style="width: 100%; height: 100%; object-fit: cover; display: block;">
            </div>
        </div>

        <!-- GRID SẢN PHẨM BÊN PHẢI -->
        <div class="product-grid" id="tea-grid" style="grid-template-columns: repeat(4, 1fr);">
            <?php
            if (isset($sp_dicho) && is_array($sp_dicho) && count($sp_dicho) > 0) {
                // Lọc sản phẩm thuộc danh mục Trà - Cà phê (id_danhmuc = 4)
                $sp_tea = [];
                foreach ($sp_dicho as $sp) {
                    if ($sp['id_danhmuc'] == 4) {
                        $sp_tea[] = $sp;
                    }
                }
                if (empty($sp_tea)) {
                    $sp_tea = array_slice($sp_dicho, 0, 8);
                }

                foreach ($sp_tea as $sp) {
                    extract($sp);
                    $linksp = "index.php?act=chitiet&idsp=" . $id;
                    $hinh_path = get_product_image($img);
                    $gia_format = number_format($price, 0, ',', '.') . 'đ';
                    
                    // Phân loại danh mục cho phần Trà - Cà phê
                    $tea_cat = 'tea-noi-dia'; // mặc định
                    $name_lower = mb_strtolower($name, 'UTF-8');
                    
                    if (strpos($name_lower, 'cherry') !== false || strpos($name_lower, 'nhập khẩu') !== false || strpos($name_lower, 'mỹ') !== false) {
                        $tea_cat = 'tea-nhap-khau';
                    } elseif (strpos($name_lower, 'sấy') !== false || strpos($name_lower, 'khô') !== false || strpos($name_lower, 'kẹo') !== false) {
                        $tea_cat = 'tea-cay-say';
                    } elseif (strpos($name_lower, 'đông lạnh') !== false || strpos($name_lower, 'lạnh') !== false) {
                        $tea_cat = 'tea-dong-lanh';
                    }
                    
                    $is_tea_default = 'true';
                    $display_style = 'display: flex;';
                    ?>
                    <div class="product-card" data-category="<?= $tea_cat ?>" data-default="<?= $is_tea_default ?>" style="<?= $display_style ?> transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); opacity: 1;">
                        <div class="product-img-wrapper">
                            <a href="<?= $linksp ?>"><img class="product-img" src="<?= $hinh_path ?>" alt="<?= htmlspecialchars($name) ?>"></a>
                        </div>
                        <div class="product-info">
                            <span class="product-category">Trà & Nước Uống</span>
                            <a href="<?= $linksp ?>"><h3 class="product-name" style="font-size: 0.9rem; font-weight: 600; line-height: 1.3; height: 36px; overflow: hidden;"><?= htmlspecialchars($name) ?></h3></a>
                            <div class="product-rating" style="font-size: 0.75rem; color: #ffc107; margin-bottom: 5px;">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <span>(5.0)</span>
                            </div>
                            <div class="product-price-row">
                                <span class="product-price" style="color: var(--danger-color); font-weight: 700; font-size: 1.1rem;"><?= $gia_format ?></span>
                                <button class="add-to-cart-btn" onclick="window.location.href='index.php?act=addtocart&id=<?= $id ?>'">+</button>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>

    <!-- BANNER BỘ SƯU TẬP TRÀ NGANG -->
    <div class="tea-horizontal-banner" style="margin-bottom: 50px; border-radius: 16px; overflow: hidden; box-shadow: var(--shadow-sm); transition: var(--transition);">
        <img src="uploads/tea_horizontal.png" alt="Bộ sưu tập Trà" style="width: 100%; display: block; height: auto; max-height: 140px; object-fit: cover;">
    </div>

    <!-- KHU VỰC QUÀ TẶNG SỨC KHỎE -->
    <div class="section-header" style="margin-top: 50px;">
        <h2 class="section-title">QUÀ TẶNG SỨC KHOẺ</h2>
        <div class="category-tabs" id="gift-tabs">
            <span class="category-tab-item" data-target="gift-nhap-khau">Nhập khẩu</span>
            <span class="category-tab-item" data-target="gift-noi-dia">Nội địa</span>
            <span class="category-tab-item" data-target="gift-cay-say">Trái cây sấy</span>
            <span class="category-tab-item" data-target="gift-dong-lanh">Trái cây đông lạnh</span>
            <span class="category-tab-item active" data-target="all">Xem tất cả</span>
        </div>
    </div>

    <div class="gift-layout" style="display: grid; grid-template-columns: 1fr 280px; gap: 25px; margin-bottom: 50px;">
        <!-- GRID SẢN PHẨM BÊN TRÁI -->
        <div class="product-grid" id="gift-grid" style="grid-template-columns: repeat(4, 1fr);">
            <?php
            if (isset($sp_dicho) && is_array($sp_dicho) && count($sp_dicho) > 0) {
                // Lọc sản phẩm thuộc danh mục Đặc Sản/Quà Tặng (id_danhmuc = 5 hoặc 6)
                $sp_gift = [];
                foreach ($sp_dicho as $sp) {
                    if ($sp['id_danhmuc'] == 5 || $sp['id_danhmuc'] == 6) {
                        $sp_gift[] = $sp;
                    }
                }
                if (empty($sp_gift)) {
                    $sp_gift = array_slice($sp_dicho, 0, 4);
                }

                foreach ($sp_gift as $sp) {
                    extract($sp);
                    $linksp = "index.php?act=chitiet&idsp=" . $id;
                    $hinh_path = get_product_image($img);
                    $gia_format = number_format($price, 0, ',', '.') . 'đ';
                    
                    // Phân loại danh mục cho phần Quà tặng sức khỏe
                    $gift_cat = 'gift-noi-dia'; // mặc định
                    $name_lower = mb_strtolower($name, 'UTF-8');
                    
                    if (strpos($name_lower, 'saffron') !== false || strpos($name_lower, 'nhập khẩu') !== false || strpos($name_lower, 'yến') !== false) {
                        $gift_cat = 'gift-nhap-khau';
                    } elseif (strpos($name_lower, 'sấy') !== false || strpos($name_lower, 'khô') !== false) {
                        $gift_cat = 'gift-cay-say';
                    } elseif (strpos($name_lower, 'đông lạnh') !== false) {
                        $gift_cat = 'gift-dong-lanh';
                    }
                    
                    $is_gift_default = 'true';
                    $display_style = 'display: flex;';
                    ?>
                    <div class="product-card" data-category="<?= $gift_cat ?>" data-default="<?= $is_gift_default ?>" style="<?= $display_style ?> transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); opacity: 1;">
                        <div class="product-img-wrapper">
                            <a href="<?= $linksp ?>"><img class="product-img" src="<?= $hinh_path ?>" alt="<?= htmlspecialchars($name) ?>"></a>
                            <?php if (strpos($name_lower, 'mật dừa nước cô đặc') !== false): ?>
                                <span class="product-tag" style="background-color: var(--secondary-color);">5 Sao</span>
                            <?php endif; ?>
                        </div>
                        <div class="product-info">
                            <span class="product-category">Dinh Dưỡng Sức Khoẻ</span>
                            <a href="<?= $linksp ?>"><h3 class="product-name" style="font-size: 0.9rem; font-weight: 600; line-height: 1.3; height: 36px; overflow: hidden;"><?= htmlspecialchars($name) ?></h3></a>
                            <div class="product-rating" style="font-size: 0.75rem; color: #ffc107; margin-bottom: 5px;">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <span>(5.0)</span>
                            </div>
                            <div class="product-price-row">
                                <span class="product-price" style="color: var(--danger-color); font-weight: 700; font-size: 1.1rem;"><?= $gia_format ?></span>
                                <button class="add-to-cart-btn" onclick="window.location.href='index.php?act=addtocart&id=<?= $id ?>'">+</button>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

        <!-- BANNER BÊN PHẢI -->
        <div class="gift-banner" style="border-radius: 16px; overflow: hidden; position: relative; box-shadow: var(--shadow-sm); transition: var(--transition);">
            <img src="uploads/saffron_banner.png" alt="Saffron" style="width: 100%; height: 100%; object-fit: cover; display: block;">
        </div>
    </div>

    <!-- KHU VỰC SỐNG XANH -->
    <div class="section-header" style="margin-top: 50px;">
        <h2 class="section-title">SỐNG XANH</h2>
        <div class="category-tabs" id="songxanh-tabs">
            <span class="category-tab-item" data-target="sx-nhap-khau">Nhập khẩu</span>
            <span class="category-tab-item" data-target="sx-noi-dia">Nội địa</span>
            <span class="category-tab-item" data-target="sx-cay-say">Trái cây sấy</span>
            <span class="category-tab-item" data-target="sx-dong-lanh">Trái cây đông lạnh</span>
            <span class="category-tab-item active" data-target="all">Xem tất cả</span>
        </div>
    </div>

    <div class="song-xanh-layout">
        <!-- BANNER BÊN TRÁI -->
        <div class="song-xanh-banner">
            <img src="uploads/song_xanh_banner.png" alt="Sống Xanh" style="width: 100%; height: 100%; object-fit: cover; display: block;">
            <div class="banner-overlay" style="position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.4)); display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 25px; color: white;">
                <h3 style="font-size: 2.2rem; font-weight: 800; font-family: 'Outfit', sans-serif; text-shadow: 2px 2px 5px rgba(0,0,0,0.8); line-height: 1.2; text-align: center; margin: 0; text-transform: uppercase; color: #ffffff;">SỐNG XANH</h3>
            </div>
        </div>

        <!-- GRID SẢN PHẨM BÊN PHẢI -->
        <div class="product-grid" id="songxanh-grid" style="grid-template-columns: repeat(4, 1fr);">
            <?php
            if (isset($sp_dicho) && is_array($sp_dicho) && count($sp_dicho) > 0) {
                // Lọc sản phẩm thuộc danh mục Sống Xanh / Rau củ Đà Lạt (id_danhmuc = 3)
                $sp_songxanh = [];
                foreach ($sp_dicho as $sp) {
                    if ($sp['id_danhmuc'] == 3) {
                        $sp_songxanh[] = $sp;
                    }
                }
                if (empty($sp_songxanh)) {
                    $sp_songxanh = array_slice($sp_dicho, 0, 4);
                }
                // Giới hạn hiển thị 4 sản phẩm
                $sp_songxanh_display = array_slice($sp_songxanh, 0, 4);

                foreach ($sp_songxanh_display as $sp) {
                    extract($sp);
                    $linksp = "index.php?act=chitiet&idsp=" . $id;
                    $hinh_path = get_product_image($img);
                    $gia_format = number_format($price, 0, ',', '.') . 'đ';
                    
                    // Phân loại danh mục cho phần Sống Xanh
                    $sx_cat = 'sx-noi-dia'; // mặc định
                    $name_lower = mb_strtolower($name, 'UTF-8');
                    
                    if (strpos($name_lower, 'cherry') !== false || strpos($name_lower, 'nhập khẩu') !== false || strpos($name_lower, 'mỹ') !== false) {
                        $sx_cat = 'sx-nhap-khau';
                    } elseif (strpos($name_lower, 'sấy') !== false || strpos($name_lower, 'khô') !== false || strpos($name_lower, 'kẹo') !== false) {
                        $sx_cat = 'sx-cay-say';
                    } elseif (strpos($name_lower, 'đông lạnh') !== false || strpos($name_lower, 'lạnh') !== false) {
                        $sx_cat = 'sx-dong-lanh';
                    }
                    
                    $is_sx_default = 'true';
                    $display_style = 'display: flex;';
                    
                    // Custom name display to match screenshot perfectly
                    $display_name = htmlspecialchars($name);
                    if ($name == 'Mật Dừa Nước Tinh Chất - 300ml') {
                        $display_name = 'Mật Dừa Nước Tinh Chất – 300ml – Dừa Nước Ông Sáu';
                    } elseif ($name == 'Sầu riêng Ri6 - Tươi, Hái già (Hộp 500g)') {
                        $display_name = 'Sầu riêng Ri6 – Tươi, Hái già (Hộp 500g) – Sượng bao đổi trả';
                    } elseif ($name == 'Cherry Mỹ Tươi Ngon, Giòn Ngọt, Size 9') {
                        $display_name = '[HÀNG AIR] Cherry Mỹ Tươi Ngon, Giòn Ngọt, Size 9 – Kiến Vàng';
                    }
                    ?>
                    <div class="product-card song-xanh-card" data-category="<?= $sx_cat ?>" data-default="<?= $is_sx_default ?>" style="<?= $display_style ?> transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); opacity: 1;">
                        <div class="product-img-wrapper" style="padding-top: 100%;">
                            <a href="<?= $linksp ?>"><img class="product-img" src="<?= $hinh_path ?>" alt="<?= htmlspecialchars($name) ?>"></a>
                        </div>
                        <div class="product-info" style="text-align: center; justify-content: space-between; padding: 15px 10px;">
                            <a href="<?= $linksp ?>"><h3 class="product-name" style="font-size: 0.85rem; font-weight: 500; text-align: center; height: 50px; line-height: 1.4; color: #556677; margin-bottom: 10px;"><?= $display_name ?></h3></a>
                            
                            <?php if ($name == 'Mật Dừa Nước Cô Đặc - Dừa Nước Ông Sáu'): ?>
                                <div class="product-rating" style="justify-content: center; font-size: 0.85rem; color: #f97316; margin-bottom: 10px; margin-top: auto;">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                            <?php else: ?>
                                <div style="height: 20px; margin-bottom: 10px; margin-top: auto;"></div>
                            <?php endif; ?>
                            
                            <div class="product-price-row" style="justify-content: center;">
                                <span class="product-price" style="color: #e11d48; font-weight: 700; font-size: 1.25rem;"><?= $gia_format ?></span>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>

    <!-- KHU VỰC CHƯƠNG TRÌNH KHUYẾN MÃI -->
    <div style="margin-top: 50px; text-align: center; margin-bottom: 30px;">
        <h2 style="text-align: center; color: var(--primary-color); font-weight: 700; font-size: 1.5rem; text-transform: uppercase; margin: 0; padding-bottom: 8px;">
            CHƯƠNG TRÌNH KHUYẾN MÃI
        </h2>
    </div>

    <div class="news-grid-layout">
        <?php if (isset($listtintuc) && is_array($listtintuc) && count($listtintuc) > 0): ?>
            <?php foreach ($listtintuc as $tin): ?>
                <?php 
                extract($tin);
                $hinh_path = get_news_image($img);
                ?>
                <div class="news-card">
                    <div class="news-img-wrapper" style="position: relative; padding-top: 56.25%; overflow: hidden;">
                        <img src="<?= $hinh_path ?>" alt="<?= htmlspecialchars($title) ?>" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; transition: var(--transition);">
                        <!-- DATE BADGE -->
                        <div class="news-date-badge" style="position: absolute; top: 15px; left: 15px; background-color: #0d7f3f; color: #ffffff; width: 45px; height: 45px; border-radius: 50%; display: flex; flex-direction: column; align-items: center; justify-content: center; font-weight: 700; font-size: 0.75rem; line-height: 1.1; box-shadow: 0 2px 8px rgba(0,0,0,0.15); border: 2px solid #ffffff;">
                            <?php 
                            $date_parts = explode(" ", $date);
                            $day = isset($date_parts[0]) ? $date_parts[0] : "25";
                            $month = isset($date_parts[1]) ? $date_parts[1] : "Th7";
                            ?>
                            <span class="day" style="font-size: 0.95rem; font-weight: 800;"><?= $day ?></span>
                            <span class="month" style="font-size: 0.55rem; text-transform: uppercase;"><?= $month ?></span>
                        </div>
                    </div>
                    <div class="news-info" style="padding: 20px; display: flex; flex-direction: column; flex: 1;">
                        <h3 class="news-title" style="font-size: 1.05rem; font-weight: 700; line-height: 1.4; color: #2c3e50; margin-bottom: 12px; height: 58px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                            <?= htmlspecialchars($title) ?>
                        </h3>
                        <p class="news-desc" style="font-size: 0.85rem; color: #7f8c8d; line-height: 1.6; height: 80px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; margin-bottom: 0;">
                            <?= htmlspecialchars($mota) ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- KHU VỰC SẢN PHẨM XEM NHIỀU (HOT) -->
    <div class="section-header" style="margin-top: 50px;">
        <h2 class="section-title">SẢN PHẨM NỔI BẬT (XEM NHIỀU)</h2>
        <a href="index.php?act=sanpham" style="font-size: 0.9rem; color: var(--primary-color); font-weight: 600;">Xem tất cả <i class="fa-solid fa-chevron-right"></i></a>
    </div>

    <div class="product-grid">
        <?php
        if (isset($sp_top10) && is_array($sp_top10) && count($sp_top10) > 0) {
            foreach ($sp_top10 as $sp) {
                extract($sp);
                $linksp = "index.php?act=chitiet&idsp=" . $id;
                $hinh_path = get_product_image($img);
                $gia_format = number_format($price, 0, ',', '.') . 'đ';
                ?>
                <div class="product-card">
                    <div class="product-img-wrapper">
                        <a href="<?= $linksp ?>"><img class="product-img" src="<?= $hinh_path ?>" alt="<?= htmlspecialchars($name) ?>"></a>
                        <span class="product-tag" style="background-color: var(--danger-color);">Bán chạy</span>
                    </div>
                    <div class="product-info">
                        <span class="product-category">Xem nhiều: <?= $luotxem ?> lượt</span>
                        <a href="<?= $linksp ?>"><h3 class="product-name"><?= htmlspecialchars($name) ?></h3></a>
                        <div class="product-rating">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <span>(5.0)</span>
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
            echo '<p style="grid-column: 1/-1; text-align: center; color: var(--text-muted);">Không có sản phẩm nào nổi bật.</p>';
        }
        ?>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // 1. Bộ lọc cho khu vực ĐI CHỢ ONLINE
    const tabs1 = document.querySelectorAll("#dicho-tabs .category-tab-item");
    const cards1 = document.querySelectorAll(".di-cho-online-layout .product-card");

    tabs1.forEach(tab => {
        tab.addEventListener("click", function() {
            tabs1.forEach(t => t.classList.remove("active"));
            this.classList.add("active");

            const target = this.getAttribute("data-target");

            cards1.forEach(card => {
                card.style.opacity = "0";
                card.style.transform = "scale(0.95)";
                
                setTimeout(() => {
                    if (card.getAttribute("data-category") === target) {
                        card.style.display = "flex";
                        setTimeout(() => {
                            card.style.opacity = "1";
                            card.style.transform = "scale(1)";
                        }, 50);
                    } else {
                        card.style.display = "none";
                    }
                }, 150);
            });
        });
    });

    // 2. Bộ lọc cho khu vực custom tabs trang chủ
    const tabs2 = document.querySelectorAll("#homepage-custom-tabs .category-tab-item");
    const cards2 = document.querySelectorAll("#homepage-custom-grid .product-card");

    tabs2.forEach(tab => {
        tab.addEventListener("click", function() {
            tabs2.forEach(t => {
                t.classList.remove("active");
                t.style.backgroundColor = "";
                t.style.color = "";
                t.style.borderColor = "";
            });
            this.classList.add("active");
            this.style.backgroundColor = "var(--primary-color)";
            this.style.color = "white";
            this.style.borderColor = "var(--primary-color)";

            const target = this.getAttribute("data-target");

            cards2.forEach(card => {
                card.style.opacity = "0";
                card.style.transform = "scale(0.95)";
                
                setTimeout(() => {
                    if (card.getAttribute("data-category") === target) {
                        card.style.display = "flex";
                        setTimeout(() => {
                            card.style.opacity = "1";
                            card.style.transform = "scale(1)";
                        }, 50);
                    } else {
                        card.style.display = "none";
                    }
                }, 150);
            });
        });
    });

    // 3. Bộ lọc cho khu vực TRÁI CÂY TƯƠI NGON
    const tabs3 = document.querySelectorAll("#traicay-tabs .category-tab-item");
    const cards3 = document.querySelectorAll("#traicay-grid .product-card");

    tabs3.forEach(tab => {
        tab.addEventListener("click", function() {
            tabs3.forEach(t => t.classList.remove("active"));
            this.classList.add("active");

            const target = this.getAttribute("data-target");

            cards3.forEach(card => {
                card.style.opacity = "0";
                card.style.transform = "scale(0.95)";
                
                setTimeout(() => {
                    if (target === "all" && card.getAttribute("data-default") === "true") {
                        card.style.display = "flex";
                        setTimeout(() => {
                            card.style.opacity = "1";
                            card.style.transform = "scale(1)";
                        }, 50);
                    } else if (card.getAttribute("data-category") === target) {
                        card.style.display = "flex";
                        setTimeout(() => {
                            card.style.opacity = "1";
                            card.style.transform = "scale(1)";
                        }, 50);
                    } else {
                        card.style.display = "none";
                    }
                }, 150);
            });
        });
    });

    // 4. Bộ lọc cho khu vực SỐNG XANH
    const tabsSX = document.querySelectorAll("#songxanh-tabs .category-tab-item");
    const cardsSX = document.querySelectorAll("#songxanh-grid .product-card");

    tabsSX.forEach(tab => {
        tab.addEventListener("click", function() {
            tabsSX.forEach(t => t.classList.remove("active"));
            this.classList.add("active");

            const target = this.getAttribute("data-target");

            cardsSX.forEach(card => {
                card.style.opacity = "0";
                card.style.transform = "scale(0.95)";
                
                setTimeout(() => {
                    if (target === "all" && card.getAttribute("data-default") === "true") {
                        card.style.display = "flex";
                        setTimeout(() => {
                            card.style.opacity = "1";
                            card.style.transform = "scale(1)";
                        }, 50);
                    } else if (card.getAttribute("data-category") === target) {
                        card.style.display = "flex";
                        setTimeout(() => {
                            card.style.opacity = "1";
                            card.style.transform = "scale(1)";
                        }, 50);
                    } else {
                        card.style.display = "none";
                    }
                }, 150);
            });
        });
    });

    // 5. Bộ lọc cho khu vực TRÀ – CÀ PHÊ – SÔCÔLA
    const tabsTea = document.querySelectorAll("#tea-tabs .category-tab-item");
    const cardsTea = document.querySelectorAll("#tea-grid .product-card");

    tabsTea.forEach(tab => {
        tab.addEventListener("click", function() {
            tabsTea.forEach(t => t.classList.remove("active"));
            this.classList.add("active");

            const target = this.getAttribute("data-target");

            cardsTea.forEach(card => {
                card.style.opacity = "0";
                card.style.transform = "scale(0.95)";
                
                setTimeout(() => {
                    if (target === "all" && card.getAttribute("data-default") === "true") {
                        card.style.display = "flex";
                        setTimeout(() => {
                            card.style.opacity = "1";
                            card.style.transform = "scale(1)";
                        }, 50);
                    } else if (card.getAttribute("data-category") === target) {
                        card.style.display = "flex";
                        setTimeout(() => {
                            card.style.opacity = "1";
                            card.style.transform = "scale(1)";
                        }, 50);
                    } else {
                        card.style.display = "none";
                    }
                }, 150);
            });
        });
    });

    // 6. Bộ lọc cho khu vực QUÀ TẶNG SỨC KHỎE
    const tabsGift = document.querySelectorAll("#gift-tabs .category-tab-item");
    const cardsGift = document.querySelectorAll("#gift-grid .product-card");

    tabsGift.forEach(tab => {
        tab.addEventListener("click", function() {
            tabsGift.forEach(t => t.classList.remove("active"));
            this.classList.add("active");

            const target = this.getAttribute("data-target");

            cardsGift.forEach(card => {
                card.style.opacity = "0";
                card.style.transform = "scale(0.95)";
                
                setTimeout(() => {
                    if (target === "all" && card.getAttribute("data-default") === "true") {
                        card.style.display = "flex";
                        setTimeout(() => {
                            card.style.opacity = "1";
                            card.style.transform = "scale(1)";
                        }, 50);
                    } else if (card.getAttribute("data-category") === target) {
                        card.style.display = "flex";
                        setTimeout(() => {
                            card.style.opacity = "1";
                            card.style.transform = "scale(1)";
                        }, 50);
                    } else {
                        card.style.display = "none";
                    }
                }, 150);
            });
        });
    });
});
</script>

