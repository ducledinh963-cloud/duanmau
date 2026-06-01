<div class="admin-container">
    <div class="admin-card">
        <div class="card-header">
            <h2 class="card-title"><i class="fa-solid fa-users-gear"></i> QUẢN LÝ TÀI KHOẢN KHÁCH HÀNG</h2>
        </div>

        <!-- SEARCH FORM -->
        <div style="background-color: var(--light-color); padding: 15px; border-radius: 8px; border: 1px solid var(--border-color); margin-bottom: 20px;">
            <form action="index.php?act=listtaikhoan" method="POST" style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 250px;">
                    <input type="text" name="kyw" class="admin-form-control" placeholder="Tìm theo Tên đăng nhập, Email hoặc Số điện thoại..." value="<?= isset($_POST['kyw']) ? htmlspecialchars($_POST['kyw']) : '' ?>" style="padding: 8px 12px; font-size: 0.9rem;">
                </div>
                <button type="submit" name="listok" class="btn btn-info" style="padding: 8px 20px; font-size: 0.9rem;"><i class="fa-solid fa-magnifying-glass"></i> Tìm kiếm</button>
                <a href="index.php?act=listtaikhoan" class="btn btn-danger" style="padding: 8px 20px; font-size: 0.9rem; background-color: #94a3b8;"><i class="fa-solid fa-rotate"></i> Reset</a>
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
                        <th style="width: 80px;">Mã KH</th>
                        <th>Tên đăng nhập</th>
                        <th>Mật khẩu</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ giao nhận</th>
                        <th style="text-align: center; width: 150px;">Vai trò</th>
                        <th style="width: 100px; text-align: center;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($listtaikhoan) && is_array($listtaikhoan) && count($listtaikhoan) > 0) {
                        foreach ($listtaikhoan as $tk) {
                            extract($tk);
                            $xoa = "index.php?act=xoataikhoan&id=" . $id;
                            
                            // Xác định vai trò
                            if ($role == 1) {
                                $role_badge = '<span style="background-color: #dcfce7; color: #16a34a; padding: 4px 10px; border-radius: 9999px; font-size: 0.8rem; font-weight: 700; border: 1px solid #bbf7d0;"><i class="fa-solid fa-user-shield"></i> Quản trị</span>';
                            } else {
                                $role_badge = '<span style="background-color: #f1f5f9; color: #475569; padding: 4px 10px; border-radius: 9999px; font-size: 0.8rem; font-weight: 600; border: 1px solid #e2e8f0;"><i class="fa-solid fa-user"></i> Khách hàng</span>';
                            }
                            ?>
                            <tr>
                                <td style="font-weight: 700; color: var(--primary-color);">KH-<?= $id ?></td>
                                <td style="font-weight: 700; color: var(--dark-color);"><?= htmlspecialchars($user) ?></td>
                                <td style="font-family: monospace; color: #64748b; font-size: 0.9rem;"><?= htmlspecialchars($pass) ?></td>
                                <td><?= htmlspecialchars($email) ?></td>
                                <td style="font-weight: 500;"><?= $tel ? htmlspecialchars($tel) : '<span style="color:#cbd5e1; font-style:italic;">Chưa cập nhật</span>' ?></td>
                                <td>
                                    <div style="font-size: 0.85rem; color: #475569; max-width: 280px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="<?= htmlspecialchars($address) ?>">
                                        <?= $address ? htmlspecialchars($address) : '<span style="color:#cbd5e1; font-style:italic;">Chưa cập nhật</span>' ?>
                                    </div>
                                </td>
                                <td style="text-align: center;"><?= $role_badge ?></td>
                                <td style="text-align: center;">
                                    <?php if ($id != $_SESSION['user']['id']): ?>
                                        <a href="<?= $xoa ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản của <?= htmlspecialchars($user) ?>? Hành động này sẽ xóa tất cả bình luận liên quan!')"><i class="fa-solid fa-trash-can"></i> Xóa</a>
                                    <?php else: ?>
                                        <span style="color: #cbd5e1; font-size: 0.85rem; font-style: italic;">Đang đăng nhập</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<tr><td colspan="8" style="text-align: center; color: #64748b; padding: 30px;">Không tìm thấy tài khoản nào.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
