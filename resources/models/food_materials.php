<?php
require_once __DIR__ . '../../config/config.php';

if (isset($_POST['search_food_materials'])) {
    $search = $_POST['search_category'];
    $query_category = "SELECT * FROM categories WHERE name_category LIKE '%$search%'";
    $result8 = mysqli_query($db_conn, $query_category);
    $categories = mysqli_fetch_all($result8, MYSQLI_ASSOC);
    // var_dump($categories);
} else {
    $query_food_materials = "SELECT * FROM food__materials";
    $result8 = mysqli_query($db_conn, $query_food_materials);
    $food_materials = mysqli_fetch_all($result8, MYSQLI_ASSOC);
    // var_dump($categories);
}
