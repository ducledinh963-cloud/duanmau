<div class="container" style="margin-top: 30px; margin-bottom: 50px;">
    <!-- BREADCRUMBS -->
    <div style="font-size: 0.85rem; color: #64748b; margin-bottom: 20px;">
        <a href="index.php" style="color: inherit;">TRANG CHỦ</a> / <span style="color: var(--primary-color); font-weight: 600;">GIỎ HÀNG</span>
    </div>

    <h2 style="font-size: 1.8rem; font-weight: 700; color: #0f172a; margin-bottom: 30px; border-left: 4px solid var(--primary-color); padding-left: 12px; line-height: 1;">
        GIỎ HÀNG CỦA BẠN
    </h2>

    <?php
    if (isset($thongbao) && $thongbao != "") {
        echo '<div style="background-color: #d1fae5; color: #065f46; padding: 15px 20px; border-radius: 8px; font-weight: 600; margin-bottom: 30px; display: flex; align-items: center; gap: 10px; border: 1px solid #a7f3d0;">
                <i class="fa-solid fa-circle-check" style="font-size: 1.2rem;"></i> ' . $thongbao . '
              </div>';
    }
    ?>

    <?php if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px; align-items: start;">
            <!-- LEFT: PRODUCTS TABLE -->
            <div style="background: white; border-radius: 12px; border: 1px solid var(--border-color); padding: 20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #e2e8f0; padding-bottom: 10px;">
                    <h3 style="font-size: 1.1rem; font-weight: 600; color: #334155;">Danh sách sản phẩm</h3>
                    <a href="index.php?act=delcart" style="color: #ef4444; font-size: 0.85rem; font-weight: 600; display: flex; align-items: center; gap: 4px; text-decoration: none;" onclick="return confirm('Xóa sạch giỏ hàng của bạn?')">
                        <i class="fa-regular fa-trash-can"></i> Xóa sạch giỏ hàng
                    </a>
                </div>

                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left;">
                        <thead>
                            <tr style="border-bottom: 2px solid #f1f5f9;">
                                <th style="padding: 12px; font-weight: 600; color: #475569; font-size: 0.9rem; width: 80px;">Hình ảnh</th>
                                <th style="padding: 12px; font-weight: 600; color: #475569; font-size: 0.9rem;">Sản phẩm</th>
                                <th style="padding: 12px; font-weight: 600; color: #475569; font-size: 0.9rem; text-align: right; width: 100px;">Đơn giá</th>
                                <th style="padding: 12px; font-weight: 600; color: #475569; font-size: 0.9rem; text-align: center; width: 80px;">SL</th>
                                <th style="padding: 12px; font-weight: 600; color: #475569; font-size: 0.9rem; text-align: right; width: 120px;">Thành tiền</th>
                                <th style="padding: 12px; font-weight: 600; color: #475569; font-size: 0.9rem; text-align: center; width: 50px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            foreach ($_SESSION['cart'] as $item):
                                $hinh_path = get_product_image($item['img']);
                                $subtotal = $item['price'] * $item['qty'];
                                $total += $subtotal;
                                ?>
                                <tr style="border-bottom: 1px solid #f1f5f9; vertical-align: middle;">
                                    <td style="padding: 12px;">
                                        <img src="<?= $hinh_path ?>" alt="<?= htmlspecialchars($item['name']) ?>" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0;">
                                    </td>
                                    <td style="padding: 12px;">
                                        <a href="index.php?act=chitiet&idsp=<?= $item['id'] ?>" style="font-weight: 600; color: #1e293b; font-size: 0.95rem; text-decoration: none; display: block; max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            <?= htmlspecialchars($item['name']) ?>
                                        </a>
                                        <span style="font-size: 0.75rem; color: #94a3b8; display: block; margin-top: 4px;">Nông sản sạch</span>
                                    </td>
                                    <td style="padding: 12px; text-align: right; font-weight: 500; color: #475569; font-size: 0.9rem;">
                                        <?= number_format($item['price'], 0, ',', '.') ?>đ
                                    </td>
                                    <td style="padding: 12px; text-align: center; font-weight: 600; color: #0f172a; font-size: 0.95rem;">
                                        <?= $item['qty'] ?>
                                    </td>
                                    <td style="padding: 12px; text-align: right; font-weight: 700; color: var(--primary-color); font-size: 0.95rem;">
                                        <?= number_format($subtotal, 0, ',', '.') ?>đ
                                    </td>
                                    <td style="padding: 12px; text-align: center;">
                                        <a href="index.php?act=delcart&id=<?= $item['id'] ?>" style="color: #94a3b8; font-size: 1.1rem; transition: color 0.2s; text-decoration: none;" title="Xóa" onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color='#94a3b8'">
                                            <i class="fa-solid fa-xmark"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 25px; padding-top: 15px; border-top: 2px solid #f1f5f9;">
                    <a href="index.php" style="color: var(--primary-color); font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 6px; text-decoration: none;">
                        <i class="fa-solid fa-arrow-left-long"></i> Tiếp tục mua hàng
                    </a>
                    <div style="text-align: right;">
                        <span style="font-size: 0.9rem; color: #64748b;">Tổng tiền thanh toán:</span>
                        <h4 style="font-size: 1.6rem; font-weight: 800; color: var(--primary-color); margin-top: 4px;">
                            <?= number_format($total, 0, ',', '.') ?>đ
                        </h4>
                    </div>
                </div>
            </div>

            <!-- RIGHT: CHECKOUT FORM -->
            <div style="background: white; border-radius: 12px; border: 1px solid var(--border-color); padding: 25px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
                <h3 style="font-size: 1.15rem; font-weight: 700; color: #0f172a; margin-bottom: 20px; border-bottom: 1px solid #e2e8f0; padding-bottom: 10px;">
                    THÔNG TIN GIAO HÀNG
                </h3>
                
                <form action="index.php?act=checkout" method="POST">
                    <div style="margin-bottom: 15px;">
                        <label for="buyer_name" style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Họ và tên người nhận *</label>
                        <input type="text" name="buyer_name" id="buyer_name" required placeholder="Nhập họ và tên" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; outline: none; font-size: 0.9rem; font-family: inherit;" value="<?= isset($_SESSION['user']['user']) ? htmlspecialchars($_SESSION['user']['user']) : '' ?>">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label for="buyer_tel" style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Số điện thoại *</label>
                        <input type="tel" name="buyer_tel" id="buyer_tel" required placeholder="Nhập số điện thoại" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; outline: none; font-size: 0.9rem; font-family: inherit;" value="<?= isset($_SESSION['user']['tel']) ? htmlspecialchars($_SESSION['user']['tel']) : '' ?>">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label for="buyer_address" style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Địa chỉ nhận hàng *</label>
                        <input type="text" name="buyer_address" id="buyer_address" required placeholder="Nhập địa chỉ giao hàng chi tiết" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; outline: none; font-size: 0.9rem; font-family: inherit;" value="<?= isset($_SESSION['user']['address']) ? htmlspecialchars($_SESSION['user']['address']) : '' ?>">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label for="buyer_email" style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 6px;">Địa chỉ Email</label>
                        <input type="email" name="buyer_email" id="buyer_email" placeholder="Nhập email liên hệ (nếu có)" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; outline: none; font-size: 0.9rem; font-family: inherit;" value="<?= isset($_SESSION['user']['email']) ? htmlspecialchars($_SESSION['user']['email']) : '' ?>">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 10px;">Phương thức thanh toán *</label>
                        <div style="display: flex; flex-direction: column; gap: 10px;">
                            <label style="display: flex; align-items: center; gap: 10px; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; cursor: pointer; font-size: 0.9rem;">
                                <input type="radio" name="payment_method" value="COD" checked>
                                <span><i class="fa-solid fa-truck" style="color: #64748b; margin-right: 5px;"></i> Thanh toán khi nhận hàng (COD)</span>
                            </label>
                            <label style="display: flex; align-items: center; gap: 10px; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; cursor: pointer; font-size: 0.9rem;">
                                <input type="radio" name="payment_method" value="VNPAY">
                                <span><i class="fa-solid fa-credit-card" style="color: #0284c7; margin-right: 5px;"></i> Thanh toán qua cổng VNPay</span>
                            </label>
                        </div>
                    </div>

                    <button type="submit" name="checkout" style="width: 100%; background-color: var(--primary-color); color: white; border: none; padding: 14px; font-weight: 700; font-size: 1rem; border-radius: 8px; cursor: pointer; transition: background-color 0.2s; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 6px -1px rgba(22,163,74,0.2);">
                        <i class="fa-solid fa-credit-card"></i> XÁC NHẬN ĐẶT HÀNG
                    </button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div style="text-align: center; padding: 80px 20px; background: white; border-radius: 12px; border: 1px solid var(--border-color); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
            <i class="fa-solid fa-basket-shopping" style="font-size: 4rem; color: #cbd5e1; margin-bottom: 20px; display: block;"></i>
            <p style="color: #64748b; font-size: 1.1rem; margin-bottom: 25px;">Giỏ hàng của bạn đang trống.</p>
            <a href="index.php" style="background-color: var(--primary-color); color: white; text-decoration: none; padding: 12px 25px; border-radius: 8px; font-weight: 700; font-size: 0.95rem; display: inline-block;">
                MUA SẮM NGAY
            </a>
        </div>
    <?php endif; ?>
</div>
