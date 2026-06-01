CREATE DATABASE IF NOT EXISTS `duanmau`;
USE `duanmau`;

CREATE TABLE IF NOT EXISTS `danhmuc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `sanpham` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL DEFAULT 0.00,
  `img` varchar(255) DEFAULT NULL,
  `mota` text DEFAULT NULL,
  `luotxem` int(11) NOT NULL DEFAULT 0,
  `id_danhmuc` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_danhmuc`) REFERENCES `danhmuc` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `taikhoan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `tintuc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `date` varchar(50) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `mota` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Chèn dữ liệu mẫu
INSERT INTO `danhmuc` (`id`, `name`) VALUES
(1, 'Đi Chợ Online'),
(2, 'Trái Cây Tươi Ngon'),
(3, 'Rau Củ Đà Lạt'),
(4, 'Trà - Cà Phê'),
(5, 'Đặc Sản Vùng Miền'),
(6, 'Ngon Lành');

INSERT INTO `sanpham` (`name`, `price`, `img`, `mota`, `luotxem`, `id_danhmuc`) VALUES
('Cherry Mỹ Tươi Ngon, Giòn Ngọt, Size 9', 119000, 'cherry_my.jpg', 'Cherry Mỹ nhập khẩu trực tiếp, tươi ngon giòn ngọt, giàu dinh dưỡng.', 310, 2),
('Cam Sành Vĩnh Long Kiến Vàng Vắt Nước', 19000, 'cam_sanh.jpg', 'Cam sành Vĩnh Long mọng nước, nhiều vitamin C, thích hợp vắt nước uống hàng ngày.', 95, 2),
('Bánh Ép Huế Gia Truyền Vị BBQ', 46000, 'banh_ep_huhe.jpg', 'Bánh ép Huế vị BBQ thơm ngon, giòn rụm, hương vị truyền thống đặc sản Huế.', 10, 5),
('Bơ 034 Dẻo Béo, Loại 1, 2 - 4 Trái/Kg', 40000, 'bo_034.jpg', 'Bơ 034 cơm vàng, dẻo béo, trái dài đặc trưng vùng Tây Nguyên.', 85, 2),
('Bưởi Da Xanh Loại 1 - Trái 1.2 - 1.4kg', 119000, 'buoi_da_xanh.jpg', 'Bưởi da xanh mọng nước, vị ngọt thanh, thương hiệu bến tre chất lượng cao.', 40, 2),
('Mật Dừa Nước Cô Đặc - Dừa Nước Ông Sáu', 40000, 'mat_dua_nuoc.jpg', 'Mật dừa nước cô đặc tự nhiên, tốt cho sức khỏe, giàu khoáng chất.', 25, 4),
('Mật Dừa Nước Tinh Chất - 300ml', 19000, 'mat_dua_tinh_chat.jpg', 'Nước mật dừa tự nhiên thanh mát, bù khoáng và năng lượng tức thì.', 60, 4),
('Sầu riêng Ri6 - Tươi, Hái già (Hộp 500g)', 40000, 'sau_rieng_ri6.jpg', 'Sầu riêng Ri6 cơm vàng hạt lép, thơm ngon béo ngậy, cam kết chất lượng.', 150, 2),
('Khô Bò Sợi Lá Chanh (Hộp 150g)', 79000, 'kho_bo_la_chanh.jpg', 'Khô bò sợi dai ngon đậm vị cay cay thơm lừng mùi lá chanh sấy giòn.', 0, 6),
('Khô Gà Lá Chanh Xé Cay (Túi 250g)', 49000, 'kho_ga_la_chanh.jpg', 'Thịt ức gà xé sợi tẩm ướp gia vị đậm đà, thơm lừng hương lá chanh đặc sản.', 0, 6),
('Hạt Điều Rang Muối Vỏ Lụa (Hộp 250g)', 85000, 'hat_dieu_rang_muoi.jpg', 'Hạt điều Bình Phước hạt to tròn, rang củi giữ nguyên lớp vỏ lụa béo bùi đậm đà.', 0, 6),
('Hạt Mắc Ca Nứt Vỏ Tây Nguyên (Hộp 250g)', 95000, 'mac_ca_tay_nguyen.jpg', 'Hạt mắc ca Tây Nguyên size lớn sấy nứt vỏ, vị béo ngọt tự nhiên như bơ.', 0, 6),
('Rong Biển Kẹp Hạt Dinh Dưỡng (Hộp 200g)', 65000, 'rong_bien_kep_hat.jpg', 'Rong biển giòn tan kẹp hỗn hợp hạt điều, hạnh nhân, hạt bí bùi ngậy tốt cho sức khỏe.', 0, 6),
('Bánh Tráng Cuốn Tôm Hành Tây Ninh (Xấp 10 cái)', 30000, 'banh_trang_cuon_tinh.jpg', 'Bánh tráng phơi sương mềm dẻo cuộn ruốc hành phi tôm khô thơm nức mũi Tây Ninh.', 0, 6),
('Bánh Gấu Nhân Kem Sữa Béo (Hộp 200g)', 35000, 'banh_gau_nhan_kem.jpg', 'Bánh gấu vỏ giòn rụm nhân kem sữa ngọt ngào, béo ngậy, món ăn vặt tuổi thơ.', 0, 6),
('Trái Cây Sấy Thập Cẩm Giòn (Gói 250g)', 45000, 'trai_cay_say_thap_cam.jpg', 'Thập cẩm mít, chuối, khoai lang, khổ qua sấy giòn tự nhiên không đường hóa học.', 0, 6),
('Mít Sấy Giòn Xuất Khẩu (Túi 150g)', 40000, 'mit_say_gion.jpg', 'Mít tươi sấy giòn giữ nguyên vị ngọt đậm đà và mùi thơm đặc trưng.', 0, 6),
('Xoài Cát Sấy Dẻo Chua Ngọt (Túi 150g)', 45000, 'xoai_say_deo.jpg', 'Xoài cát chín mọng sấy dẻo thơm mát, vị chua ngọt hài hòa không xơ.', 0, 6),
('Chuối Laba Sấy Dẻo Đà Lạt (Gói 250g)', 38000, 'chuoi_laba_say_deo.jpg', 'Chuối Laba Đà Lạt sấy dẻo tự nhiên, vị ngọt thanh đậm đà cực kỳ bổ dưỡng.', 0, 6),
('Cơm Cháy Siêu Ruốc Sài Gòn (Gói 250g)', 55000, 'com_chay_sieu_ruoc.jpg', 'Cơm cháy đáy nồi giòn tan phủ lớp chà bông heo dày đặc vị mặn ngọt cay.', 0, 6),
('Bánh Tai Heo Nhí Vị Sốt Mắm Hành (Túi 200g)', 28000, 'banh_tai_heo_mam_hanh.jpg', 'Bánh tai heo nhỏ xinh giòn rụm phủ sốt mắm ớt hành thơm cay lạ miệng.', 0, 6),
('Hạt Hướng Dương Vị Caramel (Gói 250g)', 30000, 'huong_duong_caramel.jpg', 'Hạt hướng dương chọn lọc rang caramel thơm ngọt, vỏ mỏng hạt mẩy.', 0, 6),
('Hạt Bí Ngô Rang Tay Cổ Truyền (Gói 250g)', 48000, 'hat_bi_ngo_rang.jpg', 'Hạt bí trắng rang tay khô ráo, thơm ngậy bổ dưỡng thích hợp nhâm nhi ngày tết.', 0, 6),
('Đậu Phộng Tỏi Ớt Cay Giòn (Hộp 250g)', 35000, 'dau_phong_toi_ot.jpg', 'Đậu phộng giòn rụm tẩm muối ớt tỏi phi thơm nồng kích thích vị giác.', 0, 6),
('Da Heo Chiên Giòn Lắc Muối Ớt (Hộp 120g)', 38000, 'da_heo_chien_gion.jpg', 'Da heo chiên phồng xốp giòn tan lắc muối ớt cay nồng cực hấp dẫn.', 0, 6),
('Khô Mực Hấp Nước Dừa Xé Sợi (Hộp 150g)', 89000, 'kho_muc_hap_nuoc_dua.jpg', 'Khô mực xé sợi hấp nước dừa thơm ngậy vị béo bùi, thịt mực dai ngọt.', 0, 6),
('Bột Ngũ Cốc Dinh Dưỡng Hạt (Hộp 500g)', 98000, 'bot_ngu_coc_dinh_duong.jpg', 'Ngũ cốc 12 loại hạt xay mịn giàu xơ protein tốt cho chế độ ăn kiêng healthy.', 0, 6),
('Granola Siêu Hạt Ăn Kiêng (Hộp 500g)', 135000, 'granola_sieu_hat.jpg', 'Granola yến mạch nướng mật ong kết hợp hạt óc chó, hạnh nhân, nam việt quất dồi dào dinh dưỡng.', 0, 6),
('Bánh Ngói Hạnh Nhân Ít Ngọt (Hộp 200g)', 75000, 'banh_ngoi_hanh_nhan.jpg', 'Bánh ngói cắt lát siêu mỏng phủ đầy hạnh nhân lát nướng giòn thơm béo ngậy.', 0, 6),
('Sữa Yogurt Nếp Cẩm Ba Vì (Hộp 120g)', 12000, 'sua_chua_nep_cam.jpg', 'Sữa chua mịn màng vị thanh nhẹ quyện nếp cẩm Điện Biên dẻo thơm.', 0, 6),
('Sữa Chua Sấy Thăng Hoa Vị Dâu (Gói 50g)', 35000, 'sua_chua_say_dau.jpg', 'Viên sữa chua sấy giòn rụm giữ nguyên men vi sinh tốt cho tiêu hóa của bé.', 0, 6),
('Caramel Phô Mai Mịn Màng (Hũ 90g)', 18000, 'caramel_pho_mai.jpg', 'Bánh flan caramel mềm mịn tan chảy trong miệng với hương thơm béo từ phô mai.', 0, 6),
('Pudding Trà Xanh Matcha Nhật (Hũ 90g)', 20000, 'pudding_matcha.jpg', 'Pudding thạch mềm mượt ngậy béo hương matcha thơm nhẹ dịu.', 0, 6),
('Bánh Bông Lan Trứng Muối Chà Bông (Ổ nhỏ)', 45000, 'bong_lan_trung_muoi.jpg', 'Cốt bánh bông lan mềm xốp phủ sốt dầu trứng óng ả và chà bông trứng muối bùi ngậy.', 0, 6),
('Bánh Su Kem Vỏ Giòn Dai (Hộp 6 cái)', 36000, 'banh_su_kem_gion.jpg', 'Bánh su kem vỏ giòn phủ kem custard ngọt dịu mát lịm cực ngon.', 0, 6),
('Thạch Dừa Xiêm Bến Tre Thanh Mát (Hộp 500g)', 25000, 'thach_dua_xiem.jpg', 'Thạch dừa mềm dai giòn ngọt tự nhiên nấu từ nước dừa xiêm tinh khiết Bến Tre.', 0, 6),
('Chè Dưỡng Nhan Tuyết Yến Bổ Lượng (Chai 330ml)', 28000, 'che_duong_nhan.jpg', 'Chè dưỡng nhan giàu collagen tự nhiên gồm tuyết yến, nhựa đào, táo đỏ, kỷ tử.', 0, 6),
('Sữa Đậu Nành Hữu Cơ Sấy Lạnh (Hộp 200g)', 60000, 'sua_dau_nanh_huu_co.jpg', 'Bột sữa đậu nành nguyên chất thơm mát dễ pha, giữ nguyên hương vị đậu nành quê.', 0, 6),
('Bánh Phồng Tôm Thượng Hạng Năm Căn (Gói 500g)', 85000, 'banh_phong_tom_nam_can.jpg', 'Bánh phồng tôm chứa tới 40% thịt tôm tươi Năm Căn Cà Mau đậm đà đặc sản.', 0, 6),
('Bột Sắn Dây Ta Ướp Hoa Nhài (Gói 500g)', 110000, 'san_day_hoa_nhai.jpg', 'Sắn dây nguyên chất thanh nhiệt cơ thể thơm nhẹ hương hoa nhài ướp tự nhiên.', 0, 6),
('Trà Bí Đao Hạt Chia Sương Sáo (Chai 330ml)', 15000, 'tra_bi_dao_hat_chia.jpg', 'Nước bí đao nấu lá dứa thanh lọc cơ thể kết hợp hạt chia bổ dưỡng và sương sáo mát.', 0, 6),
('Me Ngào Đường Cay Muối Ớt (Hộp 250g)', 35000, 'me_ngao_duong_cay.jpg', 'Me ngào đường chua ngọt kết hợp vị cay cay mặn mặn cực hấp dẫn.', 0, 6),
('Bánh Phục Linh Truyền Thống Miền Tây (Hộp 200g)', 32000, 'banh_phuc_linh.jpg', 'Bánh làm từ bột năng cốt dừa thơm phức, tan mịn ngay trên đầu lưỡi.', 0, 6),
('Bánh Thuẫn Quảng Nam Nướng Than Củi (Hộp 250g)', 38000, 'banh_thuan_quang_nam.jpg', 'Bánh thuẫn xốp mềm, dậy mùi trứng gà tươi nướng khuôn đồng truyền thống.', 0, 6),
('Lạp Xưởng Tôm Đất Sóc Trăng (Hộp 500g)', 165000, 'lap_xuong_tom_dat.jpg', 'Lạp xưởng làm từ tôm đất tươi ngọt, mỡ ít thịt nhiều dai ngon ngọt thanh.', 0, 6),
('Bánh Khảo Nhân Đậu Xanh Cao Bằng (Hộp 5 chiếc)', 35000, 'banh_khao_cao_bang.jpg', 'Bánh khảo vỏ bột gạo nếp thơm dẻo nhân đậu xanh ngọt đậm đà mang vị tết xưa.', 0, 6),
('Hồng Treo Gió Đà Lạt Loại Thượng Hạng (Hộp 250g)', 145000, 'hong_treo_gio_dalat.jpg', 'Hồng treo gió công nghệ Nhật Bản ngoài dai nhẹ trong mật dẻo ngọt lịm tự nhiên.', 0, 6),
('Bánh Đa Kế Bắc Giang Vừng Đen (Túi 3 cái)', 36000, 'banh_da_ke_bac_giang.jpg', 'Bánh đa nướng giòn rụm thơm lừng vừng đen dừa nạo giòn béo ngậy.', 0, 6);

