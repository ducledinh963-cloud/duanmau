<?php
/**
 * Thêm sản phẩm mới
 */
function insert_sanpham($name, $price, $img, $mota, $id_danhmuc){
    $sql = "INSERT INTO sanpham(name, price, img, mota, id_danhmuc) VALUES(?, ?, ?, ?, ?)";
    pdo_execute($sql, $name, $price, $img, $mota, $id_danhmuc);
}

/**
 * Xóa sản phẩm
 */
function delete_sanpham($id){
    $sql = "DELETE FROM sanpham WHERE id = ?";
    pdo_execute($sql, $id);
}

/**
 * Lấy danh sách sản phẩm hiển thị ở trang chủ (ví dụ lấy 8 sản phẩm mới nhất)
 */
function loadall_sanpham_home(){
    $sql = "SELECT * FROM sanpham ORDER BY id DESC LIMIT 8";
    $listsanpham = pdo_query($sql);
    return $listsanpham;
}

/**
 * Lấy danh sách sản phẩm xem nhiều nhất (top 4 hoặc 8)
 */
function loadall_sanpham_top10(){
    $sql = "SELECT * FROM sanpham ORDER BY luotxem DESC LIMIT 4";
    $listsanpham = pdo_query($sql);
    return $listsanpham;
}

/**
 * Lấy danh sách sản phẩm theo từ khóa, danh mục, và lọc giá
 */
function loadall_sanpham($keyw = "", $id_danhmuc = 0, $price_min = 0, $price_max = 0){
    $sql = "SELECT sp.*, dm.name as name_danhmuc FROM sanpham sp 
            LEFT JOIN danhmuc dm ON sp.id_danhmuc = dm.id 
            WHERE 1";
    
    if ($keyw != "") {
        $sql .= " AND sp.name LIKE '%" . $keyw . "%'";
    }
    
    if ($id_danhmuc > 0) {
        $sql .= " AND sp.id_danhmuc = " . $id_danhmuc;
    }

    if ($price_min > 0) {
        $sql .= " AND sp.price >= " . $price_min;
    }

    if ($price_max > 0) {
        $sql .= " AND sp.price <= " . $price_max;
    }
    
    $sql .= " ORDER BY sp.id DESC";
    $listsanpham = pdo_query($sql);
    return $listsanpham;
}

/**
 * [ProductModel] Lấy chi tiết thông tin 1 sản phẩm theo ID
 */
function loadone_sanpham($id){
    $sql = "SELECT sp.*, dm.name as name_danhmuc FROM sanpham sp 
            LEFT JOIN danhmuc dm ON sp.id_danhmuc = dm.id 
            WHERE sp.id = ?";
    $sp = pdo_query_one($sql, $id);
    return $sp;
}

/**
 * Tăng lượt xem sản phẩm
 */
function increase_view($id){
    $sql = "UPDATE sanpham SET luotxem = luotxem + 1 WHERE id = ?";
    pdo_execute($sql, $id);
}

/**
 * [ProductModel] Lấy sản phẩm cùng danh mục / sản phẩm liên quan
 */
function load_sanpham_cungloai($id, $id_danhmuc){
    $sql = "SELECT * FROM sanpham WHERE id_danhmuc = ? AND id <> ? ORDER BY id DESC LIMIT 4";
    $listsanpham = pdo_query($sql, $id_danhmuc, $id);
    return $listsanpham;
}

/**
 * Cập nhật sản phẩm
 */
function update_sanpham($id, $name, $price, $img, $mota, $id_danhmuc){
    if($img != ""){
        $sql = "UPDATE sanpham SET name = ?, price = ?, img = ?, mota = ?, id_danhmuc = ? WHERE id = ?";
        pdo_execute($sql, $name, $price, $img, $mota, $id_danhmuc, $id);
    } else {
        $sql = "UPDATE sanpham SET name = ?, price = ?, mota = ?, id_danhmuc = ? WHERE id = ?";
        pdo_execute($sql, $name, $price, $mota, $id_danhmuc, $id);
    }
}

