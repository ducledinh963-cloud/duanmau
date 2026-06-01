<?php
/**
 * [ProductModel] Thêm bình luận mới cho sản phẩm
 */
function insert_binhluan($noidung, $iduser, $idpro, $ngaybinhluan) {
    $sql = "INSERT INTO binhluan(noidung, iduser, idpro, ngaybinhluan) VALUES(?, ?, ?, ?)";
    pdo_execute($sql, $noidung, $iduser, $idpro, $ngaybinhluan);
}

/**
 * [ProductModel] Lấy danh sách bình luận của 1 sản phẩm kèm tên tài khoản
 */
function loadall_binhluan($idpro) {
    $sql = "SELECT bl.*, tk.user as user_name FROM binhluan bl 
            JOIN taikhoan tk ON bl.iduser = tk.id 
            WHERE bl.idpro = ? 
            ORDER BY bl.id DESC";
    return pdo_query($sql, $idpro);
}

/**
 * Lấy tất cả bình luận cho quản trị viên (kèm tên tài khoản và tên sản phẩm)
 */
function loadall_binhluan_admin() {
    $sql = "SELECT bl.*, tk.user as user_name, sp.name as product_name FROM binhluan bl 
            JOIN taikhoan tk ON bl.iduser = tk.id 
            JOIN sanpham sp ON bl.idpro = sp.id 
            ORDER BY bl.id DESC";
    return pdo_query($sql);
}

/**
 * Xóa bình luận
 */
function delete_binhluan($id) {
    $sql = "DELETE FROM binhluan WHERE id = ?";
    pdo_execute($sql, $id);
}
?>
