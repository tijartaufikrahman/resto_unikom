<?php
require_once __DIR__ . '../../config/config.php';


// Fetch order list items from the database
$query_list_items = "
    SELECT oli.*, p.name_product, p.price, p.image
    FROM order_list_items oli
    INNER JOIN products p ON oli.food_id = p.id
    WHERE oli.status = 'pending'
";


$result4 = mysqli_query($db_conn, $query_list_items);

if ($result4) {
    $order_list_items = mysqli_fetch_all($result4, MYSQLI_ASSOC);
    echo json_encode($order_list_items);
} else {
    echo json_encode(['error' => 'Failed to fetch data']);
}
