<?php
/**
 * Lấy thống kê sản phẩm theo danh mục
 */
function loadall_thongke_sanpham() {
    $sql = "SELECT dm.id as iddm, dm.name as tendm, 
                   COUNT(sp.id) as countsp, 
                   IFNULL(MIN(sp.price), 0) as minprice, 
                   IFNULL(MAX(sp.price), 0) as maxprice, 
                   IFNULL(AVG(sp.price), 0) as avgprice
            FROM danhmuc dm 
            LEFT JOIN sanpham sp ON dm.id = sp.id_danhmuc 
            GROUP BY dm.id, dm.name 
            ORDER BY dm.id ASC";
    return pdo_query($sql);
}

/**
 * Lấy tổng hợp doanh thu và số lượng đơn hàng
 */
function load_revenue_statistics() {
    $sql = "SELECT 
                COUNT(id) as total_orders,
                SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) as pending_orders,
                SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) as shipping_orders,
                SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) as completed_orders,
                SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as canceled_orders,
                IFNULL(SUM(CASE WHEN status = 2 THEN total_amount ELSE 0 END), 0) as total_revenue
            FROM donhang";
    return pdo_query_one($sql);
}

/**
 * Lấy tổng số khách hàng (role = 0)
 */
function count_total_customers() {
    $sql = "SELECT COUNT(*) as total_customers FROM taikhoan WHERE role = 0";
    $result = pdo_query_one($sql);
    return $result['total_customers'] ?? 0;
}

/**
 * Lấy top 5 sản phẩm bán chạy nhất từ các đơn hàng đã giao thành công (status = 2)
 */
function load_top_selling_products() {
    $sql = "SELECT dhct.product_name, 
                   SUM(dhct.quantity) as quantity_sold, 
                   SUM(dhct.quantity * dhct.price) as revenue
            FROM donhang_chitiet dhct
            JOIN donhang dh ON dhct.id_donhang = dh.id
            WHERE dh.status = 2
            GROUP BY dhct.id_sanpham, dhct.product_name
            ORDER BY quantity_sold DESC, revenue DESC
            LIMIT 5";
    return pdo_query($sql);
}
?>
