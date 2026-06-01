<?php
include_once "models/pdo.php";
try {
    $categories = pdo_query("SELECT id, name FROM danhmuc");
    echo "=== CATEGORIES ===\n";
    foreach ($categories as $cat) {
        $count_stmt = pdo_query_one("SELECT COUNT(*) as cnt FROM sanpham WHERE id_danhmuc = ?", $cat['id']);
        echo "ID: " . $cat['id'] . " - " . $cat['name'] . " (" . $count_stmt['cnt'] . " products)\n";
    }
    
    $total = pdo_query_one("SELECT COUNT(*) as cnt FROM sanpham");
    echo "\nTotal products in database: " . $total['cnt'] . "\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
