<?php
require_once __DIR__ . '../../config/config.php';
session_start();
if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $chef_id = $_SESSION['id'];

    $query = "UPDATE orders 
              SET status_order = 'completed'                  
              WHERE id = $order_id";

    if (mysqli_query($db_conn, $query)) {
        // Jika berhasil, set session success
        $_SESSION['alert'] = array(
            'type' => 'success',
            'message' => 'the order has been delivered.'
        );
    } else {
        // Jika terjadi kesalahan saat query, set session error
        $_SESSION['alert'] = array(
            'type' => 'error',
            'message' => 'Failed to add category.'
        );
    }
    header("Location: " . URL . "/views/admin/index.php?q=serve-food-and-drinks");
    exit;
}
