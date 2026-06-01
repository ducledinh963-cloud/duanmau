<div class="admin-container">
    <div class="admin-card">
        <div class="card-header">
            <h2 class="card-title"><i class="fa-solid fa-list-check"></i> DANH SÁCH DANH MỤC SẢN PHẨM</h2>
            <a href="index.php?act=adddanhmuc" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Thêm danh mục mới</a>
        </div>

        <!-- SEARCH FORM -->
        <div style="background-color: var(--light-color); padding: 15px; border-radius: 8px; border: 1px solid var(--border-color); margin-bottom: 20px;">
            <form action="index.php?act=listdanhmuc" method="POST" style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 200px;">
                    <input type="text" name="kyw" class="admin-form-control" placeholder="Tìm danh mục theo tên..." value="<?= isset($_POST['kyw']) ? htmlspecialchars($_POST['kyw']) : '' ?>" style="padding: 8px 12px; font-size: 0.9rem;">
                </div>
                <button type="submit" name="listok" class="btn btn-info" style="padding: 8px 20px; font-size: 0.9rem;"><i class="fa-solid fa-magnifying-glass"></i> Tìm kiếm</button>
                <a href="index.php?act=listdanhmuc" class="btn btn-danger" style="padding: 8px 20px; font-size: 0.9rem; background-color: #94a3b8;"><i class="fa-solid fa-rotate"></i> Reset</a>
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
                        <th style="width: 100px;">Mã loại</th>
                        <th>Tên danh mục</th>
                        <th style="width: 200px; text-align: center;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($listdanhmuc) && is_array($listdanhmuc) && count($listdanhmuc) > 0) {
                        foreach ($listdanhmuc as $dm) {
                            extract($dm);
                            $suadm = "index.php?act=suadm&id=" . $id;
                            $xoadm = "index.php?act=xoadm&id=" . $id;
                            ?>
                            <tr>
                                <td>DM-<?= $id ?></td>
                                <td style="font-weight: 600; color: var(--dark-color);"><?= htmlspecialchars($name) ?></td>
                                <td style="text-align: center;">
                                    <a href="<?= $suadm ?>" class="btn btn-info btn-sm" style="margin-right: 5px;"><i class="fa-solid fa-pen-to-square"></i> Sửa</a>
                                    <a href="<?= $xoadm ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này? Tất cả sản phẩm thuộc danh mục cũng sẽ bị xóa!')"><i class="fa-solid fa-trash-can"></i> Xóa</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<tr><td colspan="3" style="text-align: center; color: #7f8c8d;">Không có danh mục nào trong hệ thống.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
