<?php
require_once __DIR__ . '../../config/config.php';

if (isset($_POST['search_category'])) {
    $search = $_POST['search_category'];
    $query_category = "SELECT * FROM categories WHERE name_category LIKE '%$search%'";
    $result8 = mysqli_query($db_conn, $query_category);
    $categories = mysqli_fetch_all($result8, MYSQLI_ASSOC);
    // var_dump($categories);
} else {
    $query_category = "SELECT * FROM categories";
    $result8 = mysqli_query($db_conn, $query_category);
    $categories = mysqli_fetch_all($result8, MYSQLI_ASSOC);
    // var_dump($categories);
}
