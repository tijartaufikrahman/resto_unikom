<?php
require_once __DIR__ . '../../config/config.php';

$query_products = "SELECT c.id AS category_id, c.name_category, p.id AS product_id, p.name_product, p.price, p.stok, p.image
                   FROM categories c
                   LEFT JOIN products p ON c.id = p.category_id
                   WHERE 1=1";

// Menambahkan parameter pencarian jika tersedia
if (!empty($_GET['search'])) {
    $check_search = $_GET['search'];

    $search = '%' . $_GET['search'] . '%';
    $query_products .= " AND (p.name_product LIKE '" . mysqli_real_escape_string($db_conn, $search) . "' OR c.name_category LIKE '" . mysqli_real_escape_string($db_conn, $search) . "')";
}

$query_products .= " ORDER BY c.id, p.price DESC";
$result3 = mysqli_query($db_conn, $query_products);
$categories = mysqli_fetch_all($result3, MYSQLI_ASSOC);







// $query_products = "SELECT c.id AS category_id, c.name_category, p.id AS product_id, p.name_product, p.price,
// p.stok,p.image FROM categories c LEFT JOIN products p ON c.id = p.category_id
// ORDER BY c.id, p.price DESC;";





// print_r($categories);

$groupedCategories = [];
foreach ($categories as $item) {
    $groupedCategories[$item['category_id']]['name_category'] = $item['name_category'];
    $groupedCategories[$item['category_id']]['products'][] = [
        'product_id' => $item['product_id'],
        'name_product' => $item['name_product'],
        'price' => $item['price'],
        'stok' => $item['stok'],
        'image' => $item['image']
    ];
}
