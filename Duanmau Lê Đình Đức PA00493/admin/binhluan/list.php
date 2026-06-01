<div class="admin-container">
    <div class="admin-card">
        <div class="card-header">
            <h2 class="card-title"><i class="fa-solid fa-comments"></i> QUẢN LÝ BÌNH LUẬN CỦA KHÁCH HÀNG</h2>
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
                        <th style="width: 80px;">Mã BL</th>
                        <th>Nội dung bình luận</th>
                        <th>Người bình luận</th>
                        <th>Sản phẩm bình luận</th>
                        <th style="width: 180px; text-align: center;">Ngày bình luận</th>
                        <th style="width: 100px; text-align: center;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($listbinhluan) && is_array($listbinhluan) && count($listbinhluan) > 0) {
                        foreach ($listbinhluan as $bl) {
                            extract($bl);
                            $xoa = "index.php?act=xoabinhluan&id=" . $id;
                            ?>
                            <tr>
                                <td style="font-weight: 700; color: var(--primary-color);">BL-<?= $id ?></td>
                                <td style="color: var(--dark-color); font-weight: 500;"><?= htmlspecialchars($noidung) ?></td>
                                <td style="font-weight: 700; color: #475569;"><?= htmlspecialchars($user_name) ?></td>
                                <td style="font-weight: 600; color: #0284c7; max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="<?= htmlspecialchars($product_name) ?>">
                                    <?= htmlspecialchars($product_name) ?>
                                </td>
                                <td style="text-align: center; color: #64748b; font-size: 0.9rem;"><?= htmlspecialchars($ngaybinhluan) ?></td>
                                <td style="text-align: center;">
                                    <a href="<?= $xoa ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận này không?')"><i class="fa-solid fa-trash-can"></i> Xóa</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<tr><td colspan="6" style="text-align: center; color: #64748b; padding: 30px;">Chưa có bình luận nào trên hệ thống.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