/**
 * Lấy đường dẫn ảnh sản phẩm (có cơ chế fallback ảnh đẹp)
 */
function get_product_image($img_name) {
    if (empty($img_name)) {
        return 'https://images.unsplash.com/photo-1610348725531-843dff163e2c?q=80&w=500';
    }
    
    // If it's an absolute URL (like Unsplash), return it as is
    if (strpos($img_name, 'http://') === 0 || strpos($img_name, 'https://') === 0) {
        return $img_name;
    }
    
    // Check local path in root
    if (file_exists("uploads/" . $img_name)) {
        return "uploads/" . $img_name;
    }
    
    // Check local path in admin (which is one level deeper)
    if (file_exists("../uploads/" . $img_name)) {
        return "../uploads/" . $img_name;
    }
    
    // Fallbacks for original database images
    $fallbacks = [
        'banh_ep_huhe.jpg' => 'https://images.unsplash.com/photo-1589301760014-d929f3979dbc?q=80&w=500',
        'mat_dua_nuoc.jpg' => 'https://images.unsplash.com/photo-1621263764928-df1444c5e859?q=80&w=500',
        'sau_rieng_ri6.jpg' => 'https://images.unsplash.com/photo-1628134785735-688e51626fd2?q=80&w=500',
        'bo_034.jpg' => 'https://images.unsplash.com/photo-1523049673857-eb18f1d7b578?q=80&w=500',
        'buoi_da_xanh.jpg' => 'https://images.unsplash.com/photo-1550258987-190a2d41a8ba?q=80&w=500',
        'cherry_my.jpg' => 'https://images.unsplash.com/photo-1527661591475-527312dd65f5?q=80&w=500',
        'mat_dua_tinh_chat.jpg' => 'https://images.unsplash.com/photo-1556881286-fc6915169721?q=80&w=500',
        'cam_sanh.jpg' => 'https://images.unsplash.com/photo-1611080626919-7cf5a9dbab5b?q=80&w=500',
        'khoai_tay.jpg' => 'https://images.unsplash.com/photo-1518977676601-b53f82aba655?q=80&w=500',
        'ca_rot.jpg' => 'https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?q=80&w=500',
        'bap_cai.jpg' => 'https://images.unsplash.com/photo-1597362925123-77861d3da08?q=80&w=500',
        'sup_lo_xanh.jpg' => 'https://images.unsplash.com/photo-1584270354949-c26b0d5b4a0c?q=80&w=500',
        'ca_chua_beef.jpg' => 'https://images.unsplash.com/photo-1597362925123-77861d3fbac7?q=80&w=500',
        'ot_chuong.jpg' => 'https://images.unsplash.com/photo-1597362925123-77861d3fbac7?q=80&w=500',
        'xa_lach.jpg' => 'https://images.unsplash.com/photo-1549590143-690278772322?q=80&w=500',
        'khoai_lang.jpg' => 'https://images.unsplash.com/photo-1596097561402-385a6e40209e?q=80&w=500',
        'cu_cai.jpg' => 'https://images.unsplash.com/photo-1590779033100-9f60a05a013d?q=80&w=500',
        'bi_do.jpg' => 'https://images.unsplash.com/photo-1506976785307-8732e854ad03?q=80&w=500',
        'bong_cai_trang.jpg' => 'https://images.unsplash.com/photo-1568584711075-3d021a7c3ec3?q=80&w=500',
        'ca_tim.jpg' => 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?q=80&w=500',
        'dau_co_ve.jpg' => 'https://images.unsplash.com/photo-1587411768638-ec71f8e33b78?q=80&w=500',
        'rau_den.jpg' => 'https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?q=80&w=500',
        'cai_ngot.jpg' => 'https://images.unsplash.com/photo-1606787366850-de6330128bfc?q=80&w=500',
        'mong_toi.jpg' => 'https://images.unsplash.com/photo-1576045057995-568f588f82fb?q=80&w=500',
        'rau_muong.jpg' => 'https://images.unsplash.com/photo-1576045057995-568f588f82fb?q=80&w=500',
        'mang_tay.jpg' => 'https://images.unsplash.com/photo-1595855759920-86582396756a?q=80&w=500',
        'nam_dui_ga.jpg' => 'https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?q=80&w=500',
        'nam_kim_cham.jpg' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=500',
        'hanh_tay.jpg' => 'https://images.unsplash.com/photo-1618220179428-22790b461013?q=80&w=500',
        'toi.jpg' => 'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?q=80&w=500',
        'gung.jpg' => 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?q=80&w=500',
        'su_su.jpg' => 'https://images.unsplash.com/photo-1606787366850-de6330128bfc?q=80&w=500',
        'muop.jpg' => 'https://images.unsplash.com/photo-1584270354949-c26b0d5b4a0c?q=80&w=500',
        'kho_qua.jpg' => 'https://images.unsplash.com/photo-1584270354949-c26b0d5b4a0c?q=80&w=500',
        'dau_ha_lan.jpg' => 'https://images.unsplash.com/photo-1587411768638-ec71f8e33b78?q=80&w=500',
        'dua_leo_baby.jpg' => 'https://images.unsplash.com/photo-1587411768638-ec71f8e33b78?q=80&w=500',
        'cai_thao.jpg' => 'https://images.unsplash.com/photo-1597362925123-77861d3da08?q=80&w=500',
        'thit_ba_chi.jpg' => 'https://images.unsplash.com/photo-1602470520998-f4a52199a3d6?q=80&w=500',
        'trung_ga.jpg' => 'https://images.unsplash.com/photo-1516448620398-c5f44bf9f441?q=80&w=500',
        'ca_hoi.jpg' => 'https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?q=80&w=500',
        'gao_tam.jpg' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?q=80&w=500',
        'dau_an.jpg' => 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?q=80&w=500',
        'nuoc_mam.jpg' => 'https://images.unsplash.com/photo-1547592180-85f173990554?q=80&w=500',
        'mi_hao_hao.jpg' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?q=80&w=500',
        'sua_tuoi.jpg' => 'https://images.unsplash.com/photo-1550583724-b2692b85b150?q=80&w=500',
        'com_chay_ninh_binh.jpg' => 'https://images.unsplash.com/photo-1608897013039-887f21d8c804?q=80&w=500',
        'nem_chua_thanh_hoa.jpg' => 'https://images.unsplash.com/photo-1547592180-85f173990554?q=80&w=500',
        'banh_dau_xanh_hai_duong.jpg' => 'https://images.unsplash.com/photo-1505576399279-565b52d4ac71?q=80&w=500',
        'keo_dua_ben_tre.jpg' => 'https://images.unsplash.com/photo-1581798459219-318e76aecc7b?q=80&w=500',
        'cha_muc_ha_long.jpg' => 'https://images.unsplash.com/photo-1599487488170-d11ec9c172f0?q=80&w=500',
        'banh_trang_suong_trang_bang.jpg' => 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?q=80&w=500',
        'gio_me_nghe_an.jpg' => 'https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=500',
        'nem_tre_binh_dinh.jpg' => 'https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=500',
        'me_xung_hue.jpg' => 'https://images.unsplash.com/photo-1607349913338-fca6f7fc42d0?q=80&w=500',
        'banh_pi_soc_trang.jpg' => 'https://images.unsplash.com/photo-1587314168485-3236d6710814?q=80&w=500',
        'toi_ly_son.jpg' => 'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?q=80&w=500',
        'muc_mot_nang_phan_thiet.jpg' => 'https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?q=80&w=500',
        'lap_xuong_cai_lay.jpg' => 'https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=500',
        'ruou_can_tay_nguyen.jpg' => 'https://images.unsplash.com/photo-1510812431401-41d2bd2722f3?q=80&w=500',
        'mat_ong_rung_u_minh.jpg' => 'https://images.unsplash.com/photo-1587049352846-4a222e784d38?q=80&w=500',
        'tra_sam_dua_bao_loc.jpg' => 'https://images.unsplash.com/photo-1576092768241-dec231879fc3?q=80&w=500',
        'thit_trau_gac_bep_tay_bac.jpg' => 'https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=500',
        'nhan_long_hung_yen.jpg' => 'https://images.unsplash.com/photo-1550258987-190a2d41a8ba?q=80&w=500',
        'banh_coong_soc_trang.jpg' => 'https://images.unsplash.com/photo-1599487488170-d11ec9c172f0?q=80&w=500',
        'tra_sam_dua.jpg' => 'https://images.unsplash.com/photo-1576092768241-dec231879fc3?q=80&w=500',
        'cafe_robusta.jpg' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?q=80&w=500',
        'cafe_arabica.jpg' => 'https://images.unsplash.com/photo-1497935586351-b67a49e012bf?q=80&w=500',
        'tra_olong.jpg' => 'https://images.unsplash.com/photo-1563822249548-9a72b6353cd1?q=80&w=500',
        'tra_sen_tay_ho.jpg' => 'https://images.unsplash.com/photo-1597481499750-3e6b22637e12?q=80&w=500',
        'tra_ta_xua.jpg' => 'https://images.unsplash.com/photo-1544787219-7f47ccb76574?q=80&w=500',
        'tra_hoa_cuc.jpg' => 'https://images.unsplash.com/photo-1563822249548-9a72b6353cd1?q=80&w=500',
        'tra_atiso_do.jpg' => 'https://images.unsplash.com/photo-1597481499750-3e6b22637e12?q=80&w=500',
        'cafe_g7.jpg' => 'https://images.unsplash.com/photo-1511920170033-f8396924c348?q=80&w=500',
        'bot_cacao.jpg' => 'https://images.unsplash.com/photo-1587049352846-4a222e784d38?q=80&w=500',
        'tra_lipton.jpg' => 'https://images.unsplash.com/photo-1576092768241-dec231879fc3?q=80&w=500',
        'tra_den_phuc_long.jpg' => 'https://images.unsplash.com/photo-1597481499750-3e6b22637e12?q=80&w=500',
        'tra_thai_nguyen.jpg' => 'https://images.unsplash.com/photo-1563822249548-9a72b6353cd1?q=80&w=500',
        'tra_gung_mat_ong.jpg' => 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?q=80&w=500',
        'tra_cung_dinh.jpg' => 'https://images.unsplash.com/photo-1597481499750-3e6b22637e12?q=80&w=500',
        'tra_atiso_tui_loc.jpg' => 'https://images.unsplash.com/photo-1576092768241-dec231879fc3?q=80&w=500',
        'nestcafe_3in1.jpg' => 'https://images.unsplash.com/photo-1511920170033-f8396924c348?q=80&w=500',
        'matcha_japan.jpg' => 'https://images.unsplash.com/photo-1536256263959-770b48d82b0a?q=80&w=500',
        'tra_nhai.jpg' => 'https://images.unsplash.com/photo-1597481499750-3e6b22637e12?q=80&w=500',
        'tra_dau_biec.jpg' => 'https://images.unsplash.com/photo-1507133750040-4a8f57021571?q=80&w=500',
        'cafe_chon.jpg' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=500',
        'tra_hoa_hong.jpg' => 'https://images.unsplash.com/photo-1563822249548-9a72b6353cd1?q=80&w=500',
        'tra_nhai_my_nhan.jpg' => 'https://images.unsplash.com/photo-1597481499750-3e6b22637e12?q=80&w=500',
        'tra_gao_lut.jpg' => 'https://images.unsplash.com/photo-1544787219-7f47ccb76574?q=80&w=500',
        'tra_cam_que.jpg' => 'https://images.unsplash.com/photo-1597481499750-3e6b22637e12?q=80&w=500',
        'tra_cam_que.jpg' => 'https://images.unsplash.com/photo-1597481499750-3e6b22637e12?q=80&w=500',
        'tra_pho_nhi.jpg' => 'https://images.unsplash.com/photo-1563822249548-9a72b6353cd1?q=80&w=500',
        'hibiscus.jpg' => 'https://images.unsplash.com/photo-1597481499750-3e6b22637e12?q=80&w=500',
        'tra_bo_cong_anh.jpg' => 'https://images.unsplash.com/photo-1576092768241-dec231879fc3?q=80&w=500',
        'tra_kho_qua.jpg' => 'https://images.unsplash.com/photo-1563822249548-9a72b6353cd1?q=80&w=500',
        'tra_khong_do.jpg' => 'https://images.unsplash.com/photo-1576092768241-dec231879fc3?q=80&w=500',
        'cafe_lon_highland.jpg' => 'https://images.unsplash.com/photo-1511920170033-f8396924c348?q=80&w=500',
        'tra_sam_han_quoc.jpg' => 'https://images.unsplash.com/photo-1597481499750-3e6b22637e12?q=80&w=500',
        'cold_brew.jpg' => 'https://images.unsplash.com/photo-1517701604599-bb29b565090c?q=80&w=500',
        'tra_dao_cozy.jpg' => 'https://images.unsplash.com/photo-1576092768241-dec231879fc3?q=80&w=500',
        'tra_vai_cozy.jpg' => 'https://images.unsplash.com/photo-1576092768241-dec231879fc3?q=80&w=500',
        'tra_bac_ha.jpg' => 'https://images.unsplash.com/photo-1576092768241-dec231879fc3?q=80&w=500',
        'tra_ky_tu.jpg' => 'https://images.unsplash.com/photo-1597481499750-3e6b22637e12?q=80&w=500',
        'kho_bo_la_chanh.jpg' => 'https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=500',
        'kho_ga_la_chanh.jpg' => 'https://images.unsplash.com/photo-1608897013039-887f21d8c804?q=80&w=500',
        'hat_dieu_rang_muoi.jpg' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?q=80&w=500',
        'mac_ca_tay_nguyen.jpg' => 'https://images.unsplash.com/photo-1596097561402-385a6e40209e?q=80&w=500',
        'rong_bien_kep_hat.jpg' => 'https://images.unsplash.com/photo-1606787366850-de6330128bfc?q=80&w=500',
        'banh_trang_cuon_tinh.jpg' => 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?q=80&w=500',
        'banh_gau_nhan_kem.jpg' => 'https://images.unsplash.com/photo-1505576399279-565b52d4ac71?q=80&w=500',
        'trai_cay_say_thap_cam.jpg' => 'https://images.unsplash.com/photo-1550258987-190a2d41a8ba?q=80&w=500',
        'mit_say_gion.jpg' => 'https://images.unsplash.com/photo-1527661591475-527312dd65f5?q=80&w=500',
        'xoai_say_deo.jpg' => 'https://images.unsplash.com/photo-1550258987-190a2d41a8ba?q=80&w=500',
        'chuoi_laba_say_deo.jpg' => 'https://images.unsplash.com/photo-1528825871115-3581a5387919?q=80&w=500',
        'com_chay_sieu_ruoc.jpg' => 'https://images.unsplash.com/photo-1608897013039-887f21d8c804?q=80&w=500',
        'banh_tai_heo_mam_hanh.jpg' => 'https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=500',
        'huong_duong_caramel.jpg' => 'https://images.unsplash.com/photo-1596097561402-385a6e40209e?q=80&w=500',
        'hat_bi_ngo_rang.jpg' => 'https://images.unsplash.com/photo-1596097561402-385a6e40209e?q=80&w=500',
        'dau_phong_toi_ot.jpg' => 'https://images.unsplash.com/photo-1596097561402-385a6e40209e?q=80&w=500',
        'da_heo_chien_gion.jpg' => 'https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=500',
        'kho_muc_hap_nuoc_dua.jpg' => 'https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?q=80&w=500',
        'bot_ngu_coc_dinh_duong.jpg' => 'https://images.unsplash.com/photo-1587049352846-4a222e784d38?q=80&w=500',
        'granola_sieu_hat.jpg' => 'https://images.unsplash.com/photo-1517093157656-b9ecdf173a34?q=80&w=500',
        'banh_ngoi_hanh_nhan.jpg' => 'https://images.unsplash.com/photo-1505576399279-565b52d4ac71?q=80&w=500',
        'sua_chua_nep_cam.jpg' => 'https://images.unsplash.com/photo-1550583724-b2692b85b150?q=80&w=500',
        'sua_chua_say_dau.jpg' => 'https://images.unsplash.com/photo-1550583724-b2692b85b150?q=80&w=500',
        'caramel_pho_mai.jpg' => 'https://images.unsplash.com/photo-1587314168485-3236d6710814?q=80&w=500',
        'pudding_matcha.jpg' => 'https://images.unsplash.com/photo-1536256263959-770b48d82b0a?q=80&w=500',
        'bong_lan_trung_muoi.jpg' => 'https://images.unsplash.com/photo-1505576399279-565b52d4ac71?q=80&w=500',
        'banh_su_kem_gion.jpg' => 'https://images.unsplash.com/photo-1505576399279-565b52d4ac71?q=80&w=500',
        'thach_dua_xiem.jpg' => 'https://images.unsplash.com/photo-1621263764928-df1444c5e859?q=80&w=500',
        'che_duong_nhan.jpg' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=500',
        'sua_dau_nanh_huu_co.jpg' => 'https://images.unsplash.com/photo-1550583724-b2692b85b150?q=80&w=500',
        'banh_phong_tom_nam_can.jpg' => 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?q=80&w=500',
        'san_day_hoa_nhai.jpg' => 'https://images.unsplash.com/photo-1597481499750-3e6b22637e12?q=80&w=500',
        'tra_bi_dao_hat_chia.jpg' => 'https://images.unsplash.com/photo-1507133750040-4a8f57021571?q=80&w=500',
        'me_ngao_duong_cay.jpg' => 'https://images.unsplash.com/photo-1505576399279-565b52d4ac71?q=80&w=500',
        'banh_phuc_linh.jpg' => 'https://images.unsplash.com/photo-1505576399279-565b52d4ac71?q=80&w=500',
        'banh_thuan_quang_nam.jpg' => 'https://images.unsplash.com/photo-1505576399279-565b52d4ac71?q=80&w=500',
        'lap_xuong_tom_dat.jpg' => 'https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=500',
        'banh_khao_cao_bang.jpg' => 'https://images.unsplash.com/photo-1505576399279-565b52d4ac71?q=80&w=500',
        'hong_treo_gio_dalat.jpg' => 'https://images.unsplash.com/photo-1550258987-190a2d41a8ba?q=80&w=500',
        'banh_da_ke_bac_giang.jpg' => 'https://images.unsplash.com/photo-1505576399279-565b52d4ac71?q=80&w=500'
    ];
    
    if (array_key_exists($img_name, $fallbacks)) {
        return $fallbacks[$img_name];
    }
    
    // Default fallback image
    return 'https://images.unsplash.com/photo-1610348725531-843dff163e2c?q=80&w=500';
}

/**
 * [ProductModel] Lấy 8 sản phẩm mặc định cho khu vực Đi Chợ Online trang chủ
 */
function loadall_sanpham_dicho_online(){
    $sql = "SELECT * FROM sanpham WHERE 
            name LIKE '%Cherry Mỹ%' OR 
            name LIKE '%Cam Sành%' OR 
            name LIKE '%Bánh Ép%' OR 
            name LIKE '%Bơ 034%' OR 
            name LIKE '%Bưởi Da Xanh%' OR 
            name LIKE '%Mật Dừa Nước%' OR 
            name LIKE '%Sầu riêng Ri6%'
            ORDER BY id ASC LIMIT 8";
    return pdo_query($sql);
}
?>

