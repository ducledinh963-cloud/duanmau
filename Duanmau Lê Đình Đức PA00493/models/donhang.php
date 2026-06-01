<?php
// Tự động khởi tạo cấu trúc bảng và dữ liệu mẫu nếu CSDL thiếu
try {
    $conn = pdo_get_connection();
    
    // Tạo bảng donhang nếu chưa tồn tại
    $conn->exec("CREATE TABLE IF NOT EXISTS `donhang` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `buyer_name` varchar(255) NOT NULL,
      `buyer_tel` varchar(20) NOT NULL,
      `buyer_address` varchar(255) NOT NULL,
      `buyer_email` varchar(255) NOT NULL,
      `order_date` varchar(50) NOT NULL,
      `total_amount` double(10,2) NOT NULL DEFAULT 0.00,
      `status` tinyint(4) NOT NULL DEFAULT 0,
      `payment_method` varchar(50) NOT NULL DEFAULT 'COD',
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    
    // Tạo bảng donhang_chitiet nếu chưa tồn tại
    $conn->exec("CREATE TABLE IF NOT EXISTS `donhang_chitiet` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `id_donhang` int(11) NOT NULL,
      `id_sanpham` int(11) NOT NULL,
      `product_name` varchar(255) NOT NULL,
      `price` double(10,2) NOT NULL DEFAULT 0.00,
      `quantity` int(11) NOT NULL DEFAULT 1,
      PRIMARY KEY (`id`),
      FOREIGN KEY (`id_donhang`) REFERENCES `donhang` (`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    
    // Kiểm tra và seed đơn hàng mẫu nếu bảng trống hoặc có ít hơn 29 đơn hàng
    $stmt = $conn->prepare("SELECT COUNT(*) FROM `donhang`");
    $stmt->execute();
    if ($stmt->fetchColumn() < 29) {
        $conn->exec("SET FOREIGN_KEY_CHECKS = 0;");
        $conn->exec("TRUNCATE TABLE `donhang_chitiet`;");
        $conn->exec("TRUNCATE TABLE `donhang`;");
        $conn->exec("SET FOREIGN_KEY_CHECKS = 1;");
        
        $conn->exec("INSERT INTO `donhang` (`id`, `buyer_name`, `buyer_tel`, `buyer_address`, `buyer_email`, `order_date`, `total_amount`, `status`, `payment_method`) VALUES
            (1, 'Lê Đình Đức', '0912345678', '99 Nguyễn Trãi, Thanh Xuân, Hà Nội', 'duc.le@gmail.com', '10:30:15 31/05/2026', 165000, 2, 'COD'),
            (2, 'Nguyễn Văn Minh', '0987654321', '12 Lê Lợi, Quận 1, TP. Hồ Chí Minh', 'minh.nguyen@yahoo.com', '14:20:00 31/05/2026', 220000, 0, 'COD'),
            (3, 'Trần Thị Thanh', '0901234567', '45 Nguyễn Huệ, Quận 1, TP. Hồ Chí Minh', 'thanh.tran@gmail.com', '15:45:10 31/05/2026', 323000, 1, 'COD'),
            (4, 'Hoàng Anh Tuấn', '0933445566', '128 Trần Hưng Đạo, Hoàn Kiếm, Hà Nội', 'tuan.hoang@yahoo.com', '09:15:30 31/05/2026', 115000, 3, 'COD'),
            (5, 'Phạm Minh Trí', '0944556677', '88 Hùng Vương, Hải Châu, Đà Nẵng', 'tri.pham@gmail.com', '18:22:45 30/05/2026', 250000, 2, 'COD'),
            (6, 'Đỗ Thị Mai', '0977889900', '34 Lê Lợi, TP. Huế, Thừa Thiên Huế', 'mai.do@hotmail.com', '11:40:00 31/05/2026', 98000, 0, 'COD'),
            (7, 'Vũ Hoàng Giang', '0966778899', '205 Lê Duẩn, Hai Bà Trưng, Hà Nội', 'giang.vu@gmail.com', '08:10:00 30/05/2026', 154000, 2, 'COD'),
            (8, 'Lê Thị Thu', '0955667788', '12 Nguyễn Trãi, Thanh Xuân, Hà Nội', 'thu.le@gmail.com', '16:30:00 29/05/2026', 82000, 1, 'COD'),
            (9, 'Nguyễn Minh Khang', '0911223344', '67 Điện Biên Phủ, Bình Thạnh, TP. HCM', 'khang.nguyen@gmail.com', '10:05:00 31/05/2026', 119000, 0, 'COD'),
            (10, 'Trần Hoàng Bách', '0922334455', '45 Hàng Bài, Hoàn Kiếm, Hà Nội', 'bach.tran@yahoo.com', '13:50:00 31/05/2026', 220000, 2, 'COD'),
            (11, 'Phạm Quỳnh Chi', '0933445566', '90 Nguyễn Văn Linh, Long Biên, Hà Nội', 'chi.pham@gmail.com', '17:12:00 31/05/2026', 85000, 1, 'COD'),
            (12, 'Nguyễn Đức Anh', '0944556677', '12 Lê Duẩn, Đống Đa, Hà Nội', 'ducanh@gmail.com', '09:40:00 31/05/2026', 145000, 2, 'COD'),
            (13, 'Lê Hoài Nam', '0955667788', '78 CMT8, Quận 3, TP. Hồ Chí Minh', 'nam.le@yahoo.com', '12:00:00 31/05/2026', 104000, 3, 'COD'),
            (14, 'Nguyễn Ngọc Anh', '0966778899', '15 Trần Phú, Hà Đông, Hà Nội', 'ngocanh@gmail.com', '14:55:00 31/05/2026', 30000, 0, 'COD'),
            (15, 'Phạm Hữu Nghĩa', '0977889900', '56 Nguyễn Hữu Thọ, Quận 7, TP. HCM', 'nghia.pham@gmail.com', '16:40:00 30/05/2026', 110000, 2, 'COD'),
            (16, 'Lê Thanh Sơn', '0988990011', '89 Bạch Đằng, Hải Châu, Đà Nẵng', 'son.le@gmail.com', '10:20:00 30/05/2026', 32000, 2, 'COD'),
            (17, 'Đỗ Hải Yến', '0999001122', '23 Hàng Gai, Hoàn Kiếm, Hà Nội', 'yen.do@yahoo.com', '11:15:00 31/05/2026', 45000, 1, 'COD'),
            (18, 'Nguyễn Duy Mạnh', '0911335577', '68 Nguyễn Chí Thanh, Đống Đa, Hà Nội', 'manh.nguyen@gmail.com', '13:00:00 31/05/2026', 18000, 0, 'COD'),
            (19, 'Trần Thu Hà', '0922446688', '55 Cách Mạng Tháng 8, Quận 10, TP. HCM', 'ha.tran@gmail.com', '15:20:00 31/05/2026', 42000, 2, 'COD'),
            (20, 'Bùi Huy Khánh', '0933557799', '99 Xuân Thủy, Cầu Giấy, Hà Nội', 'khanh.bui@yahoo.com', '08:45:00 31/05/2026', 22000, 3, 'COD'),
            (21, 'Vũ Quốc Bảo', '0944668800', '12 Trường Chinh, Đống Đa, Hà Nội', 'bao.vu@gmail.com', '11:00:00 31/05/2026', 34000, 0, 'COD'),
            (22, 'Phạm Tấn Đạt', '0955779911', '10 Nguyễn Văn Cừ, Quận 5, TP. HCM', 'dat.pham@gmail.com', '14:10:00 31/05/2026', 26000, 2, 'COD'),
            (23, 'Nguyễn Hồng Nhung', '0966880022', '77 Nguyễn Trãi, Thanh Xuân, Hà Nội', 'nhung.nguyen@yahoo.com', '16:30:00 31/05/2026', 24000, 1, 'COD'),
            (24, 'Trần Quốc Hưng', '0977991133', '15 Láng Hạ, Ba Đình, Hà Nội', 'hung.tran@gmail.com', '09:20:00 30/05/2026', 15000, 2, 'COD'),
            (25, 'Lê Minh Triết', '0988002244', '33 Lê Lợi, Quận 1, TP. HCM', 'triet.le@gmail.com', '17:05:00 30/05/2026', 16000, 3, 'COD'),
            (26, 'Nguyễn Gia Bảo', '0999112233', '44 Hùng Vương, Hải Châu, Đà Nẵng', 'giabao@gmail.com', '10:30:00 31/05/2026', 17000, 0, 'COD'),
            (27, 'Đặng Minh Quân', '0912233445', '88 Nguyễn Đình Chiểu, Quận 3, TP. HCM', 'quan.dang@yahoo.com', '12:15:00 31/05/2026', 15000, 2, 'COD'),
            (28, 'Phạm Khánh Linh', '0923344556', '19 Láng Hạ, Đống Đa, Hà Nội', 'linh.pham@gmail.com', '15:00:00 31/05/2026', 55000, 1, 'COD'),
            (29, 'Nguyễn Kiều Trang', '0934455667', '102 Phan Chu Trinh, Hoàn Kiếm, Hà Nội', 'trang.nguyen@gmail.com', '16:45:00 31/05/2026', 30000, 2, 'COD')");
            
        $conn->exec("INSERT INTO `donhang_chitiet` (`id_donhang`, `id_sanpham`, `product_name`, `price`, `quantity`) VALUES
            (1, 1, 'Cherry Mỹ Tươi Ngon, Giòn Ngọt, Size 9', 119000, 1),
            (1, 3, 'Bánh Ép Huế Gia Truyền Vị BBQ', 46000, 1),
            (2, 7, 'Trà Sen Tây Hồ Đặc Sản Hà Nội (Hộp 100g)', 220000, 1),
            (3, 1, 'Cherry Mỹ Tươi Ngon, Giòn Ngọt, Size 9', 119000, 2),
            (3, 12, 'Bột Cacao Nguyên Chất Đắk Lắk (Hộp 250g)', 85000, 1),
            (4, 18, 'Cà Rốt Đà Lạt Tươi Ngon (Túi 1kg)', 29000, 2),
            (4, 8, 'Mật Dừa Nước Tinh Chất - 300ml', 19000, 3),
            (5, 3, 'Bánh Ép Huế Gia Truyền Vị BBQ', 46000, 5),
            (5, 23, 'Su Su Đà Lạt Giòn Ngọt (Túi 1kg)', 20000, 1),
            (6, 6, 'Mật Dừa Nước Cô Đặc - Dừa Nước Ông Sáu', 40000, 2),
            (6, 20, 'Xà Lách Mỡ Đà Lạt Sạch (Bó 300g)', 18000, 1),
            (7, 21, 'Măng Tây Xanh Loại 1 Đà Lạt (Bó 250g)', 55000, 2),
            (7, 15, 'Cà Tím Tròn Đà Lạt (Túi 1kg)', 22000, 2),
            (8, 10, 'Khoai Lang Mật Đà Lạt (Túi 1kg)', 42000, 1),
            (8, 23, 'Su Su Đà Lạt Giòn Ngọt (Túi 1kg)', 20000, 2),
            (9, 1, 'Cherry Mỹ Tươi Ngon, Giòn Ngọt, Size 9', 119000, 1),
            (10, 75, 'Chả Mực Giã Tay Hạ Long Thượng Hạng (Khay 500g)', 220000, 1),
            (11, 12, 'Bột Cacao Nguyên Chất Đắk Lắk (Hộp 250g)', 85000, 1),
            (12, 49, 'Gạo Tám Thơm Điện Biên Thượng Hạng (Túi 5kg)', 145000, 1),
            (13, 50, 'Dầu Ăn Đậu Nành Simply Nguyên Chất (Chai 1L)', 52000, 2),
            (14, 51, 'Nước Mắm Nam Ngư Đệ Nhị Vị Đậm Đà (Chai 900ml)', 30000, 1),
            (15, 52, 'Thùng Mì Hảo Hảo Tôm Chua Cay (Thùng 30 gói)', 110000, 1),
            (16, 53, 'Lốc Sữa Tươi Vinamilk 100% Nguyên Chất (Lốc 4 hộp x 180ml)', 32000, 1),
            (17, 71, 'Cơm Cháy Chà Bông Ninh Bình (Gói 250g)', 45000, 1),
            (18, 20, 'Xà Lách Mỡ Đà Lạt Sạch (Bó 300g)', 18000, 1),
            (19, 10, 'Khoai Lang Mật Đà Lạt (Túi 1kg)', 42000, 1),
            (20, 11, 'Củ Cải Trắng Đà Lạt Sạch (Túi 1kg)', 22000, 1),
            (21, 13, 'Bông Cải Trắng Đà Lạt (Bông 500g)', 34000, 1),
            (22, 14, 'Cà Tím Tròn Đà Lạt (Túi 1kg)', 26000, 1),
            (23, 16, 'Đậu Cô Ve Đà Lạt Sạch (Túi 500g)', 24000, 1),
            (24, 17, 'Rau Dền Đỏ Hữu Cơ Đà Lạt (Bó 500g)', 15000, 1),
            (25, 18, 'Cải Ngọt Hữu Cơ Đà Lạt (Bó 500g)', 16000, 1),
            (26, 19, 'Mồng Tơi Sạch Đà Lạt (Bó 500g)', 17000, 1),
            (27, 20, 'Rau Muống Nước Đà Lạt (Bó 500g)', 15000, 1),
            (28, 21, 'Măng Tây Xanh Loại 1 Đà Lạt (Bó 250g)', 55000, 1),
            (29, 22, 'Nấm Đùi Gà Đà Lạt Tươi (Khay 200g)', 30000, 1)");
    }
} catch (Exception $e) {
    // Bỏ qua nếu chưa kết nối được CSDL
}

/**
 * Thêm đơn hàng mới - dùng một kết nối PDO duy nhất để lastInsertId() chính xác
 */
function insert_donhang($name, $tel, $address, $email, $date, $total, $payment = "COD") {
    $sql = "INSERT INTO donhang(buyer_name, buyer_tel, buyer_address, buyer_email, order_date, total_amount, status, payment_method) 
            VALUES(?, ?, ?, ?, ?, ?, 0, ?)";
    // Dùng cùng 1 kết nối để lấy lastInsertId() chính xác
    $conn = pdo_get_connection();
    $stmt = $conn->prepare($sql);
    $stmt->execute([$name, $tel, $address, $email, $date, $total, $payment]);
    $newId = (int)$conn->lastInsertId();
    return $newId;
}

/**
 * Thêm chi tiết đơn hàng - có kiểm tra ID hợp lệ
 */
function insert_donhang_chitiet($id_donhang, $id_sanpham, $product_name, $price, $quantity) {
    $id_donhang = (int)$id_donhang;
    if ($id_donhang <= 0) {
        throw new Exception("Lỗi: id_donhang không hợp lệ ($id_donhang) khi thêm chi tiết đơn hàng.");
    }
    $sql = "INSERT INTO donhang_chitiet(id_donhang, id_sanpham, product_name, price, quantity) 
            VALUES(?, ?, ?, ?, ?)";
    pdo_execute($sql, $id_donhang, $id_sanpham, $product_name, $price, $quantity);
}

/**
 * Lấy danh sách tất cả đơn hàng cho Admin
 */
function loadall_donhang($keyw = "") {
    $sql = "SELECT * FROM donhang WHERE 1";
    if ($keyw != "") {
        $sql .= " AND (buyer_name LIKE '%" . $keyw . "%' OR buyer_tel LIKE '%" . $keyw . "%' OR id = '" . (int)$keyw . "')";
    }
    $sql .= " ORDER BY id DESC";
    return pdo_query($sql);
}

/**
 * Lấy thông tin chi tiết một đơn hàng theo ID
 */
function loadone_donhang($id) {
    $sql = "SELECT * FROM donhang WHERE id = ?";
    return pdo_query_one($sql, $id);
}

/**
 * Lấy danh sách chi tiết sản phẩm của đơn hàng
 */
function loadall_donhang_chitiet($id_donhang) {
    $sql = "SELECT * FROM donhang_chitiet WHERE id_donhang = ? ORDER BY id ASC";
    return pdo_query($sql, $id_donhang);
}

/**
 * Cập nhật trạng thái đơn hàng
 */
function update_donhang_status($id, $status) {
    $sql = "UPDATE donhang SET status = ? WHERE id = ?";
    pdo_execute($sql, $status, $id);
}

/**
 * Xóa đơn hàng
 */
function delete_donhang($id) {
    $sql = "DELETE FROM donhang WHERE id = ?";
    pdo_execute($sql, $id);
}

/**
 * Lấy chuỗi mô tả trạng thái đơn hàng
 */
function get_order_status_text($status) {
    switch ($status) {
        case 0:
            return '<span class="status-badge" style="background-color: #fef3c7; color: #d97706; padding: 4px 8px; border-radius: 9999px; font-size: 0.8rem; font-weight: 600;">Chờ xác nhận</span>';
        case 1:
            return '<span class="status-badge" style="background-color: #e0f2fe; color: #0284c7; padding: 4px 8px; border-radius: 9999px; font-size: 0.8rem; font-weight: 600;">Đang giao hàng</span>';
        case 2:
            return '<span class="status-badge" style="background-color: #dcfce7; color: #16a34a; padding: 4px 8px; border-radius: 9999px; font-size: 0.8rem; font-weight: 600;">Đã hoàn thành</span>';
        case 3:
            return '<span class="status-badge" style="background-color: #fee2e2; color: #dc2626; padding: 4px 8px; border-radius: 9999px; font-size: 0.8rem; font-weight: 600;">Đã hủy</span>';
        default:
            return 'Không xác định';
    }
}
?>
