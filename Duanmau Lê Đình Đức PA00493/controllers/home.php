<?php
class home {
    /**
     * Hiển thị trang chủ và load các sản phẩm mới, top view, đi chợ online
     */
    public function index() {
        $sp_new = [];
        $sp_top10 = [];
        $sp_dicho = [];
        $listtintuc = [];
        
        try {
            $sp_new = loadall_sanpham_home();
        } catch (Exception $e) {}
        
        try {
            $sp_top10 = loadall_sanpham_top10();
        } catch (Exception $e) {}
        
        try {
            $sp_dicho = loadall_sanpham("", 0, 0, 0);
        } catch (Exception $e) {}
        
        try {
            $listtintuc = loadall_tintuc();
        } catch (Exception $e) {}
        
        include "views/home.php";
    }
    
    /**
     * Trang Giới thiệu
     */
    public function gioithieu() {
        include "views/gioithieu.php";
    }
    
    /**
     * Trang Liên hệ
     */
    public function lienhe() {
        include "views/lienhe.php";
    }
}
?>
