<div class="admin-container">
    <div class="admin-card">
        <div class="card-header">
            <h2 class="card-title"><i class="fa-solid fa-boxes-stacked"></i> DANH SÁCH SẢN PHẨM</h2>
            <a href="index.php?act=addsanpham" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Thêm sản phẩm mới</a>
        </div>

        <!-- SEARCH AND FILTER FORM -->
        <div style="background-color: var(--light-color); padding: 15px; border-radius: 8px; border: 1px solid var(--border-color); margin-bottom: 20px;">
            <form action="index.php?act=listsanpham" method="POST" style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 200px;">
                    <input type="text" name="kyw" class="admin-form-control" placeholder="Tìm sản phẩm theo tên..." value="<?= isset($_POST['kyw']) ? htmlspecialchars($_POST['kyw']) : '' ?>" style="padding: 8px 12px; font-size: 0.9rem;">
                </div>
                <div>
                    <select name="iddm" class="admin-form-control" style="padding: 8px 12px; font-size: 0.9rem;">
                        <option value="0">--- Chọn danh mục sản phẩm ---</option>
                        <?php
                        if (isset($listdanhmuc) && is_array($listdanhmuc)) {
                            foreach ($listdanhmuc as $dm) {
                                extract($dm);
                                $selected = (isset($_POST['iddm']) && $_POST['iddm'] == $id) ? 'selected' : '';
                                echo '<option value="' . $id . '" ' . $selected . '>' . htmlspecialchars($name) . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" name="listok" class="btn btn-info" style="padding: 8px 20px; font-size: 0.9rem;"><i class="fa-solid fa-filter"></i> Lọc dữ liệu</button>
                <a href="index.php?act=listsanpham" class="btn btn-danger" style="padding: 8px 20px; font-size: 0.9rem; background-color: #94a3b8;"><i class="fa-solid fa-rotate"></i> Reset</a>
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
                        <th style="width: 80px;">Mã SP</th>
                        <th style="width: 80px;">Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá bán</th>
                        <th>Danh mục</th>
                        <th>Lượt xem</th>
                        <th style="width: 180px; text-align: center;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($listsanpham) && is_array($listsanpham) && count($listsanpham) > 0) {
                        foreach ($listsanpham as $sp) {
                            extract($sp);
                            $suasp = "index.php?act=suasp&id=" . $id;
                            $xoasp = "index.php?act=xoasp&id=" . $id;
                            $hinh_path = get_product_image($img);
                            $gia_format = number_format($price, 0, ',', '.') . 'đ';
                            ?>
                            <tr>
                                <td>SP-<?= $id ?></td>
                                <td>
                                    <img src="<?= $hinh_path ?>" alt="<?= htmlspecialchars($name) ?>" class="thumb-img">
                                </td>
                                <td>
                                    <div style="font-weight: 600; color: var(--dark-color);"><?= htmlspecialchars($name) ?></div>
                                    <div style="font-size: 0.8rem; color: #64748b; margin-top: 4px; max-width: 250px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;"><?= htmlspecialchars($mota) ?></div>
                                </td>
                                <td style="font-weight: 700; color: var(--danger-color);"><?= $gia_format ?></td>
                                <td><?= htmlspecialchars($name_danhmuc) ?></td>
                                <td><i class="fa-regular fa-eye"></i> <?= $luotxem ?></td>
                                <td style="text-align: center;">
                                    <a href="<?= $suasp ?>" class="btn btn-info btn-sm" style="margin-right: 5px;"><i class="fa-solid fa-pen-to-square"></i> Sửa</a>
                                    <a href="<?= $xoasp ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')"><i class="fa-solid fa-trash-can"></i> Xóa</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<tr><td colspan="7" style="text-align: center; color: #7f8c8d;">Không tìm thấy sản phẩm nào trong hệ thống.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
