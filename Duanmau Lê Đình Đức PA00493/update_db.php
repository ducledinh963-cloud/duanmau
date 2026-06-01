<?php
include_once "models/pdo.php";
include_once "models/sanpham.php";

try {
    // 1. Ensure Category 6 exists
    $check_cat = pdo_query_one("SELECT COUNT(*) as cnt FROM danhmuc WHERE id = 6");
    if ($check_cat['cnt'] == 0) {
        // Try inserting it
        pdo_execute("INSERT INTO danhmuc (id, name) VALUES (6, 'Ngon Lành')");
        echo "Inserted Category 6 'Ngon Lành'\n";
    } else {
        echo "Category 6 'Ngon Lành' already exists\n";
    }

    // 2. Update product images with fallback URLs directly in the database
    $products = pdo_query("SELECT id, name, img FROM sanpham");
    $updated_count = 0;
    foreach ($products as $sp) {
        $img = $sp['img'];
        if (!empty($img) && strpos($img, 'http') !== 0) {
            $url = get_product_image($img);
            if (strpos($url, 'http') === 0) {
                pdo_execute("UPDATE sanpham SET img = ? WHERE id = ?", $url, $sp['id']);
                echo "Updated product ID " . $sp['id'] . " (" . $sp['name'] . ") image to: " . $url . "\n";
                $updated_count++;
            }
        }
    }
    echo "\nSuccessfully updated $updated_count product images in the database to direct Unsplash URLs.\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
