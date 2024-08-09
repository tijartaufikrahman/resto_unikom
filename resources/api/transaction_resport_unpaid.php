<?php require_once __DIR__ . '../../config/config.php';
session_start();

// Asumsikan $conn adalah koneksi database Anda
$query = "
SELECT 
t.id, 
t.customer_name, 
o.id_table, 
p.name_product, 
oli.quantity, 
p.price,
t.total, 
t.status_order,
t.pay_money, 
t.refund_money, 
t.date, 
t.created_at
FROM 
transactions t
JOIN 
orders o ON t.order_id = o.id
JOIN 
order_list_items oli ON o.id = oli.order_id
JOIN 
products p ON oli.food_id = p.id 
WHERE 
t.status_order = 'Payment Pending'
ORDER BY 
t.date DESC;
";

$result = mysqli_query($db_conn, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $transaction_id = $row['id'];
    if (!isset($data[$transaction_id])) {
        $data[$transaction_id] = [
            'id' => $row['id'],
            'customer_name' => $row['customer_name'],
            'id_table' => $row['id_table'],
            'products' => [],
            'total' => $row['total'],
            'status_order' => $row['status_order'],
            'pay_money' => $row['pay_money'],
            'refund_money' => $row['refund_money'],
            'date' => $row['date'],
            'created_at' => $row['created_at']
        ];
    }

    $data[$transaction_id]['products'][] = [
        'name_product' => $row['name_product'],
        'quantity' => $row['quantity'],
        'price' => $row['price']
    ];
}

$jsonData = json_encode(array_values($data), JSON_PRETTY_PRINT);

echo $jsonData;
