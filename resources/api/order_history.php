<?php
require_once __DIR__ . '../../config/config.php';
session_start();
// $query = "SELECT orders.id,
// orders.customer_name,
// orders.id_user,
// orders.id_table,
// orders.id_chef,
// orders.status_order,
// orders.note,
// orders.created_at, order_list_items.quantity, products.name_product
// FROM orders
// JOIN order_list_items ON orders.id = order_list_items.order_id
// JOIN products ON order_list_items.food_id = products.id WHERE status_order = 'completed'";
// $result = mysqli_query($db_conn, $query);
// $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);



$id = $_SESSION['id'];
$query = "SELECT orders.id,
orders.customer_name,
orders.id_user,
orders.id_table,
orders.id_chef,
orders.status_order,
orders.note,
orders.created_at,
order_list_items.quantity,
products.name_product,
chef_users.name AS chef_name,
user_users.name AS waiter_name
FROM orders
JOIN order_list_items ON orders.id = order_list_items.order_id
JOIN products ON order_list_items.food_id = products.id
JOIN users AS chef_users ON orders.id_chef = chef_users.id
JOIN users AS user_users ON orders.id_user = user_users.id
WHERE status_order = 'completed' OR status_order = 'done'
ORDER BY orders.created_at DESC;
";
// AND  id_chef = '$id'
$result = mysqli_query($db_conn, $query);

$orders = [];
while ($row = mysqli_fetch_assoc($result)) {
    $order_id = $row['id'];
    if (!isset($orders[$order_id])) {
        $orders[$order_id] = [
            'id' => $row['id'],
            'customer_name' => $row['customer_name'],
            'id_user' => $row['id_user'],
            'id_table' => $row['id_table'],
            'id_chef' => $row['id_chef'],
            'chef_name' => $row['chef_name'], // Menambahkan chef_name
            'waiter_name' => $row['waiter_name'], // Menambahkan chef_name
            'status_order' => $row['status_order'],
            'note' => $row['note'],
            'created_at' => $row['created_at'],
            'order_list_items' => []
        ];
    }
    $orders[$order_id]['order_list_items'][] = [
        'quantity' => $row['quantity'],
        'name_product' => $row['name_product']
    ];
}

$orders = array_values($orders); // Optional: re-index array to get a plain array of orders

echo json_encode($orders, JSON_PRETTY_PRINT);
