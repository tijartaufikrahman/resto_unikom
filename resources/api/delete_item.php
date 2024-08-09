<?php
require_once __DIR__ . '../../config/config.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['productId'])) {
    $productId = $data['productId'];


    // Query untuk menghapus item dari daftar pesanan
    $sql = "DELETE FROM order_list_items WHERE id = $productId";

    if ($db_conn->query($sql) === TRUE) {
        echo "Item deleted successfully";
    } else {
        echo "Error deleting item: " . $conn->error;
    }

    $db_conn->close();
} else {
    http_response_code(400);
    echo "Invalid request";
}
