<?php
require_once __DIR__ . '../../config/config.php';

if (empty($_POST['search_foods'])) {

    $query_food = "SELECT 
    products.id,
    products.category_id,
    products.name_product,
    products.price,
    products.image,
    products.stok,
    categories.name_category

FROM 
    products
INNER JOIN 
    categories
ON 
    products.category_id = categories.id
WHERE
    products.stok  > 0
ORDER BY 
    products.id DESC;";

    $result7 = mysqli_query($db_conn, $query_food);
    $foods = mysqli_fetch_all($result7, MYSQLI_ASSOC);
    // var_dump($row);


    $query_food_out = "SELECT 
    products.id,
    products.category_id,
    products.name_product,
    products.price,
    products.image,
    products.stok,
    categories.name_category
FROM 
    products
INNER JOIN 
    categories
ON 
    products.category_id = categories.id 
WHERE
    products.stok  <= 0
ORDER BY 
    products.id DESC;";

    $result_out = mysqli_query($db_conn, $query_food_out);
    $foods_out = mysqli_fetch_all($result_out, MYSQLI_ASSOC);
    // var_dump($row);

} else {
}

$query_c = "SELECT * FROM categories";
$result8 = mysqli_query($db_conn, $query_c);
$categories = mysqli_fetch_all($result8, MYSQLI_ASSOC);


$query_bahan = "SELECT * FROM food__materials";
$result_bahan = mysqli_query($db_conn, $query_bahan);
$bahan_baku = mysqli_fetch_all($result_bahan, MYSQLI_ASSOC);
$bahan_baku2 = mysqli_fetch_all($result_bahan, MYSQLI_ASSOC);
