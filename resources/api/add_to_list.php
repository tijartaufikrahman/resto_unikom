<?php
session_start();
require_once __DIR__ . '../../config/config.php';

// Check if this is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON data from the request body
    $json_data = file_get_contents('php://input');

    // Decode JSON data into PHP array
    $data = json_decode($json_data, true);

    // Check if productId is present in the received data
    if (isset($data['productId'])) {
        $productId = $data['productId'];

        // Retrieve product details from database based on productId
        $query_product = "SELECT * FROM `products` WHERE id = $productId";
        $result = mysqli_query($db_conn, $query_product);
        $product = mysqli_fetch_assoc($result);

        // Example: Prepare data for insert or update
        $id_user = $_SESSION['id'];
        $id_food = $product['id'];
        $price = $product['price'];
        $img = $product['image'];

        // Check if the product already exists in order list for this user
        $query_check_exists = "SELECT * FROM `order_list_items` WHERE `id_user` = '$id_user' AND `food_id` = '$id_food' AND status = 'pending'";
        $result_check_exists = mysqli_query($db_conn, $query_check_exists);

        if (mysqli_num_rows($result_check_exists) > 0) {
            // Update quantity if product already exists
            $query_update = "UPDATE `order_list_items` SET `quantity` = `quantity` + 1 WHERE `id_user` = '$id_user' AND `food_id` = '$id_food'";
            if (mysqli_query($db_conn, $query_update)) {
                echo "Quantity updated successfully"; // Send response back to the client
            } else {
                echo "Error updating quantity: " . mysqli_error($db_conn); // Handle database error
            }
        } else {
            // Insert new record if product does not exist
            $query_add_list = "INSERT INTO `order_list_items` (`id_user`, `food_id`, `quantity`, `status`)
                               VALUES ('$id_user', '$id_food', '1', 'pending')";

            if (mysqli_query($db_conn, $query_add_list)) {
                echo "Product added to list successfully"; // Send response back to the client
            } else {
                echo "Error adding product to list: " . mysqli_error($db_conn); // Handle database error
            }
        }
    } else {
        echo "No productId found in data"; // Handle case where productId is missing in received data
    }
} else {
    echo "This is not a POST request"; // Handle case where request method is not POST
}
