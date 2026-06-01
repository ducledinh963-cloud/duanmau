<div class="admin-container">
    <div class="admin-card">
        <div class="card-header">
            <h2 class="card-title"><i class="fa-solid fa-newspaper"></i> DANH SÁCH BÀI VIẾT / TIN TỨC</h2>
            <a href="index.php?act=addtintuc" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Thêm bài viết mới</a>
        </div>

        <!-- SEARCH FORM -->
        <div style="background-color: var(--light-color); padding: 15px; border-radius: 8px; border: 1px solid var(--border-color); margin-bottom: 20px;">
            <form action="index.php?act=listtintuc" method="POST" style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 200px;">
                    <input type="text" name="kyw" class="admin-form-control" placeholder="Tìm bài viết theo tiêu đề hoặc nội dung..." value="<?= isset($_POST['kyw']) ? htmlspecialchars($_POST['kyw']) : '' ?>" style="padding: 8px 12px; font-size: 0.9rem;">
                </div>
                <button type="submit" name="listok" class="btn btn-info" style="padding: 8px 20px; font-size: 0.9rem;"><i class="fa-solid fa-magnifying-glass"></i> Tìm kiếm</button>
                <a href="index.php?act=listtintuc" class="btn btn-danger" style="padding: 8px 20px; font-size: 0.9rem; background-color: #94a3b8;"><i class="fa-solid fa-rotate"></i> Reset</a>
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
                        <th style="width: 80px;">Mã tin</th>
                        <th style="width: 100px; text-align: center;">Hình ảnh</th>
                        <th>Tiêu đề bài viết</th>
                        <th style="width: 120px;">Ngày đăng</th>
                        <th>Nội dung tóm tắt</th>
                        <th style="width: 180px; text-align: center;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($listtintuc) && is_array($listtintuc) && count($listtintuc) > 0) {
                        foreach ($listtintuc as $tin) {
                            extract($tin);
                            $suatintuc = "index.php?act=suatintuc&id=" . $id;
                            $xoatintuc = "index.php?act=xoatintuc&id=" . $id;
                            $hinh_path = get_news_image($img);
                            ?>
                            <tr>
                                <td>TT-<?= $id ?></td>
                                <td style="text-align: center;">
                                    <?php if ($hinh_path != ""): ?>
                                        <img src="<?= $hinh_path ?>" alt="Hình ảnh tin tức" style="width: 80px; height: 50px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border-color);">
                                    <?php else: ?>
                                        <span style="color: #94a3b8; font-size: 0.8rem;">Không có ảnh</span>
                                    <?php endif; ?>
                                </td>
                                <td style="font-weight: 600; color: var(--dark-color);"><?= htmlspecialchars($title) ?></td>
                                <td><?= htmlspecialchars($date) ?></td>
                                <td style="font-size: 0.85rem; color: #64748b; max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?= htmlspecialchars($mota) ?></td>
                                <td style="text-align: center;">
                                    <a href="<?= $suatintuc ?>" class="btn btn-info btn-sm" style="margin-right: 5px;"><i class="fa-solid fa-pen-to-square"></i> Sửa</a>
                                    <a href="<?= $xoatintuc ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')"><i class="fa-solid fa-trash-can"></i> Xóa</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<tr><td colspan="6" style="text-align: center; color: #7f8c8d;">Không có bài viết nào trong hệ thống.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
