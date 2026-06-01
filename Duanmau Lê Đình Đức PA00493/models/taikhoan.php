<?php
// Tự động khởi tạo cấu trúc bảng taikhoan và dữ liệu mẫu nếu CSDL thiếu hoặc ít hơn 38 tài khoản
try {
    $conn = pdo_get_connection();
    
    $conn->exec("CREATE TABLE IF NOT EXISTS `taikhoan` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `user` varchar(50) NOT NULL,
      `pass` varchar(50) NOT NULL,
      `email` varchar(255) NOT NULL,
      `address` varchar(255) DEFAULT NULL,
      `tel` varchar(20) DEFAULT NULL,
      `role` tinyint(4) NOT NULL DEFAULT 0,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    
    $stmt = $conn->prepare("SELECT COUNT(*) FROM `taikhoan`");
    $stmt->execute();
    if ($stmt->fetchColumn() < 38) {
        $conn->exec("SET FOREIGN_KEY_CHECKS = 0;");
        $conn->exec("TRUNCATE TABLE `taikhoan`;");
        $conn->exec("SET FOREIGN_KEY_CHECKS = 1;");
        
        $conn->exec("INSERT INTO `taikhoan` (`id`, `user`, `pass`, `email`, `address`, `tel`, `role`) VALUES
            (1, 'admin', 'admin123', 'admin@foodmap.vn', 'Văn phòng Foodmap, Quận 2, TP. HCM', '19002233', 1),
            (2, 'user', 'user123', 'user@gmail.com', '12 Nguyễn Trãi, Thanh Xuân, Hà Nội', '0987654321', 0),
            (3, 'duc.le', 'user123', 'duc.le@gmail.com', '99 Nguyễn Trãi, Thanh Xuân, Hà Nội', '0912345678', 0),
            (4, 'minh.nguyen', 'user123', 'minh.nguyen@yahoo.com', '12 Lê Lợi, Quận 1, TP. Hồ Chí Minh', '0987654321', 0),
            (5, 'thanh.tran', 'user123', 'thanh.tran@gmail.com', '45 Nguyễn Huệ, Quận 1, TP. Hồ Chí Minh', '0901234567', 0),
            (6, 'tuan.hoang', 'user123', 'tuan.hoang@yahoo.com', '128 Trần Hưng Đạo, Hoàn Kiếm, Hà Nội', '0933445566', 0),
            (7, 'tri.pham', 'user123', 'tri.pham@gmail.com', '88 Hùng Vương, Hải Châu, Đà Nẵng', '0944556677', 0),
            (8, 'mai.do', 'user123', 'mai.do@hotmail.com', '34 Lê Lợi, TP. Huế, Thừa Thiên Huế', '0977889900', 0),
            (9, 'giang.vu', 'user123', 'giang.vu@gmail.com', '205 Lê Duẩn, Hai Bà Trưng, Hà Nội', '0966778899', 0),
            (10, 'thu.le', 'user123', 'thu.le@gmail.com', '12 Nguyễn Trãi, Thanh Xuân, Hà Nội', '0955667788', 0),
            (11, 'khang.nguyen', 'user123', 'khang.nguyen@gmail.com', '67 Điện Biên Phủ, Bình Thạnh, TP. HCM', '0911223344', 0),
            (12, 'bach.tran', 'user123', 'bach.tran@yahoo.com', '45 Hàng Bài, Hoàn Kiếm, Hà Nội', '0922334455', 0),
            (13, 'chi.pham', 'user123', 'chi.pham@gmail.com', '90 Nguyễn Văn Linh, Long Biên, Hà Nội', '0933445566', 0),
            (14, 'ducanh', 'user123', 'ducanh@gmail.com', '12 Lê Duẩn, Đống Đa, Hà Nội', '0944556677', 0),
            (15, 'nam.le', 'user123', 'nam.le@yahoo.com', '78 CMT8, Quận 3, TP. Hồ Chí Minh', '0955667788', 0),
            (16, 'ngocanh', 'user123', 'ngocanh@gmail.com', '15 Trần Phú, Hà Đông, Hà Nội', '0966778899', 0),
            (17, 'nghia.pham', 'user123', 'nghia.pham@gmail.com', '56 Nguyễn Hữu Thọ, Quận 7, TP. HCM', '0977889900', 0),
            (18, 'son.le', 'user123', 'son.le@gmail.com', '89 Bạch Đằng, Hải Châu, Đà Nẵng', '0988990011', 0),
            (19, 'yen.do', 'user123', 'yen.do@yahoo.com', '23 Hàng Gai, Hoàn Kiếm, Hà Nội', '0999001122', 0),
            (20, 'manh.nguyen', 'user123', 'manh.nguyen@gmail.com', '68 Nguyễn Chí Thanh, Đống Đa, Hà Nội', '0911335577', 0),
            (21, 'ha.tran', 'user123', 'ha.tran@gmail.com', '55 Cách Mạng Tháng 8, Quận 10, TP. HCM', '0922446688', 0),
            (22, 'khanh.bui', 'user123', 'khanh.bui@yahoo.com', '99 Xuân Thủy, Cầu Giấy, Hà Nội', '0933557799', 0),
            (23, 'bao.vu', 'user123', 'bao.vu@gmail.com', '12 Trường Chinh, Đống Đa, Hà Nội', '0944668800', 0),
            (24, 'dat.pham', 'user123', 'dat.pham@gmail.com', '10 Nguyễn Văn Cừ, Quận 5, TP. HCM', '0955779911', 0),
            (25, 'nhung.nguyen', 'user123', 'nhung.nguyen@yahoo.com', '77 Nguyễn Trãi, Thanh Xuân, Hà Nội', '0966880022', 0),
            (26, 'hung.tran', 'user123', 'hung.tran@gmail.com', '15 Láng Hạ, Ba Đình, Hà Nội', '0977991133', 0),
            (27, 'triet.le', 'user123', 'triet.le@gmail.com', '33 Lê Lợi, Quận 1, TP. HCM', '0988002244', 0),
            (28, 'giabao', 'user123', 'giabao@gmail.com', '44 Hùng Vương, Hải Châu, Đà Nẵng', '0999112233', 0),
            (29, 'quan.dang', 'user123', 'quan.dang@yahoo.com', '88 Nguyễn Đình Chiểu, Quận 3, TP. HCM', '0912233445', 0),
            (30, 'linh.pham', 'user123', 'linh.pham@gmail.com', '19 Láng Hạ, Đống Đa, Hà Nội', '0923344556', 0),
            (31, 'trang.nguyen', 'user123', 'trang.nguyen@gmail.com', '102 Phan Chu Trinh, Hoàn Kiếm, Hà Nội', '0934455667', 0),
            (32, 'huong.vu', 'user123', 'huong.vu@gmail.com', '56 Trần Hưng Đạo, Hoàn Kiếm, Hà Nội', '0902233445', 0),
            (33, 'phong.le', 'user123', 'phong.le@yahoo.com', '78 Hai Bà Trưng, Quận 1, TP. HCM', '0913344556', 0),
            (34, 'quyen.trinh', 'user123', 'quyen.trinh@gmail.com', '45 Lê Duẩn, Hải Châu, Đà Nẵng', '0924455667', 0),
            (35, 'dung.hoang', 'user123', 'dung.hoang@gmail.com', '12 Nguyễn Huệ, Huế', '0935566778', 0),
            (36, 'lan.nguyen', 'user123', 'lan.nguyen@yahoo.com', '89 Lê Lợi, Cần Thơ', '0946677889', 0),
            (37, 'thao.pham', 'user123', 'thao.pham@gmail.com', '23 Hùng Vương, Nha Trang', '0957788990', 0),
            (38, 'an.tran', 'user123', 'an.tran@gmail.com', '67 Nguyễn Chí Thanh, Hà Nội', '0968899001', 0)");
    }
} catch (Exception $e) {
    // Bỏ qua lỗi kết nối CSDL tạm thời
}

/**
 * Thêm tài khoản mới (Đăng ký)
 */
function insert_taikhoan($user, $pass, $email){
    $sql = "INSERT INTO taikhoan(user, pass, email) VALUES(?, ?, ?)";
    pdo_execute($sql, $user, $pass, $email);
}

/**
 * Kiểm tra tài khoản khi đăng nhập (chấp nhận tên đăng nhập hoặc email)
 */
function checkuser($user, $pass){
    $sql = "SELECT * FROM taikhoan WHERE (user = ? OR email = ?) AND pass = ?";
    $tk = pdo_query_one($sql, $user, $user, $pass);
    return $tk;
}

/**
 * Cập nhật thông tin tài khoản
 */
function update_taikhoan($id, $user, $pass, $email, $address, $tel){
    $sql = "UPDATE taikhoan SET user = ?, pass = ?, email = ?, address = ?, tel = ? WHERE id = ?";
    pdo_execute($sql, $user, $pass, $email, $address, $tel, $id);
}

/**
 * Lấy tất cả tài khoản với bộ lọc tìm kiếm
 */
function loadall_taikhoan($keyw = ""){
    $sql = "SELECT * FROM taikhoan WHERE 1";
    if ($keyw != "") {
        $sql .= " AND (user LIKE '%" . $keyw . "%' OR email LIKE '%" . $keyw . "%' OR tel LIKE '%" . $keyw . "%')";
    }
    $sql .= " ORDER BY id DESC";
    return pdo_query($sql);
}

/**
 * Xóa tài khoản
 */
function delete_taikhoan($id){
    $sql = "DELETE FROM taikhoan WHERE id = ?";
    pdo_execute($sql, $id);
}
?>
