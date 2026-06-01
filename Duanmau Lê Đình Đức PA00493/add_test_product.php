<?php
include_once "models/pdo.php";
include_once "models/sanpham.php";

try {
    // Check if the test products already exist
    $check1 = pdo_query_one("SELECT COUNT(*) as cnt FROM sanpham WHERE name = 'Cà Phê Sữa Đá Sài Gòn (Chai 250ml)'");
    if ($check1['cnt'] == 0) {
        pdo_execute(
            "INSERT INTO sanpham (name, price, img, mota, id_danhmuc) VALUES (?, ?, ?, ?, ?)",
            "Cà Phê Sữa Đá Sài Gòn (Chai 250ml)",
            29000,
            "https://images.unsplash.com/photo-1511920170033-f8396924c348?q=80&w=500",
            "Cà phê sữa đá pha phin chuẩn vị Sài Gòn, thơm béo đậm đà khó cưỡng.",
            4
        );
        echo "Added test product: Cà Phê Sữa Đá Sài Gòn\n";
    } else {
        echo "Test product Cà Phê Sữa Đá Sài Gòn already exists.\n";
    }

    $check2 = pdo_query_one("SELECT COUNT(*) as cnt FROM sanpham WHERE name = 'Trà Chanh Sả Đá Mát Lạnh (Chai 250ml)'");
    if ($check2['cnt'] == 0) {
        pdo_execute(
            "INSERT INTO sanpham (name, price, img, mota, id_danhmuc) VALUES (?, ?, ?, ?, ?)",
            "Trà Chanh Sả Đá Mát Lạnh (Chai 250ml)",
            25000,
            "https://images.unsplash.com/photo-1576092768241-dec231879fc3?q=80&w=500",
            "Trà chanh sả tươi mát lạnh giúp giải nhiệt ngày hè sảng khoái.",
            4
        );
        echo "Added test product: Trà Chanh Sả Đá Mát Lạnh\n";
    } else {
        echo "Test product Trà Chanh Sả Đá Mát Lạnh already exists.\n";
    }

    // Refresh database statistics
    $categories = pdo_query("SELECT id, name FROM danhmuc");
    echo "\n=== UPDATED DATABASE STATISTICS ===\n";
    foreach ($categories as $cat) {
        $count_stmt = pdo_query_one("SELECT COUNT(*) as cnt FROM sanpham WHERE id_danhmuc = ?", $cat['id']);
        echo "ID: " . $cat['id'] . " - " . $cat['name'] . " (" . $count_stmt['cnt'] . " products)\n";
    }
    $total = pdo_query_one("SELECT COUNT(*) as cnt FROM sanpham");
    echo "Total products in database: " . $total['cnt'] . "\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
