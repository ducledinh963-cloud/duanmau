<?php
// Bật hiển thị lỗi để dễ gỡ lỗi khi phát triển
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Tự động sao chép các ảnh cần thiết đã được AI sinh ra vào thư mục uploads
if (!file_exists("uploads")) {
    mkdir("uploads", 0777, true);
}
$src_img = "C:/Users/Vinacom/.gemini/antigravity/brain/a1273422-e1f3-4fd9-9c55-37712f9c27d4/sau_rieng_ri6_1780217422633.png";
$dst_img = "uploads/sau_rieng_ri6.jpg";
if (file_exists($src_img) && !file_exists($dst_img)) {
    copy($src_img, $dst_img);
}
$src_banner = "C:/Users/Vinacom/.gemini/antigravity/brain/a1273422-e1f3-4fd9-9c55-37712f9c27d4/banner_dicho_1780221539825.png";
$dst_banner = "uploads/banner_dicho.png";
if (file_exists($src_banner) && !file_exists($dst_banner)) {
    copy($src_banner, $dst_banner);
}
$src_coupon = "C:/Users/Vinacom/.gemini/antigravity/brain/a1273422-e1f3-4fd9-9c55-37712f9c27d4/coupon_banner_1780222026715.png";
$dst_coupon = "uploads/coupon_banner.png";
if (file_exists($src_coupon) && !file_exists($dst_coupon)) {
    copy($src_coupon, $dst_coupon);
}
$src_orange = "C:/Users/Vinacom/.gemini/antigravity/brain/a1273422-e1f3-4fd9-9c55-37712f9c27d4/orange_banner_1780223361404.png";
$dst_orange = "uploads/orange_banner.png";
if (file_exists($src_orange) && !file_exists($dst_orange)) {
    copy($src_orange, $dst_orange);
}
$src_tea1 = "C:/Users/Vinacom/.gemini/antigravity/brain/a1273422-e1f3-4fd9-9c55-37712f9c27d4/tea_banner1_1780224008722.png";
$dst_tea1 = "uploads/tea_banner1.png";
if (file_exists($src_tea1) && !file_exists($dst_tea1)) {
    copy($src_tea1, $dst_tea1);
}
$src_tea2 = "C:/Users/Vinacom/.gemini/antigravity/brain/a1273422-e1f3-4fd9-9c55-37712f9c27d4/tea_banner2_1780224067434.png";
$dst_tea2 = "uploads/tea_banner2.png";
if (file_exists($src_tea2) && !file_exists($dst_tea2)) {
    copy($src_tea2, $dst_tea2);
}
$src_tea_hor = "C:/Users/Vinacom/.gemini/antigravity/brain/a1273422-e1f3-4fd9-9c55-37712f9c27d4/tea_horizontal_1780224108738.png";
$dst_tea_hor = "uploads/tea_horizontal.png";
if (file_exists($src_tea_hor) && !file_exists($dst_tea_hor)) {
    copy($src_tea_hor, $dst_tea_hor);
}
$src_saffron = "C:/Users/Vinacom/.gemini/antigravity/brain/a1273422-e1f3-4fd9-9c55-37712f9c27d4/saffron_banner_1780224147171.png";
$dst_saffron = "uploads/saffron_banner.png";
if (file_exists($src_saffron) && !file_exists($dst_saffron)) {
    copy($src_saffron, $dst_saffron);
}

$src_songxanh = "C:/Users/Vinacom/.gemini/antigravity/brain/a1273422-e1f3-4fd9-9c55-37712f9c27d4/song_xanh_banner_1780224552447.png";
$dst_songxanh = "uploads/song_xanh_banner.png";
if (file_exists($src_songxanh) && !file_exists($dst_songxanh)) {
    copy($src_songxanh, $dst_songxanh);
}





// Import các model cần thiết
include_once "models/pdo.php";

