<?php
require_once __DIR__ . '../../config/config.php';

if (empty($_POST['search_foods'])) {


    // $query = "SELECT 
    //     products.id,
    //     products.name_product,
    //     products.price,
    //     products.image,
    //     products.stok,
    //     categories.name_category
    // FROM 
    //     products
    // INNER JOIN 
    //     categories
    // ON 
    //     products.category_id = categories.id
    // ORDER BY 
    //     products.id DESC;";

    $query = "SELECT 
    p.*,
    COALESCE(SUM(oli.quantity), 0) AS terjual
    FROM 
        products p
    LEFT JOIN 
        order_list_items oli ON oli.food_id = p.id
    GROUP BY 
        p.id, p.name_product, p.price
    ORDER BY 
        terjual DESC";


    $result7 = mysqli_query($db_conn, $query);
    $reports = mysqli_fetch_all($result7, MYSQLI_ASSOC);
    // var_dump($row);

} else {
}

$query_c = "SELECT * FROM categories";
$result8 = mysqli_query($db_conn, $query_c);
$categories = mysqli_fetch_all($result8, MYSQLI_ASSOC);
