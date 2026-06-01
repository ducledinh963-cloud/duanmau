<?php
/**
 * Lấy danh sách tin tức mới nhất để hiển thị ở sidebar
 */
function loadall_tintuc(){
    $sql = "SELECT * FROM tintuc ORDER BY id DESC LIMIT 5";
    $listtintuc = pdo_query($sql);
    return $listtintuc;
}

/**
 * Lấy đường dẫn hình ảnh tin tức với fallback Unsplash chất lượng cao
 */
function get_news_image($img_name) {
    if (empty($img_name)) {
        return 'https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=500';
    }
    
    // Nếu là link tuyệt đối
    if (strpos($img_name, 'http://') === 0 || strpos($img_name, 'https://') === 0) {
        return $img_name;
    }
    
    // Kiểm tra file cục bộ
    if (file_exists("uploads/" . $img_name)) {
        return "uploads/" . $img_name;
    }
    
    if (file_exists("../uploads/" . $img_name)) {
        return "../uploads/" . $img_name;
    }
    
    // Dữ liệu fallback ảnh
    $fallbacks = [
        'tintuc1.jpg' => 'https://images.unsplash.com/photo-1601004890684-d8cbf643f5f2?q=80&w=500', // Dried fruit / persimmon
        'tintuc2.jpg' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=500', // Happy weekend promo
        'tintuc3.jpg' => 'https://images.unsplash.com/photo-1523049673857-eb18f1d7b578?q=80&w=500', // Avocado
    ];
    
    if (array_key_exists($img_name, $fallbacks)) {
        return $fallbacks[$img_name];
    }
    
    return 'https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=500';
}

/**
 * Thêm tin tức mới
 */
function insert_tintuc($title, $date, $img, $mota){
    $sql = "INSERT INTO tintuc(title, date, img, mota) VALUES(?, ?, ?, ?)";
    pdo_execute($sql, $title, $date, $img, $mota);
}

/**
 * Xóa tin tức
 */
function delete_tintuc($id){
    $sql = "DELETE FROM tintuc WHERE id = ?";
    pdo_execute($sql, $id);
}

/**
 * Lấy chi tiết thông tin 1 tin tức theo ID
 */
function loadone_tintuc($id){
    $sql = "SELECT * FROM tintuc WHERE id = ?";
    $tin = pdo_query_one($sql, $id);
    return $tin;
}

/**
 * Cập nhật tin tức
 */
function update_tintuc($id, $title, $date, $img, $mota){
    if($img != ""){
        $sql = "UPDATE tintuc SET title = ?, date = ?, img = ?, mota = ? WHERE id = ?";
        pdo_execute($sql, $title, $date, $img, $mota, $id);
    } else {
        $sql = "UPDATE tintuc SET title = ?, date = ?, mota = ? WHERE id = ?";
        pdo_execute($sql, $title, $date, $mota, $id);
    }
}

/**
 * Lấy danh sách tin tức cho quản trị admin (có bộ lọc tìm kiếm)
 */
function loadall_tintuc_admin($keyw = ""){
    $sql = "SELECT * FROM tintuc WHERE 1";
    if ($keyw != "") {
        $sql .= " AND title LIKE '%" . $keyw . "%' OR mota LIKE '%" . $keyw . "%'";
    }
    $sql .= " ORDER BY id DESC";
    $listtintuc = pdo_query($sql);
    return $listtintuc;
}
?>