INSERT INTO `taikhoan` (`id`, `user`, `pass`, `email`, `address`, `tel`, `role`) VALUES
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
(38, 'an.tran', 'user123', 'an.tran@gmail.com', '67 Nguyễn Chí Thanh, Hà Nội', '0968899001', 0),
(39, 'vnvay', '123456', 'hson97805@gmail.com', 'Cần Thơ', '0909090909', 0);


INSERT INTO `tintuc` (`title`, `date`, `img`, `mota`) VALUES
('Hồng treo gió và 4 món ăn cực lạ miệng', '25 Th7', 'tintuc1.jpg', 'Hướng dẫn chế biến hồng treo gió thành các món ăn vặt độc lạ, thơm ngon chiêu đãi cả nhà.'),
('Chương trình khuyến mãi – Happy Weekend – Cuối tuần sale lớn', '25 Th7', 'tintuc2.jpg', 'Cơ hội mua sắm nông sản sạch với mức giá cực hời lên tới 50% chỉ trong 3 ngày cuối tuần.'),
('Bơ Tứ Quý dẻo bùi, thơm ngon nổi tiếng vùng Đắk Lắk', '25 Th7', 'tintuc3.jpg', 'Khám phá hương vị bơ Tứ Quý Đắk Lắk dẻo béo, thơm ngon đặc sản Tây Nguyên được yêu thích.');

-- Tạo bảng quản lý đơn hàng
CREATE TABLE IF NOT EXISTS `donhang` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `donhang_chitiet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_donhang` int(11) NOT NULL,
  `id_sanpham` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_donhang`) REFERENCES `donhang` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Chèn dữ liệu mẫu cho đơn hàng
INSERT INTO `donhang` (`id`, `buyer_name`, `buyer_tel`, `buyer_address`, `buyer_email`, `order_date`, `total_amount`, `status`, `payment_method`) VALUES
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
(29, 'Nguyễn Kiều Trang', '0934455667', '102 Phan Chu Trinh, Hoàn Kiếm, Hà Nội', 'trang.nguyen@gmail.com', '16:45:00 31/05/2026', 30000, 2, 'COD');

INSERT INTO `donhang_chitiet` (`id_donhang`, `id_sanpham`, `product_name`, `price`, `quantity`) VALUES
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
(29, 22, 'Nấm Đùi Gà Đà Lạt Tươi (Khay 200g)', 30000, 1);
