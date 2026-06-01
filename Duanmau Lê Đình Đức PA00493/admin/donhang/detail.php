<?php
if (isset($dh) && is_array($dh)) {
    extract($dh);
    $total_formatted = number_format($total_amount, 0, ',', '.') . ' ₫';
} else {
    echo '<div class="admin-container"><div class="admin-alert admin-alert-danger">Đơn hàng không tồn tại hoặc đã bị xóa.</div></div>';
    return;
}
?>
<div class="admin-container">
    <!-- Back to List Link -->
    <div style="margin-bottom: 20px;">
        <a href="index.php?act=listdonhang" class="btn" style="background-color: #94a3b8; color: white; padding: 8px 16px; font-size: 0.9rem;"><i class="fa-solid fa-arrow-left"></i> Quay lại danh sách đơn hàng</a>
    </div>

    <?php
    if (isset($thongbao) && $thongbao != "") {
        echo '<div class="admin-alert admin-alert-success"><i class="fa-solid fa-circle-check"></i> ' . $thongbao . '</div>';
    }
    if (isset($error) && $error != "") {
        echo '<div class="admin-alert admin-alert-danger"><i class="fa-solid fa-triangle-exclamation"></i> ' . $error . '</div>';
    }
    ?>

    <div style="display: grid; grid-template-columns: 1fr 350px; gap: 30px; flex-wrap: wrap;">
        <!-- LEFT COLUMN: ORDER ITEMS -->
        <div>
            <div class="admin-card">
                <div class="card-header">
                    <h2 class="card-title"><i class="fa-solid fa-receipt"></i> SẢN PHẨM ĐÃ ĐẶT (ĐƠN HÀNG DH-<?= $id ?>)</h2>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th style="width: 60px; text-align: center;">STT</th>
                                <th>Tên sản phẩm</th>
                                <th style="text-align: right; width: 150px;">Đơn giá</th>
                                <th style="text-align: center; width: 100px;">Số lượng</th>
                                <th style="text-align: right; width: 150px;">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stt = 1;
                            if (isset($list_chitiet) && is_array($list_chitiet) && count($list_chitiet) > 0) {
                                foreach ($list_chitiet as $item) {
                                    extract($item);
                                    $subtotal = $price * $quantity;
                                    $price_formatted = number_format($price, 0, ',', '.') . ' ₫';
                                    $subtotal_formatted = number_format($subtotal, 0, ',', '.') . ' ₫';
                                    ?>
                                    <tr>
                                        <td style="text-align: center; color: #64748b;"><?= $stt++ ?></td>
                                        <td style="font-weight: 600; color: var(--dark-color);"><?= htmlspecialchars($product_name) ?></td>
                                        <td style="text-align: right; font-weight: 500;"><?= $price_formatted ?></td>
                                        <td style="text-align: center; font-weight: 600;"><?= $quantity ?></td>
                                        <td style="text-align: right; font-weight: 700; color: #b91c1c;"><?= $subtotal_formatted ?></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo '<tr><td colspan="5" style="text-align: center; color: #64748b; padding: 20px;">Không có chi tiết sản phẩm nào.</td></tr>';
                            }
                            ?>
                            <!-- TOTAL AMOUNT ROW -->
                            <tr style="background-color: #f8fafc; font-weight: 700; border-top: 2px solid var(--border-color);">
                                <td colspan="4" style="text-align: right; font-size: 1.05rem; padding: 16px;">TỔNG TIỀN ĐƠN HÀNG:</td>
                                <td style="text-align: right; font-size: 1.15rem; color: #b91c1c; padding: 16px;"><?= $total_formatted ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: CUSTOMER INFO & STATUS UPDATE -->
        <div>
            <!-- CUSTOMER INFO CARD -->
            <div class="admin-card" style="padding: 20px;">
                <div class="card-header" style="margin-bottom: 15px; padding-bottom: 10px;">
                    <h3 class="card-title" style="font-size: 1.05rem;"><i class="fa-solid fa-user"></i> THÔNG TIN KHÁCH HÀNG</h3>
                </div>
                <div style="font-size: 0.95rem; line-height: 1.7; color: var(--text-color);">
                    <div style="margin-bottom: 10px;">
                        <span style="font-weight: 600; color: #64748b;">Họ tên:</span>
                        <div style="font-weight: 700; color: var(--dark-color); font-size: 1.05rem;"><?= htmlspecialchars($buyer_name) ?></div>
                    </div>
                    <div style="margin-bottom: 10px;">
                        <span style="font-weight: 600; color: #64748b;">Số điện thoại:</span>
                        <div style="font-weight: 600; color: var(--dark-color);"><?= htmlspecialchars($buyer_tel) ?></div>
                    </div>
                    <div style="margin-bottom: 10px;">
                        <span style="font-weight: 600; color: #64748b;">Email:</span>
                        <div><?= htmlspecialchars($buyer_email) ?></div>
                    </div>
                    <div style="margin-bottom: 10px;">
                        <span style="font-weight: 600; color: #64748b;">Địa chỉ giao hàng:</span>
                        <div style="background-color: #f8fafc; padding: 10px; border-radius: 6px; border: 1px solid var(--border-color); font-size: 0.9rem; margin-top: 4px; word-wrap: break-word;">
                            <?= htmlspecialchars($buyer_address) ?>
                        </div>
                    </div>
                    <div style="margin-bottom: 10px;">
                        <span style="font-weight: 600; color: #64748b;">Ngày đặt hàng:</span>
                        <div><?= htmlspecialchars($order_date) ?></div>
                    </div>
                    <div>
                        <span style="font-weight: 600; color: #64748b;">Hình thức thanh toán:</span>
                        <div style="font-weight: 600; color: var(--primary-hover);"><i class="fa-solid fa-money-bill-1-wave"></i> Thanh toán khi nhận hàng (<?= htmlspecialchars($payment_method) ?>)</div>
                    </div>
                </div>
            </div>

            <!-- STATUS UPDATE CARD -->
            <div class="admin-card" style="padding: 20px;">
                <div class="card-header" style="margin-bottom: 15px; padding-bottom: 10px;">
                    <h3 class="card-title" style="font-size: 1.05rem;"><i class="fa-solid fa-truck-ramp-box"></i> TRẠNG THÁI ĐƠN HÀNG</h3>
                </div>
                
                <div style="margin-bottom: 15px;">
                    <span style="font-weight: 600; color: #64748b; display: block; margin-bottom: 8px;">Trạng thái hiện tại:</span>
                    <div>
                        <?php
                        switch ($status) {
                            case 0:
                                echo '<span class="status-badge" style="background-color: #fef3c7; color: #d97706; padding: 6px 12px; border-radius: 9999px; font-size: 0.9rem; font-weight: 700; display: inline-block;">Chờ xác nhận</span>';
                                break;
                            case 1:
                                echo '<span class="status-badge" style="background-color: #e0f2fe; color: #0284c7; padding: 6px 12px; border-radius: 9999px; font-size: 0.9rem; font-weight: 700; display: inline-block;">Đang giao hàng</span>';
                                break;
                            case 2:
                                echo '<span class="status-badge" style="background-color: #dcfce7; color: #16a34a; padding: 6px 12px; border-radius: 9999px; font-size: 0.9rem; font-weight: 700; display: inline-block;">Đã hoàn thành</span>';
                                break;
                            case 3:
                                echo '<span class="status-badge" style="background-color: #fee2e2; color: #dc2626; padding: 6px 12px; border-radius: 9999px; font-size: 0.9rem; font-weight: 700; display: inline-block;">Đã hủy</span>';
                                break;
                        }
                        ?>
                    </div>
                </div>

                <form action="index.php?act=updatedonhang" method="POST">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="admin-form-group" style="margin-bottom: 15px;">
                        <label for="status" style="font-weight: 600; color: #64748b;">Thay đổi trạng thái:</label>
                        <select name="status" id="status" class="admin-form-control" style="padding: 10px; font-size: 0.9rem;">
                            <option value="0" <?= ($status == 0) ? 'selected' : '' ?>>Chờ xác nhận</option>
                            <option value="1" <?= ($status == 1) ? 'selected' : '' ?>>Đang giao hàng</option>
                            <option value="2" <?= ($status == 2) ? 'selected' : '' ?>>Đã hoàn thành</option>
                            <option value="3" <?= ($status == 3) ? 'selected' : '' ?>>Đã hủy</option>
                        </select>
                    </div>
                    <button type="submit" name="capnhat" class="btn btn-primary" style="width: 100%; font-size: 0.95rem; padding: 10px;"><i class="fa-solid fa-floppy-disk"></i> Lưu thay đổi</button>
                </form>
            </div>
        </div>
    </div>
</div>
