<?php
/**
 * Thêm danh mục mới
 */
function insert_danhmuc($name){
    $sql = "INSERT INTO danhmuc(name) VALUES(?)";
    pdo_execute($sql, $name);
}

/**
 * Xóa danh mục
 */
function delete_danhmuc($id){
    $sql = "DELETE FROM danhmuc WHERE id = ?";
    pdo_execute($sql, $id);
}

/**
 * Lấy tất cả danh mục (hỗ trợ tìm kiếm theo tên)
 */
function loadall_danhmuc($kyw = ""){
    $sql = "SELECT * FROM danhmuc WHERE 1";
    if ($kyw != "") {
        $sql .= " AND name LIKE '%" . $kyw . "%'";
    }
    $sql .= " ORDER BY id DESC";
    $listdanhmuc = pdo_query($sql);
    return $listdanhmuc;
}

/**
 * Lấy 1 danh mục theo ID
 */
function loadone_danhmuc($id){
    $sql = "SELECT * FROM danhmuc WHERE id = ?";
    $dm = pdo_query_one($sql, $id);
    return $dm;
}

/**
 * Cập nhật danh mục
 */
function update_danhmuc($id, $name){
    $sql = "UPDATE danhmuc SET name = ? WHERE id = ?";
    pdo_execute($sql, $name, $id);
}
?>
