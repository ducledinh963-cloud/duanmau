<?php
if (isset($onesp) && is_array($onesp)) {
    extract($onesp);
    $hinh_path = get_product_image($img);
    $gia_format = number_format($price, 0, ',', '.') . 'đ';
} else {
    echo "<div class='container'><p>Sản phẩm không tồn tại hoặc đã bị xóa.</p></div>";
    return;
}
?>
<div class="container">
    <!-- PRODUCT DETAIL BOX -->
    <div class="detail-container">
        <!-- LEFT: IMAGE -->
        <div class="detail-img-box">
            <img src="<?= $hinh_path ?>" alt="<?= htmlspecialchars($name) ?>">
        </div>

        <!-- RIGHT: DETAIL INFO -->
        <div class="detail-info-box">
            <h2 class="detail-title"><?= htmlspecialchars($name) ?></h2>
            
            <div class="detail-meta">
                <span>Danh mục: <strong style="color: var(--primary-color);"><?= htmlspecialchars($name_danhmuc) ?></strong></span>
                <span>|</span>
                <span>Lượt xem: <strong><?= $luotxem ?></strong></span>
                <span>|</span>
                <span>Đánh giá: <i class="fa-solid fa-star" style="color:#ffc107;"></i> <strong>5.0</strong></span>
            </div>

            <div class="detail-price"><?= $gia_format ?></div>

            <div class="detail-desc">
                <h3>Mô tả sản phẩm:</h3>
                <p><?= !empty($mota) ? nl2br(htmlspecialchars($mota)) : 'Sản phẩm tươi sạch chất lượng cao từ foodmap.asia. Đảm bảo nguồn gốc rõ ràng, đạt các chứng nhận an toàn thực phẩm. Thích hợp cho gia đình sử dụng hàng ngày hoặc làm quà tặng đặc sản vùng miền.' ?></p>
            </div>

            <!-- ACTION FORM -->
            <form action="index.php?act=addtocart" method="POST">
                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="hidden" name="name" value="<?= htmlspecialchars($name) ?>">
                <input type="hidden" name="price" value="<?= $price ?>">
                <input type="hidden" name="img" value="<?= htmlspecialchars($img) ?>">
                
                <div class="detail-action-row" style="display: flex; gap: 15px; align-items: center; margin-bottom: 20px;">
                    <div class="quantity-selector" style="display: flex; align-items: center;">
                        <button type="button" class="quantity-btn" onclick="let input = document.getElementById('qty'); if(input.value > 1) input.value--">-</button>
                        <input type="text" name="qty" id="qty" class="quantity-input" value="1" readonly style="width: 40px; text-align: center; border: none; font-weight: 600;">
                        <button type="button" class="quantity-btn" onclick="let input = document.getElementById('qty'); input.value++">+</button>
                    </div>

                    <button type="submit" name="addtocart" class="buy-now-btn" style="flex: 1; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px;">
                        <i class="fa-solid fa-cart-plus"></i> THÊM VÀO GIỎ HÀNG
                    </button>
                </div>
            </form>
            
            <div style="background-color: #f8fafc; padding: 15px; border-radius: 8px; border: 1px solid var(--border-color); font-size: 0.85rem;">
                <p><strong style="color: var(--primary-color);"><i class="fa-solid fa-truck-fast"></i> Cam kết từ Foodmap:</strong></p>
                <ul style="list-style: none; margin-top: 5px; display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
                    <li><i class="fa-solid fa-circle-check" style="color: var(--success-color);"></i> 100% nông sản sạch</li>
                    <li><i class="fa-solid fa-circle-check" style="color: var(--success-color);"></i> Đổi trả dễ dàng</li>
                    <li><i class="fa-solid fa-circle-check" style="color: var(--success-color);"></i> Giao nhanh trong 24h</li>
                    <li><i class="fa-solid fa-circle-check" style="color: var(--success-color);"></i> Đảm bảo nguồn gốc</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- COMMENTS SECTION (BÌNH LUẬN) -->
    <div class="comments-section" style="margin-top: 50px; background: #ffffff; padding: 30px; border-radius: 16px; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
        <h3 style="font-size: 1.3rem; font-weight: 700; color: var(--primary-color); margin-bottom: 20px; border-bottom: 2px solid var(--border-color); padding-bottom: 10px; display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-comments"></i> KHÁCH HÀNG BÌNH LUẬN (<?= isset($listbinhluan) ? count($listbinhluan) : 0 ?>)
        </h3>

        <!-- Comment List -->
        <div class="comment-list" style="max-height: 400px; overflow-y: auto; margin-bottom: 30px; padding-right: 5px;">
            <?php if (isset($listbinhluan) && is_array($listbinhluan) && count($listbinhluan) > 0): ?>
                <?php foreach ($listbinhluan as $bl): ?>
                    <div class="comment-item" style="padding: 15px; border-radius: 12px; background-color: #f8fafc; border: 1px solid var(--border-color); margin-bottom: 12px; transition: var(--transition);">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                            <span style="font-weight: 600; color: var(--primary-color); font-size: 0.95rem;">
                                <i class="fa-solid fa-circle-user"></i> <?= htmlspecialchars($bl['user_name']) ?>
                            </span>
                            <span style="font-size: 0.75rem; color: var(--text-muted);">
                                <i class="fa-solid fa-clock"></i> <?= htmlspecialchars($bl['ngaybinhluan']) ?>
                            </span>
                        </div>
                        <p style="font-size: 0.9rem; color: var(--text-color); margin: 0; line-height: 1.5;"><?= nl2br(htmlspecialchars($bl['noidung'])) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="text-align: center; padding: 30px; color: var(--text-muted);">
                    <i class="fa-regular fa-message" style="font-size: 2.5rem; margin-bottom: 10px; display: block; opacity: 0.5;"></i>
                    Chưa có bình luận nào cho sản phẩm này. Hãy là người đầu tiên chia sẻ cảm nghĩ!
                </div>
            <?php endif; ?>
        </div>

        <!-- Add Comment Form -->
        <div class="comment-form-container" style="border-top: 1px dashed var(--border-color); padding-top: 20px;">
            <?php if (isset($_SESSION['user'])): ?>
                <form action="index.php?act=chitiet&idsp=<?= $id ?>" method="POST">
                    <div style="margin-bottom: 15px;">
                        <label for="comment_content" style="display: block; font-weight: 600; font-size: 0.9rem; margin-bottom: 8px; color: var(--text-color);">
                            Viết bình luận của bạn:
                        </label>
                        <textarea name="noidung" id="comment_content" required placeholder="Nhập ý kiến, nhận xét hoặc thắc mắc của bạn tại đây..." style="width: 100%; min-height: 100px; padding: 12px 15px; border-radius: 8px; border: 1px solid var(--border-color); outline: none; font-size: 0.95rem; resize: vertical; transition: var(--transition);"></textarea>
                    </div>
                    <button type="submit" name="guibinhluan" class="form-btn" style="width: auto; padding: 10px 25px; border: none; cursor: pointer; display: flex; align-items: center; gap: 8px; background-color: var(--primary-color); color: white; border-radius: 8px; font-weight: 600; transition: var(--transition);">
                        <i class="fa-solid fa-paper-plane"></i> Gửi bình luận
                    </button>
                </form>
            <?php else: ?>
                <div style="background-color: #fef3c7; border: 1px solid #fde68a; border-radius: 8px; padding: 15px; text-align: center; font-size: 0.9rem; color: #92400e;">
                    <i class="fa-solid fa-circle-exclamation"></i> Vui lòng <a href="index.php?act=dangnhap" style="text-decoration: underline; font-weight: 600; color: var(--primary-color);">Đăng nhập</a> để viết bình luận của bạn.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- RELATED PRODUCTS -->
    <div class="section-header" style="margin-top: 60px;">
        <h2 class="section-title">SẢN PHẨM CÙNG LOẠI</h2>
    </div>

    <div class="product-grid">
        <?php
        if (isset($sp_cung_loai) && is_array($sp_cung_loai) && count($sp_cung_loai) > 0) {
            foreach ($sp_cung_loai as $sp) {
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
                            <button class="add-to-cart-btn" onclick="alert('Đã thêm <?= htmlspecialchars($name) ?> vào giỏ hàng!')">+</button>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<p style="grid-column: 1/-1; text-align: center; color: var(--text-muted);">Không có sản phẩm nào khác cùng danh mục.</p>';
        }
        ?>
    </div>
</div>
