<?php
require_once __DIR__ . '../../config/config.php';
$query = "SELECT 
    o.id AS order_id,
    o.customer_name,
    o.id_user,
    o.id_table,
    o.status_order,
    o.note AS order_note,
    o.created_at AS order_created_at,
    oli.id AS order_list_item_id,
    oli.food_id,
    oli.quantity,
    
    oli.status AS order_list_item_status,
    oli.created_at AS order_list_item_created_at,
    oli.updated_at AS order_list_item_updated_at,
    p.name_product,
    p.category_id,
    p.stok,
    p.price AS product_price,
    p.image AS product_image,
    p.created_at AS product_created_at,
    p.updated_at AS product_updated_at
FROM 
    orders o
LEFT JOIN 
    order_list_items oli ON o.id = oli.order_id
LEFT JOIN 
    products p ON oli.food_id = p.id
WHERE 
    o.status_order = 'pending'";

$result = mysqli_query($db_conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($db_conn));
}

$orders = [];

while ($row = mysqli_fetch_assoc($result)) {
    $order_id = $row['order_id'];

    if (!isset($orders[$order_id])) {
        $orders[$order_id] = [
            'order_id' => $row['order_id'],
            'customer_name' => $row['customer_name'],
            'id_user' => $row['id_user'],
            'id_table' => $row['id_table'],
            'status_order' => $row['status_order'],
            'order_note' => $row['order_note'],
            'order_created_at' => $row['order_created_at'],
            'items' => []
        ];
    }

    $orders[$order_id]['items'][] = [
        'order_list_item_id' => $row['order_list_item_id'],
        'food_id' => $row['food_id'],
        'quantity' => $row['quantity'],
        'order_list_item_price' => $row['product_price'],
        // 'order_list_item_note' => $row['order_list_item_note'],
        'order_list_item_status' => $row['order_list_item_status'],
        'order_list_item_img' => $row['product_image'],
        'order_list_item_created_at' => $row['order_list_item_created_at'],
        'order_list_item_updated_at' => $row['order_list_item_updated_at'],
        'name_product' => $row['name_product'],
        'category_id' => $row['category_id'],
        'stok' => $row['stok'],
        'product_price' => $row['product_price'],
        'product_image' => $row['product_image'],
        'product_created_at' => $row['product_created_at'],
        'product_updated_at' => $row['product_updated_at']
    ];
}

mysqli_close($db_conn);

$json_data = json_encode(array_values($orders), JSON_PRETTY_PRINT);
echo $json_data;
