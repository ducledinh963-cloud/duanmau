<div class="admin-container">
    <div class="admin-card">
        <div class="card-header">
            <h2 class="card-title"><i class="fa-solid fa-cart-flatbed-suitcases"></i> QUẢN LÝ ĐƠN HÀNG (BÁN HÀNG)</h2>
        </div>

        <!-- SEARCH FORM -->
        <div style="background-color: var(--light-color); padding: 15px; border-radius: 8px; border: 1px solid var(--border-color); margin-bottom: 20px;">
            <form action="index.php?act=listdonhang" method="POST" style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 250px;">
                    <input type="text" name="kyw" class="admin-form-control" placeholder="Tìm theo Mã đơn hàng, Tên khách hàng hoặc SĐT..." value="<?= isset($_POST['kyw']) ? htmlspecialchars($_POST['kyw']) : '' ?>" style="padding: 8px 12px; font-size: 0.9rem;">
                </div>
                <button type="submit" name="listok" class="btn btn-info" style="padding: 8px 20px; font-size: 0.9rem;"><i class="fa-solid fa-magnifying-glass"></i> Tìm kiếm</button>
                <a href="index.php?act=listdonhang" class="btn btn-danger" style="padding: 8px 20px; font-size: 0.9rem; background-color: #94a3b8;"><i class="fa-solid fa-rotate"></i> Reset</a>
            </form>
        </div>

        <?php
        if (isset($thongbao) && $thongbao != "") {
            echo '<div class="admin-alert admin-alert-success"><i class="fa-solid fa-circle-check"></i> ' . $thongbao . '</div>';
        }
        if (isset($error) && $error != "") {
            echo '<div class="admin-alert admin-alert-danger"><i class="fa-solid fa-triangle-exclamation"></i> ' . $error . '</div>';
        }
        ?>

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">Mã ĐH</th>
                        <th>Khách hàng</th>
                        <th>Thông tin giao nhận</th>
                        <th style="text-align: right;">Tổng giá trị</th>
                        <th style="text-align: center;">Thanh toán</th>
                        <th style="text-align: center;">Trạng thái</th>
                        <th>Ngày đặt hàng</th>
                        <th style="width: 180px; text-align: center;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($listdonhang) && is_array($listdonhang) && count($listdonhang) > 0) {
                        foreach ($listdonhang as $dh) {
                            extract($dh);
                            $chitiet = "index.php?act=chitietdonhang&id=" . $id;
                            $xoa = "index.php?act=xoadonhang&id=" . $id;
                            $total_formatted = number_format($total_amount, 0, ',', '.') . ' ₫';
                            $status_text = get_order_status_text($status);
                            ?>
                            <tr>
                                <td style="font-weight: 700; color: var(--primary-color);">DH-<?= $id ?></td>
                                <td>
                                    <div style="font-weight: 600; color: var(--dark-color);"><?= htmlspecialchars($buyer_name) ?></div>
                                    <div style="font-size: 0.85rem; color: #64748b;"><i class="fa-solid fa-envelope"></i> <?= htmlspecialchars($buyer_email) ?></div>
                                </td>
                                <td>
                                    <div style="font-weight: 500;"><i class="fa-solid fa-phone"></i> <?= htmlspecialchars($buyer_tel) ?></div>
                                    <div style="font-size: 0.85rem; color: #475569; max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="<?= htmlspecialchars($buyer_address) ?>">
                                        <i class="fa-solid fa-location-dot"></i> <?= htmlspecialchars($buyer_address) ?>
                                    </div>
                                </td>
                                <td style="text-align: right; font-weight: 700; color: #b91c1c;"><?= $total_formatted ?></td>
                                <td style="text-align: center; font-weight: 500; font-size: 0.9rem; color: #475569;"><?= htmlspecialchars($payment_method) ?></td>
                                <td style="text-align: center;"><?= $status_text ?></td>
                                <td style="font-size: 0.85rem; color: #64748b;"><?= htmlspecialchars($order_date) ?></td>
                                <td style="text-align: center;">
                                    <a href="<?= $chitiet ?>" class="btn btn-info btn-sm" style="margin-right: 5px;"><i class="fa-solid fa-eye"></i> Chi tiết</a>
                                    <a href="<?= $xoa ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng DH-<?= $id ?>? Thao tác này không thể hoàn tác!')"><i class="fa-solid fa-trash-can"></i> Xóa</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<tr><td colspan="8" style="text-align: center; color: #64748b; padding: 30px;">Không tìm thấy đơn hàng nào trong hệ thống.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