// Tự động khởi tạo cấu trúc bảng và dữ liệu mẫu nếu CSDL trống
try {
    $conn = pdo_get_connection();
    
    // 1. Tạo bảng danhmuc
    $conn->exec("CREATE TABLE IF NOT EXISTS `danhmuc` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(255) NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    
    // 2. Tạo bảng sanpham
    $conn->exec("CREATE TABLE IF NOT EXISTS `sanpham` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(255) NOT NULL,
      `price` double(10,2) NOT NULL DEFAULT 0.00,
      `img` varchar(255) DEFAULT NULL,
      `mota` text DEFAULT NULL,
      `luotxem` int(11) NOT NULL DEFAULT 0,
      `id_danhmuc` int(11) NOT NULL,
      PRIMARY KEY (`id`),
      FOREIGN KEY (`id_danhmuc`) REFERENCES `danhmuc` (`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    
    // 3. Tạo bảng taikhoan
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

    // 3b. Tạo bảng donhang
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

    // 3c. Tạo bảng donhang_chitiet
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


    // 4. Chèn danh mục nếu trống
    $stmt = $conn->prepare("SELECT COUNT(*) FROM danhmuc");
    $stmt->execute();
    if ($stmt->fetchColumn() == 0) {
        $conn->exec("INSERT INTO `danhmuc` (`id`, `name`) VALUES
            (1, 'Đi Chợ Online'),
            (2, 'Trái Cây Tươi Ngon'),
            (3, 'Rau Củ Đà Lạt'),
            (4, 'Trà - Cà Phê'),
            (5, 'Đặc Sản Vùng Miền'),
            (6, 'Ngon Lành')");
    }
    
    // 5. Chèn tài khoản mẫu nếu trống hoặc có ít hơn 39 tài khoản
    $stmt = $conn->prepare("SELECT COUNT(*) FROM taikhoan");
    $stmt->execute();
    if ($stmt->fetchColumn() < 39) {
        $conn->exec("SET FOREIGN_KEY_CHECKS = 0;");
        $conn->exec("TRUNCATE TABLE `taikhoan`;");
        $conn->exec("SET FOREIGN_KEY_CHECKS = 1;");
        
        $conn->exec("INSERT INTO `taikhoan` (`id`, `user`, `pass`, `email`, `address`, `tel`, `role`) VALUES
            (1, 'admin', '123456', 'admin@gmail.com', 'Văn phòng Foodmap, Quận 2, TP. HCM', '19002233', 1),
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
            (38, 'an.tran', 'user123', 'an.tran@gmail.com', '67 Nguyễn Chí Thanh, Hà Nội', '0968899001', 0),
            (39, 'vnvay', '123456', 'hson97805@gmail.com', 'Cần Thơ', '0909090909', 0)");
    }
    
    // 6. Chèn sản phẩm mẫu ban đầu nếu trống
    $stmt = $conn->prepare("SELECT COUNT(*) FROM sanpham");
    $stmt->execute();
    if ($stmt->fetchColumn() == 0) {
        $conn->exec("INSERT INTO `sanpham` (`name`, `price`, `img`, `mota`, `luotxem`, `id_danhmuc`) VALUES
            ('Cherry Mỹ Tươi Ngon, Giòn Ngọt, Size 9', 119000, 'cherry_my.jpg', 'Cherry Mỹ nhập khẩu trực tiếp, tươi ngon giòn ngọt, giàu dinh dưỡng.', 310, 2),
            ('Cam Sành Vĩnh Long Kiến Vàng Vắt Nước', 19000, 'cam_sanh.jpg', 'Cam sành Vĩnh Long mọng nước, nhiều vitamin C, thích hợp vắt nước uống hàng ngày.', 95, 2),
            ('Bánh Ép Huế Gia Truyền Vị BBQ', 46000, 'banh_ep_huhe.jpg', 'Bánh ép Huế vị BBQ thơm ngon, giòn rụm, hương vị truyền thống đặc sản Huế.', 10, 5),
            ('Bơ 034 Dẻo Béo, Loại 1, 2 - 4 Trái/Kg', 40000, 'bo_034.jpg', 'Bơ 034 cơm vàng, dẻo béo, trái dài đặc trưng vùng Tây Nguyên.', 85, 2),
            ('Bưởi Da Xanh Loại 1 - Trái 1.2 - 1.4kg', 119000, 'buoi_da_xanh.jpg', 'Bưởi da xanh mọng nước, vị ngọt thanh, thương hiệu bến tre chất lượng cao.', 40, 2),
            ('Mật Dừa Nước Cô Đặc - Dừa Nước Ông Sáu', 40000, 'mat_dua_nuoc.jpg', 'Mật dừa nước cô đặc tự nhiên, tốt cho sức khỏe, giàu khoáng chất.', 25, 4),
            ('Mật Dừa Nước Tinh Chất - 300ml', 19000, 'mat_dua_tinh_chat.jpg', 'Nước mật dừa tự nhiên thanh mát, bù khoáng và năng lượng tức thì.', 60, 4),
            ('Sầu riêng Ri6 - Tươi, Hái già (Hộp 500g)', 40000, 'sau_rieng_ri6.jpg', 'Sầu riêng Ri6 cơm vàng hạt lép, thơm ngon béo ngậy, cam kết chất lượng.', 150, 2)");
    }
    
    // 5b. Chèn đơn hàng mẫu nếu trống hoặc có ít hơn 29 đơn hàng
    $stmt = $conn->prepare("SELECT COUNT(*) FROM donhang");
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
    // Bỏ qua lỗi kết nối CSDL tạm thời
}

include_once "models/danhmuc.php";
include_once "models/sanpham.php";
include_once "models/taikhoan.php";
include_once "models/tintuc.php";
include_once "models/binhluan.php";
include_once "models/donhang.php";

// Tự động chèn dữ liệu sản phẩm cho danh mục Rau Củ Đà Lạt (iddm = 3) nếu chưa đủ 29 sản phẩm
try {
    $conn = pdo_get_connection();
    $stmt = $conn->prepare("SELECT COUNT(*) FROM sanpham WHERE id_danhmuc = 3");
    $stmt->execute();
    $count = $stmt->fetchColumn();
    if ($count < 29) {
        // Xóa sạch để tránh trùng lặp
        $conn->exec("DELETE FROM sanpham WHERE id_danhmuc = 3");
        
        $sql = "INSERT INTO sanpham (name, price, img, mota, id_danhmuc) VALUES 
            ('Khoai Tây Đà Lạt Loại 1 (Túi 1kg)', 35000, 'khoai_tay.jpg', 'Khoai tây Đà Lạt củ tròn đều, da vàng mịn, ruột vàng đậm, nhiều tinh bột dẻo bùi.', 3), 
            ('Cà Rốt Đà Lạt Tươi Ngon (Túi 1kg)', 29000, 'ca_rot.jpg', 'Cà rốt hữu cơ Đà Lạt màu cam tươi tắn, giòn ngọt tự nhiên, giàu Vitamin A.', 3), 
            ('Bắp Cải Trắng Đà Lạt (Trái ~1.2kg)', 25000, 'bap_cai.jpg', 'Bắp cải Đà Lạt cuộn chặt, lá tươi non giòn ngọt, giàu chất xơ và vitamin C.', 3),
            ('Súp Lơ Xanh Đà Lạt (Bông 500g)', 32000, 'sup_lo_xanh.jpg', 'Súp lơ xanh Đà Lạt hữu cơ tươi giòn, bông to cuộn chặt, giàu dinh dưỡng và vitamin.', 3),
            ('Cà Chua Beef Đà Lạt (Túi 1kg)', 38000, 'ca_chua_beef.jpg', 'Cà chua beef trái to mọng nước, cơm dày vị chua ngọt hài hòa, chuẩn VietGAP Đà Lạt.', 3),
            ('Ớt Chuông Đà Lạt Nhiều Màu (Túi 500g)', 45000, 'ot_chuong.jpg', 'Ớt chuông đỏ, vàng, xanh Đà Lạt giòn ngọt, không hăng, giàu vitamin C và chất chống oxy hóa.', 3),
            ('Xà Lách Mỡ Đà Lạt Sạch (Bó 300g)', 18000, 'xa_lach.jpg', 'Xà lách mỡ lá mềm ngọt, cuộn tròn búp giòn mát, cực kỳ thích hợp làm salad trộn hàng ngày.', 3),
            ('Khoai Lang Mật Đà Lạt (Túi 1kg)', 42000, 'khoai_lang.jpg', 'Khoai lang mật Đà Lạt ruột vàng cam, ngọt lịm chảy mật khi nướng hoặc hấp dẻo.', 3),
            ('Củ Cải Trắng Đà Lạt Sạch (Túi 1kg)', 22000, 'cu_cai.jpg', 'Củ cải trắng Đà Lạt thon dài, mọng nước, ngọt thanh thích hợp nấu canh hoặc kho thịt.', 3),
            ('Bí Đỏ Hồ Lô Đà Lạt (Trái ~1kg)', 28000, 'bi_do.jpg', 'Bí đỏ hồ lô Đà Lạt ruột vàng đặc, dẻo bùi và vị ngọt tự nhiên, rất bổ dưỡng.', 3),
            ('Bông Cải Trắng Đà Lạt (Bông 500g)', 34000, 'bong_cai_trang.jpg', 'Bông cải trắng tươi ngon, bông khít, giòn ngọt giàu dinh dưỡng.', 3),
            ('Cà Tím Tròn Đà Lạt (Túi 1kg)', 26000, 'ca_tim.jpg', 'Cà tím quả tròn căng mọng, thịt quả dày dai ngọt mát thích hợp làm các món nướng.', 3),
            ('Đậu Cô Ve Đà Lạt Sạch (Túi 500g)', 24000, 'dau_co_ve.jpg', 'Đậu cô ve xanh mướt, giòn ngọt tự nhiên chuẩn hữu cơ Đà Lạt.', 3),
            ('Rau Dền Đỏ Hữu Cơ Đà Lạt (Bó 500g)', 15000, 'rau_den.jpg', 'Rau dền đỏ lá tươi non ngọt mát, nấu canh giải nhiệt mùa hè cực tốt.', 3),
            ('Cải Ngọt Hữu Cơ Đà Lạt (Bó 500g)', 16000, 'cai_ngot.jpg', 'Cải ngọt thân giòn ngọt, giàu vitamin và chất xơ, thích hợp xào hoặc nấu canh.', 3),
            ('Mồng Tơi Sạch Đà Lạt (Bó 500g)', 17000, 'mong_toi.jpg', 'Rau mồng tơi tươi non nhiều nhớt tự nhiên, bổ dưỡng tốt cho hệ tiêu hóa.', 3),
            ('Rau Muống Nước Đà Lạt (Bó 500g)', 15000, 'rau_muong.jpg', 'Rau muống cọng giòn non, ăn sống làm gỏi hay xào tỏi đều ngon mê ly.', 3),
            ('Măng Tây Xanh Loại 1 Đà Lạt (Bó 250g)', 55000, 'mang_tay.jpg', 'Măng tây xanh tươi giòn, ngọt nước, giàu dinh dưỡng cao cấp chuẩn VietGAP.', 3),
            ('Nấm Đùi Gà Đà Lạt Tươi (Khay 200g)', 30000, 'nam_dui_ga.jpg', 'Nấm đùi gà thịt dày dai giòn ngon, ngọt vị tự nhiên đậm đà.', 3),
            ('Nấm Kim Châm Đà Lạt (Gói 150g)', 15000, 'nam_kim_cham.jpg', 'Nấm kim châm trắng tinh khiết, giòn dai ăn lẩu hoặc xào cực ngon.', 3),
            ('Hành Tây Đà Lạt (Túi 1kg)', 32000, 'hanh_tay.jpg', 'Hành tây Đà Lạt củ to tròn, vị ngọt thanh không hăng gắt như hành nhập khẩu.', 3),
            ('Tỏi Cô Đơn Đà Lạt Đặc Sản (Túi 250g)', 85000, 'toi.jpg', 'Tỏi cô đơn (tỏi một tép) Đà Lạt thơm nồng đặc trưng, chứa dược tính cao.', 3),
            ('Gừng Sẻ Đà Lạt Cay Thơm (Túi 250g)', 25000, 'gung.jpg', 'Gừng sẻ củ nhỏ nhưng cực kỳ thơm cay và đậm đà hương vị truyền thống.', 3),
            ('Su Su Đà Lạt Giòn Ngọt (Túi 1kg)', 20000, 'su_su.jpg', 'Quả su su tươi xanh, giòn ngọt thanh mát thích hợp luộc chấm kho quẹt hoặc xào.', 3),
            ('Mướp Hương Đà Lạt Mềm Thơm (Trái ~500g)', 22000, 'muop.jpg', 'Mướp hương ruột mềm, đặc biệt thơm ngát khi chế biến các món canh xào.', 3),
            ('Khổ Qua Rừng Đà Lạt (Túi 500g)', 39000, 'kho_qua.jpg', 'Khổ qua rừng vị đắng thanh đặc trưng, cực kỳ mát gan và tốt cho sức khỏe.', 3),
            ('Đậu Hà Lan Đà Lạt Tươi (Khay 250g)', 48000, 'dau_ha_lan.jpg', 'Hạt đậu Hà Lan ngọt bùi thơm ngon, nhiều protein thực vật bổ dưỡng.', 3),
            ('Dưa Leo Baby Đà Lạt Giòn Mọng (Túi 500g)', 26000, 'dua_leo_baby.jpg', 'Dưa leo baby da bóng mướt, ruột nhỏ ít hạt cực kỳ giòn ngọt ăn sống rất đã.', 3),
            ('Cải Thảo Đà Lạt Giòn Ngọt (Trái ~1.5kg)', 30000, 'cai_thao.jpg', 'Cải thảo bẹ lá dày ngọt nước, thích hợp làm kim chi hoặc xào thịt bò.', 3)";
        $conn->exec($sql);
    }
} catch (Exception $e) {
    // Bỏ qua nếu xảy ra lỗi CSDL tạm thời
}

// Tự động chèn dữ liệu sản phẩm cho danh mục Đi Chợ Online (iddm = 1) nếu chưa đủ 8 sản phẩm
try {
    $conn = pdo_get_connection();
    $stmt = $conn->prepare("SELECT COUNT(*) FROM sanpham WHERE id_danhmuc = 1");
    $stmt->execute();
    $count = $stmt->fetchColumn();
    if ($count < 8) {
        // Xóa sạch để tránh trùng lặp
        $conn->exec("DELETE FROM sanpham WHERE id_danhmuc = 1");
        
        $sql = "INSERT INTO sanpham (name, price, img, mota, id_danhmuc) VALUES 
            ('Thịt Ba Chỉ Heo Sạch VietGAP (Túi 500g)', 85000, 'thit_ba_chi.jpg', 'Thịt ba chỉ heo sạch chuẩn VietGAP, thịt mỡ xen kẽ đều, tươi ngon mỗi ngày, phù hợp luộc, kho hoặc chiên giòn.', 1),
            ('Trứng Gà Ta Sạch Tự Nhiên (Hộp 10 quả)', 35000, 'trung_ga.jpg', 'Trứng gà ta chọn lọc từ trang trại sạch, vỏ dày lòng đỏ to, thơm ngon béo ngậy giàu chất dinh dưỡng.', 1),
            ('Cá Hồi Phi Lê Tươi Nhập Khẩu (Khay 200g)', 125000, 'ca_hoi.jpg', 'Cá hồi Na Uy nhập khẩu tươi sống hảo hạng, phi lê sạch xương và da, giàu chất béo Omega-3 tốt cho tim mạch.', 1),
            ('Gạo Tám Thơm Điện Biên Thượng Hạng (Túi 5kg)', 145000, 'gao_tam.jpg', 'Gạo tám đặc sản thung lũng Điện Biên thơm ngát, hạt nhỏ bóng đều, cơm dẻo ngọt đậm vị khi để nguội.', 1),
            ('Dầu Ăn Đậu Nành Simply Nguyên Chất (Chai 1L)', 52000, 'dau_an.jpg', 'Dầu đậu nành nguyên chất Simply, giàu Vitamin E và Omega 3-6-9 tốt cho hệ tim mạch và an toàn sức khỏe.', 1),
            ('Nước Mắm Nam Ngư Đệ Nhị Vị Đậm Đà (Chai 900ml)', 30000, 'nuoc_mam.jpg', 'Nước mắm Nam Ngư Đệ Nhị thơm ngon đậm đà hương vị truyền thống cá cơm, mang lại bữa cơm tròn vị cho gia đình.', 1),
            ('Thùng Mì Hảo Hảo Tôm Chua Cay (Thùng 30 gói)', 110000, 'mi_hao_hao.jpg', 'Mì ăn liền Hảo Hảo hương vị tôm chua cay sợi mì vàng giòn dai, hòa quyện súp chua cay đậm đà cực hấp dẫn.', 1),
            ('Lốc Sữa Tươi Vinamilk 100% Nguyên Chất (Lốc 4 hộp x 180ml)', 32000, 'sua_tuoi.jpg', 'Sữa tươi tiệt trùng Vinamilk 100% sữa sạch nguyên chất thơm béo tự nhiên, giàu canxi, vitamin A và D3.', 1)";
        $conn->exec($sql);
    }
} catch (Exception $e) {
    // Bỏ qua nếu xảy ra lỗi CSDL tạm thời
}

// Tự động chèn dữ liệu sản phẩm cho danh mục Đặc Sản Vùng Miền (iddm = 5) nếu chưa đủ 20 sản phẩm
try {
    $conn = pdo_get_connection();
    $stmt = $conn->prepare("SELECT COUNT(*) FROM sanpham WHERE id_danhmuc = 5");
    $stmt->execute();
    $count = $stmt->fetchColumn();
    if ($count < 20) {
        // Xóa sạch để tránh trùng lặp
        $conn->exec("DELETE FROM sanpham WHERE id_danhmuc = 5");
        
        $sql = "INSERT INTO sanpham (name, price, img, mota, id_danhmuc) VALUES 
            ('Bánh Ép Huế Gia Truyền Vị BBQ', 46000, 'banh_ep_huhe.jpg', 'Bánh ép Huế vị BBQ thơm ngon, giòn rụm, hương vị truyền thống đặc sản Huế.', 5),
            ('Cơm Cháy Chà Bông Ninh Bình (Gói 250g)', 45000, 'com_chay_ninh_binh.jpg', 'Cơm cháy đáy nồi siêu giòn, phủ lớp ruốc chà bông dày dặn, đậm đà gia vị đặc sản đất cố đô.', 5),
            ('Nem Chua Thanh Hóa Chính Hiệu (Hộp 10 chiếc)', 40000, 'nem_chua_thanh_hoa.jpg', 'Nem chua lên men tự nhiên giòn ngon, vị chua thanh hòa cùng tỏi ớt cay nồng trứ danh Thanh Hóa.', 5),
            ('Bánh Đậu Xanh Rồng Vàng Hải Dương (Hộp 150g)', 30000, 'banh_dau_xanh_hai_duong.jpg', 'Bánh đậu xanh truyền thống nguyên chất ngọt bùi, kết cấu mịn tan ngay trong miệng cực kỳ thơm ngon.', 5),
            ('Kẹo Dừa Bến Tre Vị Sầu Riêng Lá Dứa (Hộp 200g)', 28000, 'keo_dua_ben_tre.jpg', 'Kẹo dừa béo ngậy nước cốt dừa nguyên chất kết hợp hương thơm sầu riêng và lá dứa đặc sản Bến Tre.', 5),
            ('Chả Mực Giã Tay Hạ Long Thượng Hạng (Khay 500g)', 220000, 'cha_muc_ha_long.jpg', 'Chả mực được giã tay thủ công từ mực mai tươi sống Hạ Long, miếng chả dai ngọt tự nhiên sần sật.', 5),
            ('Bánh Tráng Phơi Sương Trảng Bàng (Túi 300g)', 35000, 'banh_trang_suong_trang_bang.jpg', 'Bánh tráng phơi sương Trảng Bàng dẻo thơm, mỏng mịn thích hợp cuốn thịt luộc, rau rừng chuẩn vị Tây Ninh.', 5),
            ('Giò Bê (Giò Me) Nam Đàn Nghệ An (~500g)', 110000, 'gio_me_nghe_an.jpg', 'Giò me làm từ thịt bê tơ nguyên miếng cuộn bì, hấp chín thơm mùi tiêu, lá đinh lăng hảo hạng miền Trung.', 5),
            ('Nem Tré Rơm Bình Định Truyền Thống (Cây 200g)', 35000, 'nem_tre_binh_dinh.jpg', 'Tré rơm Bình Định độc đáo, làm từ thịt tai mũi heo dai giòn trộn thính gạo, củ riềng và tỏi ớt đậm đà.', 5),
            ('Mè Xửng Dẻo Thiên Hương Huế (Gói 250g)', 25000, 'me_xung_hue.jpg', 'Mè xửng dẻo ngọt thanh, thơm bùi hạt mè vừng rang và đậu phộng giòn tan, món quà quê Huế mộc mạc.', 5),
            ('Bánh Pía Sóc Trăng Nhân Sầu Riêng Trứng Muối (Hộp 4 chiếc)', 65000, 'banh_pi_soc_trang.jpg', 'Bánh pía vỏ ngàn lớp mềm mịn, nhân đậu xanh sầu riêng tươi quyện trứng muối béo ngậy cực cuốn.', 5),
            ('Tỏi Cô Đơn Đảo Lý Sơn Quảng Ngãi (Túi 250g)', 180000, 'toi_ly_son.jpg', 'Tỏi một tép Lý Sơn trứ danh, tép tỏi nhỏ chứa hàm lượng tinh dầu cao, thơm cay nhẹ dịu có lợi cho sức khỏe.', 5),
            ('Mực Một Nắng Phan Thiết Loại 1 (Túi 500g)', 260000, 'muc_mot_nang_phan_thiet.jpg', 'Mực ống câu tươi rói phơi qua một nắng giòn ngọt, dày cơm thích hợp nướng mọi hoặc sa tế.', 5),
            ('Lạp Xưởng Mai Quế Lộ Cai Lậy Tiền Giang (Hộp 500g)', 120000, 'lap_xuong_cai_lay.jpg', 'Lạp xưởng tươi thơm nồng Mai Quế Lộ nướng hay chiên đều béo ngọt đậm đà hương vị miền Tây.', 5),
            ('Rượu Cần Tây Nguyên Thượng Hạng (Bình 4L)', 150000, 'ruou_can_tay_nguyen.jpg', 'Rượu cần Tây Nguyên ủ men lá cây rừng tự nhiên, hương vị nồng nàn men say bản sắc đại ngàn.', 5),
            ('Mật Ong Rừng Tràm U Minh Cà Mau (Chai 500ml)', 280000, 'mat_ong_rung_u_minh.jpg', 'Mật ong rừng tự nhiên nguyên chất thu hoạch từ rừng tràm U Minh, vị ngọt thanh mát, màu vàng óng.', 5),
            ('Trà Sâm Dứa Bảo Lộc Lâm Đồng (Gói 350g)', 35000, 'tra_sam_dua_bao_loc.jpg', 'Trà sâm dứa Bảo Lộc thơm ngát hương dứa tự nhiên, nước trà xanh vàng chát nhẹ ngọt hậu thanh mát cơ thể.', 5),
            ('Thịt Trâu Gác Bếp Tây Bắc Chuẩn Vị (Túi 500g)', 450000, 'thit_trau_gac_bep_tay_bac.jpg', 'Thịt trâu gác bếp Sơn La chuẩn vị Tây Bắc, thớ thịt đỏ hồng dai ngọt đượm hương khói bếp rừng thơm mắc khén.', 5),
            ('Nhãn Lồng Hưng Yên Hương Vị Tiến Vua (Túi 1kg)', 50000, 'nhan_long_hung_yen.jpg', 'Nhãn lồng Hưng Yên trái to tròn, cùi dày giòn mọng nước ngọt sắc đặc trưng nức tiếng gần xa.', 5),
            ('Bánh Cóng Sóc Trăng Độc Đáo Giòn Rụm (Khay 5 chiếc)', 45000, 'banh_coong_soc_trang.jpg', 'Bánh cóng Sóc Trăng chiên vàng giòn rụm thơm ngậy từ bột gạo, đậu xanh, khoai môn và tôm thịt mỡ chày.', 5)";
        $conn->exec($sql);
    }
} catch (Exception $e) {
    // Bỏ qua nếu xảy ra lỗi CSDL tạm thời
}

// Tự động chèn dữ liệu sản phẩm cho danh mục Trà - Cà Phê (iddm = 4) nếu chưa đủ 39 sản phẩm
try {
    $conn = pdo_get_connection();
    $stmt = $conn->prepare("SELECT COUNT(*) FROM sanpham WHERE id_danhmuc = 4");
    $stmt->execute();
    $count = $stmt->fetchColumn();
    if ($count < 39) {
        // Xóa sạch để tránh trùng lặp
        $conn->exec("DELETE FROM sanpham WHERE id_danhmuc = 4");
        
        $sql = "INSERT INTO sanpham (name, price, img, mota, id_danhmuc) VALUES 
            ('Mật Dừa Nước Cô Đặc - Dừa Nước Ông Sáu', 40000, 'mat_dua_nuoc.jpg', 'Mật dừa nước cô đặc tự nhiên, tốt cho sức khỏe, giàu khoáng chất.', 4),
            ('Mật Dừa Nước Tinh Chất - 300ml', 19000, 'mat_dua_tinh_chat.jpg', 'Nước mật dừa tự nhiên thanh mát, bù khoáng và năng lượng tức thì.', 4),
            ('Trà Sâm Dứa Bảo Lộc Thượng Hạng (Gói 350g)', 35000, 'tra_sam_dua.jpg', 'Trà sâm dứa hương lá dứa thơm ngát đặc trưng Lâm Đồng.', 4),
            ('Cà Phê Robusta Nguyên Chất Buôn Ma Thuột (Túi 500g)', 125000, 'cafe_robusta.jpg', 'Hạt cà phê Robusta rang mộc thơm nồng vị đậm đà đặc sản Đắk Lắk.', 4),
            ('Cà Phê Arabica Cầu Đất Đậm Đà (Túi 500g)', 185000, 'cafe_arabica.jpg', 'Cà phê Arabica Cầu Đất hương thơm tinh tế, hậu vị chua thanh tự nhiên.', 4),
            ('Trà Ô Long Cầu Đất Hộp Quà Tặng (Hộp 200g)', 150000, 'tra_olong.jpg', 'Trà Ô Long được chế biến kỹ lưỡng, nước vàng xanh óng, thơm dịu ngọt hậu.', 4),
            ('Trà Sen Tây Hồ Đặc Sản Hà Nội (Hộp 100g)', 220000, 'tra_sen_tay_ho.jpg', 'Trà sen Hồ Tây ướp gạo sen tự nhiên, hương thơm tinh tế thanh cao quý phái.', 4),
            ('Trà Cổ Thụ Tà Xùa Cao Cấp (Hộp 100g)', 350000, 'tra_ta_xua.jpg', 'Trà tuyết san cổ thụ vùng núi cao Tà Xùa Sơn La hoang dã tự nhiên trứ danh.', 4),
            ('Trà Hoa Cúc Vàng Sấy Lạnh (Lọ 80g)', 75000, 'tra_hoa_cuc.jpg', 'Trà hoa cúc nguyên bông giúp thanh nhiệt, giải độc và thư giãn tinh thần hiệu quả.', 4),
            ('Trà Hoa Atiso Đỏ Đà Lạt Sấy Khô (Túi 200g)', 65000, 'tra_atiso_do.jpg', 'Trà atiso đỏ vị chua thanh nhẹ, giàu vitamin C tốt cho tim mạch và huyết áp.', 4),
            ('Cà Phê Sữa Đá Hòa Tan G7 (Hộp 18 gói)', 58000, 'cafe_g7.jpg', 'Cà phê sữa đá hòa tan G7 thơm ngon đậm đà chuẩn vị cà phê sữa Việt Nam.', 4),
            ('Bột Cacao Nguyên Chất Đắk Lắk (Hộp 250g)', 85000, 'bot_cacao.jpg', 'Bột cacao nguyên chất không đường tốt cho tim mạch và giảm stress.', 4),
            ('Trà Lipton Nhãn Vàng Cổ Điển (Hộp 100 túi lọc)', 95000, 'tra_lipton.jpg', 'Trà túi lọc tiện lợi, chiết xuất từ lá trà đen tinh túy thơm nồng nàn.', 4),
            ('Trà Đen Phúc Long Thơm Ngát (Túi 500g)', 120000, 'tra_den_phuc_long.jpg', 'Trà đen Phúc Long chuyên dùng pha trà sữa thơm đậm đà hương vị trà truyền thống.', 4),
            ('Trà Xanh Thái Nguyên Tân Cương Loại 1 (Gói 200g)', 90000, 'tra_thai_nguyen.jpg', 'Trà xanh Tân Cương cánh trà nhỏ xoăn đều, nước xanh vàng chát dịu ngọt hậu sâu.', 4),
            ('Trà Gừng Mật Ong Sấy Lạnh (Hộp 20 gói)', 55000, 'tra_gung_mat_ong.jpg', 'Trà gừng ấm áp kết hợp mật dừa ngọt thanh bảo vệ cổ họng ngày lạnh.', 4),
            ('Trà Thảo Mộc Cung Đình Huế Vị Thanh (Gói 250g)', 80000, 'tra_cung_dinh.jpg', 'Trà thảo mộc cung đình gồm 16 vị thảo dược quý thanh nhiệt và ngủ ngon.', 4),
            ('Trà Atiso Đà Lạt Nguyên Chất (Hộp 100 túi lọc)', 85000, 'tra_atiso_tui_loc.jpg', 'Trà Atiso mát gan, giải độc, tiện lợi thích hợp dùng hàng ngày.', 4),
            ('Cà Phê Hòa Tan Nestcafe 3in1 (Hộp 20 gói)', 62000, 'nestcafe_3in1.jpg', 'Cà phê hòa tan Nestcafe hài hòa hương vị sữa béo và cà phê thơm ngon.', 4),
            ('Trà Bột Matcha Nhật Bản Nguyên Chất (Hộp 100g)', 195000, 'matcha_japan.jpg', 'Matcha nhập khẩu từ Nhật Bản màu xanh mướt vị chát dịu hậu ngọt bùi.', 4),
            ('Trà Nhài Sơn La Hương Thơm Tự Nhiên (Gói 200g)', 60000, 'tra_nhai.jpg', 'Trà xanh ướp hoa nhài tự nhiên thơm mát dễ chịu.', 4),
            ('Trà Hoa Đậu Biếc Sấy Khô Thanh Lọc (Lọ 50g)', 50000, 'tra_dau_biec.jpg', 'Trà hoa đậu biếc màu xanh tím đẹp mắt, giàu chất chống oxy hóa.', 4),
            ('Cà Phê Chồn Robusta Cao Cấp Trung Nguyên (Hộp 250g)', 950000, 'cafe_chon.jpg', 'Cà phê chồn thượng hạng hương thơm huyền bí, hậu vị kéo dài nồng nàn.', 4),
            ('Trà Hoa Hồng Tây Tạng Sấy Khô (Lọ 60g)', 110000, 'tra_hoa_hong.jpg', 'Trà nụ hoa hồng Tây Tạng giúp đẹp da, an thần và điều hòa khí huyết.', 4),
            ('Trà Hoa Nhài Mỹ Nhân Sấy Lạnh (Lọ 50g)', 90000, 'tra_nhai_my_nhan.jpg', 'Trà nụ hoa nhài sấy lạnh giữ nguyên màu sắc và hương thơm nồng nàn.', 4),
            ('Trà Gạo Lứt Huyết Rồng Đậu Đen (Hộp 500g)', 85000, 'tra_gao_lut.jpg', 'Trà gạo lứt kết hợp đậu đen thanh lọc cơ thể, hỗ trợ giảm cân giữ dáng.', 4),
            ('Trà Thảo Mộc Cam Quế Hoa Cúc (Túi 10 gói)', 75000, 'tra_cam_que.jpg', 'Trà thảo mộc vị ngọt thanh của cam và thơm nồng ấm áp của quế chi.', 4),
            ('Trà Phổ Nhĩ Quýt Vân Nam Thượng Hạng (Hộp 10 quả)', 280000, 'tra_pho_nhi.jpg', 'Trà phổ nhĩ nhồi trong vỏ quýt chín thơm nồng đậm đà vị trà lâu năm.', 4),
            ('Trà Hibiscus Sấy Giòn Vị Chua Ngọt (Túi 150g)', 55000, 'hibiscus.jpg', 'Trà hoa bụp giấm (Atiso đỏ) sấy nguyên bông giòn ngọt thanh mát.', 4),
            ('Trà Bồ Công Anh Sạch Hữu Cơ (Hộp 30 túi lọc)', 70000, 'tra_bo_cong_anh.jpg', 'Trà bồ công anh hỗ trợ giải độc gan, thanh lọc cơ thể rất tốt.', 4),
            ('Trà Khổ Qua Rừng Sấy Khô Cắt Lát (Túi 250g)', 95000, 'tra_kho_qua.jpg', 'Trà mướp đắng rừng cắt lát sấy khô, vị đắng thanh giải nhiệt trị tiểu đường.', 4),
            ('Nước Trà Xanh Không Độ Thơm Mát (Chai 500ml)', 10000, 'tra_khong_do.jpg', 'Nước trà xanh đóng chai chiết xuất từ lá trà tươi ngon bổ dưỡng.', 4),
            ('Cà Phê Lon Highland Milk Coffee (Lon 235ml)', 15000, 'cafe_lon_highland.jpg', 'Cà phê sữa đóng lon Highland thơm ngon tiện lợi uống lạnh cực đã.', 4),
            ('Trà Sâm Hàn Quốc Cao Cấp (Hộp 100 gói)', 250000, 'tra_sam_han_quoc.jpg', 'Trà nhân sâm chiết xuất từ hồng sâm Hàn Quốc bổ sung sinh lực dồi dào.', 4),
            ('Cà Phê Cold Brew Đóng Chai Đậm Vị (Chai 250ml)', 45000, 'cold_brew.jpg', 'Cà phê ủ lạnh cold brew thơm mượt mà vị chua nhẹ sảng khoái.', 4),
            ('Trà Đào Túi Lọc Cozy Hương Thơm Dịu (Hộp 20 túi)', 30000, 'tra_dao_cozy.jpg', 'Trà túi lọc Cozy vị đào thơm ngọt ngào mang lại cảm giác tươi mát.', 4),
            ('Trà Vải Túi Lọc Cozy Tươi Mát (Hộp 20 túi)', 30000, 'tra_vai_cozy.jpg', 'Trà túi lọc Cozy hương vị trái vải thơm ngon ngào ngạt đầy cuốn hút.', 4),
            ('Trà Bạc Hà Lipton Peppermint (Hộp 20 túi lọc)', 45000, 'tra_bac_ha.jpg', 'Trà lipton hương bạc hà the mát thư giãn tinh thần tuyệt vời.', 4),
            ('Trà Hoa Kỳ Tử Đỏ Sấy Sạch (Lọ 150g)', 120000, 'tra_ky_tu.jpg', 'Trà quả kỷ tử đỏ ngọt nhẹ tốt cho thị lực và chống lão hóa da.', 4)";
        $conn->exec($sql);
    }
} catch (Exception $e) {
    // Bỏ qua nếu xảy ra lỗi CSDL tạm thời
}

// Tự động chèn dữ liệu sản phẩm cho danh mục Ngon Lành (iddm = 6) nếu chưa đủ 40 sản phẩm
try {
    $conn = pdo_get_connection();
    $stmt = $conn->prepare("SELECT COUNT(*) FROM sanpham WHERE id_danhmuc = 6");
    $stmt->execute();
    $count = $stmt->fetchColumn();
    if ($count < 40) {
        // Xóa sạch để tránh trùng lặp
        $conn->exec("DELETE FROM sanpham WHERE id_danhmuc = 6");
        
        $sql = "INSERT INTO sanpham (name, price, img, mota, id_danhmuc) VALUES 
            ('Khô Bò Sợi Lá Chanh (Hộp 150g)', 79000, 'kho_bo_la_chanh.jpg', 'Khô bò sợi dai ngon đậm vị cay cay thơm lừng mùi lá chanh sấy giòn.', 6),
            ('Khô Gà Lá Chanh Xé Cay (Túi 250g)', 49000, 'kho_ga_la_chanh.jpg', 'Thịt ức gà xé sợi tẩm ướp gia vị đậm đà, thơm lừng hương lá chanh đặc sản.', 6),
            ('Hạt Điều Rang Muối Vỏ Lụa (Hộp 250g)', 85000, 'hat_dieu_rang_muoi.jpg', 'Hạt điều Bình Phước hạt to tròn, rang củi giữ nguyên lớp vỏ lụa béo bùi đậm đà.', 6),
            ('Hạt Mắc Ca Nứt Vỏ Tây Nguyên (Hộp 250g)', 95000, 'mac_ca_tay_nguyen.jpg', 'Hạt mắc ca Tây Nguyên size lớn sấy nứt vỏ, vị béo ngọt tự nhiên như bơ.', 6),
            ('Rong Biển Kẹp Hạt Dinh Dưỡng (Hộp 200g)', 65000, 'rong_bien_kep_hat.jpg', 'Rong biển giòn tan kẹp hỗn hợp hạt điều, hạnh nhân, hạt bí bùi ngậy tốt cho sức khỏe.', 6),
            ('Bánh Tráng Cuốn Tôm Hành Tây Ninh (Xấp 10 cái)', 30000, 'banh_trang_cuon_tinh.jpg', 'Bánh tráng phơi sương mềm dẻo cuộn ruốc hành phi tôm khô thơm nức mũi Tây Ninh.', 6),
            ('Bánh Gấu Nhân Kem Sữa Béo (Hộp 200g)', 35000, 'banh_gau_nhan_kem.jpg', 'Bánh gấu vỏ giòn rụm nhân kem sữa ngọt ngào, béo ngậy, món ăn vặt tuổi thơ.', 6),
            ('Trái Cây Sấy Thập Cẩm Giòn (Gói 250g)', 45000, 'trai_cay_say_thap_cam.jpg', 'Thập cẩm mít, chuối, khoai lang, khổ qua sấy giòn tự nhiên không đường hóa học.', 6),
            ('Mít Sấy Giòn Xuất Khẩu (Túi 150g)', 40000, 'mit_say_gion.jpg', 'Mít tươi sấy giòn giữ nguyên vị ngọt đậm đà và mùi thơm đặc trưng.', 6),
            ('Xoài Cát Sấy Dẻo Chua Ngọt (Túi 150g)', 45000, 'xoai_say_deo.jpg', 'Xoài cát chín mọng sấy dẻo thơm mát, vị chua ngọt hài hòa không xơ.', 6),
            ('Chuối Laba Sấy Dẻo Đà Lạt (Gói 250g)', 38000, 'chuoi_laba_say_deo.jpg', 'Chuối Laba Đà Lạt sấy dẻo tự nhiên, vị ngọt thanh đậm đà cực kỳ bổ dưỡng.', 6),
            ('Cơm Cháy Siêu Ruốc Sài Gòn (Gói 250g)', 55000, 'com_chay_sieu_ruoc.jpg', 'Cơm cháy đáy nồi giòn tan phủ lớp chà bông heo dày đặc vị mặn ngọt cay.', 6),
            ('Bánh Tai Heo Nhí Vị Sốt Mắm Hành (Túi 200g)', 28000, 'banh_tai_heo_mam_hanh.jpg', 'Bánh tai heo nhỏ xinh giòn rụm phủ sốt mắm ớt hành thơm cay lạ miệng.', 6),
            ('Hạt Hướng Dương Vị Caramel (Gói 250g)', 30000, 'huong_duong_caramel.jpg', 'Hạt hướng dương chọn lọc rang caramel thơm ngọt, vỏ mỏng hạt mẩy.', 6),
            ('Hạt Bí Ngô Rang Tay Cổ Truyền (Gói 250g)', 48000, 'hat_bi_ngo_rang.jpg', 'Hạt bí trắng rang tay khô ráo, thơm ngậy bổ dưỡng thích hợp nhâm nhi ngày tết.', 6),
            ('Đậu Phộng Tỏi Ớt Cay Giòn (Hộp 250g)', 35000, 'dau_phong_toi_ot.jpg', 'Đậu phộng giòn rụm tẩm muối ớt tỏi phi thơm nồng kích thích vị giác.', 6),
            ('Da Heo Chiên Giòn Lắc Muối Ớt (Hộp 120g)', 38000, 'da_heo_chien_gion.jpg', 'Da heo chiên phồng xốp giòn tan lắc muối ớt cay nồng cực hấp dẫn.', 6),
            ('Khô Mực Hấp Nước Dừa Xé Sợi (Hộp 150g)', 89000, 'kho_muc_hap_nuoc_dua.jpg', 'Khô mực xé sợi hấp nước dừa thơm ngậy vị béo bùi, thịt mực dai ngọt.', 6),
            ('Bột Ngũ Cốc Dinh Dưỡng Hạt (Hộp 500g)', 98000, 'bot_ngu_coc_dinh_duong.jpg', 'Ngũ cốc 12 loại hạt xay mịn giàu xơ protein tốt cho chế độ ăn kiêng healthy.', 6),
            ('Granola Siêu Hạt Ăn Kiêng (Hộp 500g)', 135000, 'granola_sieu_hat.jpg', 'Granola yến mạch nướng mật ong kết hợp hạt óc chó, hạnh nhân, nam việt quất dồi dào dinh dưỡng.', 6),
            ('Bánh Ngói Hạnh Nhân Ít Ngọt (Hộp 200g)', 75000, 'banh_ngoi_hanh_nhan.jpg', 'Bánh ngói cắt lát siêu mỏng phủ đầy hạnh nhân lát nướng giòn thơm béo ngậy.', 6),
            ('Sữa Yogurt Nếp Cẩm Ba Vì (Hộp 120g)', 12000, 'sua_chua_nep_cam.jpg', 'Sữa chua mịn màng vị thanh nhẹ quyện nếp cẩm Điện Biên dẻo thơm.', 6),
            ('Sữa Chua Sấy Thăng Hoa Vị Dâu (Gói 50g)', 35000, 'sua_chua_say_dau.jpg', 'Viên sữa chua sấy giòn rụm giữ nguyên men vi sinh tốt cho tiêu hóa của bé.', 6),
            ('Caramel Phô Mai Mịn Màng (Hũ 90g)', 18000, 'caramel_pho_mai.jpg', 'Bánh flan caramel mềm mịn tan chảy trong miệng với hương thơm béo từ phô mai.', 6),
            ('Pudding Trà Xanh Matcha Nhật (Hũ 90g)', 20000, 'pudding_matcha.jpg', 'Pudding thạch mềm mượt ngậy béo hương matcha thơm nhẹ dịu.', 6),
            ('Bánh Bông Lan Trứng Muối Chà Bông (Ổ nhỏ)', 45000, 'bong_lan_trung_muoi.jpg', 'Cốt bánh bông lan mềm xốp phủ sốt dầu trứng óng ả và chà bông trứng muối bùi ngậy.', 6),
            ('Bánh Su Kem Vỏ Giòn Dai (Hộp 6 cái)', 36000, 'banh_su_kem_gion.jpg', 'Bánh su kem vỏ giòn phủ kem custard ngọt dịu mát lịm cực ngon.', 6),
            ('Thạch Dừa Xiêm Bến Tre Thanh Mát (Hộp 500g)', 25000, 'thach_dua_xiem.jpg', 'Thạch dừa mềm dai giòn ngọt tự nhiên nấu từ nước dừa xiêm tinh khiết Bến Tre.', 6),
            ('Chè Dưỡng Nhan Tuyết Yến Bổ Lượng (Chai 330ml)', 28000, 'che_duong_nhan.jpg', 'Chè dưỡng nhan giàu collagen tự nhiên gồm tuyết yến, nhựa đào, táo đỏ, kỷ tử.', 6),
            ('Sữa Đậu Nành Hữu Cơ Sấy Lạnh (Hộp 200g)', 60000, 'sua_dau_nanh_huu_co.jpg', 'Bột sữa đậu nành nguyên chất thơm mát dễ pha, giữ nguyên hương vị đậu nành quê.', 6),
            ('Bánh Phồng Tôm Thượng Hạng Năm Căn (Gói 500g)', 85000, 'banh_phong_tom_nam_can.jpg', 'Bánh phồng tôm chứa tới 40% thịt tôm tươi Năm Căn Cà Mau đậm đà đặc sản.', 6),
            ('Bột Sắn Dây Ta Ướp Hoa Nhài (Gói 500g)', 110000, 'san_day_hoa_nhai.jpg', 'Sắn dây nguyên chất thanh nhiệt cơ thể thơm nhẹ hương hoa nhài ướp tự nhiên.', 6),
            ('Trà Bí Đao Hạt Chia Sương Sáo (Chai 330ml)', 15000, 'tra_bi_dao_hat_chia.jpg', 'Nước bí đao nấu lá dứa thanh lọc cơ thể kết hợp hạt chia bổ dưỡng và sương sáo mát.', 6),
            ('Me Ngào Đường Cay Muối Ớt (Hộp 250g)', 35000, 'me_ngao_duong_cay.jpg', 'Me ngào đường chua ngọt kết hợp vị cay cay mặn mặn cực hấp dẫn.', 6),
            ('Bánh Phục Linh Truyền Thống Miền Tây (Hộp 200g)', 32000, 'banh_phuc_linh.jpg', 'Bánh làm từ bột năng cốt dừa thơm phức, tan mịn ngay trên đầu lưỡi.', 6),
            ('Bánh Thuẫn Quảng Nam Nướng Than Củi (Hộp 250g)', 38000, 'banh_thuan_quang_nam.jpg', 'Bánh thuẫn xốp mềm, dậy mùi trứng gà tươi nướng khuôn đồng truyền thống.', 6),
            ('Lạp Xưởng Tôm Đất Sóc Trăng (Hộp 500g)', 165000, 'lap_xuong_tom_dat.jpg', 'Lạp xưởng làm từ tôm đất tươi ngọt, mỡ ít thịt nhiều dai ngon ngọt thanh.', 6),
            ('Bánh Khảo Nhân Đậu Xanh Cao Bằng (Hộp 5 chiếc)', 35000, 'banh_khao_cao_bang.jpg', 'Bánh khảo vỏ bột gạo nếp thơm dẻo nhân đậu xanh ngọt đậm đà mang vị tết xưa.', 6),
            ('Hồng Treo Gió Đà Lạt Loại Thượng Hạng (Hộp 250g)', 145000, 'hong_treo_gio_dalat.jpg', 'Hồng treo gió công nghệ Nhật Bản ngoài dai nhẹ trong mật dẻo ngọt lịm tự nhiên.', 6),
            ('Bánh Đa Kế Bắc Giang Vừng Đen (Túi 3 cái)', 36000, 'banh_da_ke_bac_giang.jpg', 'Bánh đa nướng giòn rụm thơm lừng vừng đen dừa nạo giòn béo ngậy.', 6)";
        $conn->exec($sql);
    }
} catch (Exception $e) {
    // Bỏ qua nếu xảy ra lỗi CSDL tạm thời
}

// Tự động tạo bảng binhluan nếu chưa tồn tại
try {
    $conn = pdo_get_connection();
    $sql_binhluan = "CREATE TABLE IF NOT EXISTS `binhluan` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `noidung` text NOT NULL,
      `iduser` int(11) NOT NULL,
      `idpro` int(11) NOT NULL,
      `ngaybinhluan` varchar(30) NOT NULL,
      PRIMARY KEY (`id`),
      FOREIGN KEY (`iduser`) REFERENCES `taikhoan` (`id`) ON DELETE CASCADE,
      FOREIGN KEY (`idpro`) REFERENCES `sanpham` (`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $conn->exec($sql_binhluan);
} catch (Exception $e) {
    // Bỏ qua nếu xảy ra lỗi CSDL tạm thời
}

// Tự động tạo bảng tintuc nếu chưa tồn tại
try {
    $conn = pdo_get_connection();
    $sql_tintuc = "CREATE TABLE IF NOT EXISTS `tintuc` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `title` varchar(255) NOT NULL,
      `date` varchar(50) NOT NULL,
      `img` varchar(255) DEFAULT NULL,
      `mota` text DEFAULT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $conn->exec($sql_tintuc);
    
    // Kiểm tra xem đã có dữ liệu chưa
    $stmt = $conn->prepare("SELECT COUNT(*) FROM tintuc");
    $stmt->execute();
    $count = $stmt->fetchColumn();
    if ($count == 0) {
        $sql_insert_tintuc = "INSERT INTO `tintuc` (`title`, `date`, `img`, `mota`) VALUES
        ('Hồng treo gió và 4 món ăn cực lạ miệng', '25 Th7', 'tintuc1.jpg', 'Hướng dẫn chế biến hồng treo gió thành các món ăn vặt độc lạ, thơm ngon chiêu đãi cả nhà.'),
        ('Chương trình khuyến mãi – Happy Weekend – Cuối tuần sale lớn', '25 Th7', 'tintuc2.jpg', 'Cơ hội mua sắm nông sản sạch với mức giá cực hời lên tới 50% chỉ trong 3 ngày cuối tuần.'),
        ('Bơ Tứ Quý dẻo bùi, thơm ngon nổi tiếng vùng Đắk Lắk', '25 Th7', 'tintuc3.jpg', 'Khám phá hương vị bơ Tứ Quý Đắk Lắk dẻo béo, thơm ngon đặc sản Tây Nguyên được yêu thích.');";
        $conn->exec($sql_insert_tintuc);
    }
} catch (Exception $e) {
    // Bỏ qua nếu xảy ra lỗi CSDL tạm thời
}

// Import các controllers
include_once "controllers/home.php";
include_once "controllers/sanpham.php";
include_once "controllers/register.php";
include_once "controllers/login.php";

// Khởi tạo các controller class
$homeCtrl = new home();
$sanphamCtrl = new sanpham();
$registerCtrl = new register();
$loginCtrl = new login();

// Tải danh sách danh mục hiển thị trên thanh điều hướng (navigation bar)
$dsdm = loadall_danhmuc();

// Bắt đầu include phần header dùng chung
include "views/header.php";

// Phân luồng điều hướng (Routing)
if (isset($_GET['act']) && $_GET['act'] != "") {
    $act = $_GET['act'];
    switch ($act) {
        
        case 'gioithieu':
            $homeCtrl->gioithieu();
            break;
            
        case 'lienhe':
            $homeCtrl->lienhe();
            break;
            
        case 'sanpham':
            $sanphamCtrl->list();
            break;

        case 'chitiet':
            $sanphamCtrl->detail();
            break;

        case 'addtocart':
            if (isset($_POST['addtocart'])) {
                $id = (int)$_POST['id'];
                $name = $_POST['name'];
                $price = (double)$_POST['price'];
                $img = $_POST['img'];
                $qty = (int)$_POST['qty'];
            } elseif (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = (int)$_GET['id'];
                $sp = loadone_sanpham($id);
                if ($sp) {
                    $name = $sp['name'];
                    $price = $sp['price'];
                    $img = $sp['img'];
                    $qty = 1;
                }
            }

            if (isset($id) && $id > 0) {
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }

                $found = false;
                for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                    if ($_SESSION['cart'][$i]['id'] == $id) {
                        $_SESSION['cart'][$i]['qty'] += $qty;
                        $found = true;
                        break;
                    }
                }

                if (!$found) {
                    $_SESSION['cart'][] = [
                        'id' => $id,
                        'name' => $name,
                        'price' => $price,
                        'img' => $img,
                        'qty' => $qty
                    ];
                }
            }
            echo "<script>window.location.href='" . (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php') . "';</script>";
            break;

        case 'delcart':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = (int)$_GET['id'];
                if (isset($_SESSION['cart'])) {
                    for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                        if ($_SESSION['cart'][$i]['id'] == $id) {
                            array_splice($_SESSION['cart'], $i, 1);
                            break;
                        }
                    }
                }
            } else {
                unset($_SESSION['cart']);
            }
            echo "<script>window.location.href='index.php?act=viewcart';</script>";
            break;

        case 'viewcart':
            include "views/viewcart.php";
            break;

        case 'checkout':
            if (isset($_POST['checkout'])) {
                $buyer_name = trim($_POST['buyer_name']);
                $buyer_tel = trim($_POST['buyer_tel']);
                $buyer_address = trim($_POST['buyer_address']);
                $buyer_email = trim($_POST['buyer_email']);
                $payment_method = isset($_POST['payment_method']) ? trim($_POST['payment_method']) : 'COD';
                
                if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                    $total_amount = 0;
                    foreach ($_SESSION['cart'] as $item) {
                        $total_amount += $item['price'] * $item['qty'];
                    }
                    $order_date = date('H:i:s d/m/Y');
                    
                    // Thêm đơn hàng vào database
                    $id_donhang = insert_donhang($buyer_name, $buyer_tel, $buyer_address, $buyer_email, $order_date, $total_amount, $payment_method);
                    
                    // Thêm chi tiết các mặt hàng của đơn hàng
                    foreach ($_SESSION['cart'] as $item) {
                        insert_donhang_chitiet($id_donhang, $item['id'], $item['name'], $item['price'], $item['qty']);
                    }
                    
                    if ($payment_method === 'VNPAY') {
                        // Store order details in session for the official SDK script
                        $_SESSION['vnpay_order'] = [
                            'id' => $id_donhang,
                            'amount' => $total_amount,
                            'name' => $buyer_name,
                            'tel' => $buyer_tel,
                            'email' => $buyer_email,
                            'address' => $buyer_address
                        ];
                        // Redirect to the official SDK generator script
                        echo "<script>window.location.href='vnpay_php/vnpay_create_payment.php';</script>";
                        exit();
                    }
                    
                    $order_success = true;
                    if ($payment_method === 'COD') {
                        $thongbao = "Đặt hàng thành công! Mã đơn hàng của bạn là DH-" . $id_donhang . ". Phương thức thanh toán: COD (Thanh toán khi nhận hàng). Chúng tôi sẽ liên hệ xác nhận sớm nhất qua SĐT: " . htmlspecialchars($buyer_tel) . ".";
                    } elseif ($payment_method === 'BANK') {
                        $thongbao = "Đặt hàng thành công! Mã đơn hàng của bạn là DH-" . $id_donhang . ". Phương thức thanh toán: Chuyển khoản ngân hàng. Vui lòng chuyển khoản đúng số tiền " . number_format($total_amount, 0, ',', '.') . " ₫ theo hướng dẫn chi tiết bên dưới.";
                    } else {
                        $thongbao = "Đặt hàng thành công! Mã đơn hàng của bạn là DH-" . $id_donhang . ". Phương thức thanh toán: Ví điện tử MoMo. Vui lòng gửi tiền đúng số tiền " . number_format($total_amount, 0, ',', '.') . " ₫ theo hướng dẫn chi tiết bên dưới.";
                    }
                    unset($_SESSION['cart']);
                } else {
                    $error = "Giỏ hàng của bạn đang trống! Vui lòng thêm sản phẩm trước khi đặt hàng.";
                }
            }
            include "views/viewcart.php";
            break;

        case 'vnpay_return':
            $vnp_HashSecret = "GETLEPZCQZOMHUXMMXXWJPOUXMLZQLXT"; // HMAC-SHA512 key
            $vnp_SecureHash = isset($_GET['vnp_SecureHash']) ? $_GET['vnp_SecureHash'] : '';
            
            $inputData = array();
            foreach ($_GET as $key => $value) {
                if (substr($key, 0, 4) == "vnp_") {
                    $inputData[$key] = $value;
                }
            }
            
            unset($inputData['vnp_SecureHash']);
            unset($inputData['vnp_SecureHashType']);
            ksort($inputData);
            
            $i = 0;
            $hashData = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
            }
            
            $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
            
            $payment_status = 'failed';
            $error_message = '';
            
            if ($secureHash === $vnp_SecureHash) {
                $vnp_ResponseCode = $_GET['vnp_ResponseCode'];
                $id_donhang = (int)$_GET['vnp_TxnRef'];
                
                if ($vnp_ResponseCode == '00') {
                    // Cập nhật trạng thái đơn hàng thành 1 (Đang giao hàng / Đã thanh toán)
                    update_donhang_status($id_donhang, 1);
                    // Xóa giỏ hàng
                    unset($_SESSION['cart']);
                    $payment_status = 'success';
                } else {
                    $payment_status = 'failed';
                    $error_message = 'Giao dịch không thành công hoặc bị hủy bỏ. Mã phản hồi VNPay: ' . htmlspecialchars($vnp_ResponseCode);
                }
            } else {
                $payment_status = 'invalid_signature';
                $error_message = 'Chữ ký bảo mật không trùng khớp. Giao dịch có thể đã bị can thiệp.';
            }
            
            include "views/vnpay_return.php";
            break;

        case 'dangky':
            $registerCtrl->processRegister();
            break;

        case 'dangnhap':
            $loginCtrl->processLogin();
            break;

        case 'edit_taikhoan':
            $loginCtrl->editAccount();
            break;

        case 'thoat':
            $loginCtrl->logout();
            break;

        default:
            $homeCtrl->index();
            break;
    }
} else {
    // Mặc định tải trang chủ
    $homeCtrl->index();
}

// Bắt đầu include phần footer dùng chung
include "views/footer.php";
?>
