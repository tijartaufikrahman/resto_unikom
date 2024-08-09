<?php
require_once __DIR__ . '../../config/config.php';

if (isset($_POST['name_customer']) && isset($_POST['no_table']) && isset($_POST['total'])) {
    $customer_name = $_POST['name_customer'];
    $id_user = $_SESSION['id'];
    $no_table = $_POST['no_table'];
    $note = $_POST['note'];

    // convert to int
    $total = $_POST['total'];
    $total = str_replace('Rp ', '', $total);
    $total = str_replace('.', '', $total);
    $total_int = intval($total);

    $query_orders = "INSERT INTO `orders` (`customer_name`, `id_user`, `id_table`, `status_order`, `note`) 
        VALUES ('$customer_name', '$id_user', '$no_table',  'Pending', '$note')";
    $result5 = mysqli_query($db_conn, $query_orders);
    $last_insert_id = mysqli_insert_id($db_conn);


    $query_update_order_items = "UPDATE order_list_items SET status = 'wait', order_id = $last_insert_id  WHERE id_user = $id_user AND status = 'pending'";

    $result6 = mysqli_query($db_conn, $query_update_order_items);

    // Atur zona waktu ke WIB (Waktu Indonesia Barat)
    date_default_timezone_set('Asia/Jakarta');
    $date = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
    $current_time = $date->format('YmdHis');
    $unique_id = 'MK' . $current_time;

    $query_created_transactions = "INSERT INTO `transactions` (`id`, `customer_name`, `order_id`, `id_user`, `total`, `pay_money`, `refund_money`, `status_order`, `created_at`) 
        VALUES ('$unique_id', '$customer_name', '$last_insert_id', NULL, '$total_int', NULL, NULL, 'Payment Pending', current_timestamp());";
    mysqli_query($db_conn, $query_created_transactions);


    // $query_created_cooking = "INSERT INTO `cookings` (`id`, `order_id`, `chef_id`, `status_cooking`, `created_at`, `updated_at`) 
    //     VALUES (NULL, '$last_insert_id', NULL,'pending', NULL, NULL);";
    // mysqli_query($db_conn, $query_created_cooking);


    $_SESSION['success_message'] = "Transaction successfully added.";
    header("Location: " . URL . "/views/admin/index.php?q=order-list");
    // header('Location: http://localhost/resto_unikom/resources/views/admin/index.php?q=order-list');
    exit;
}
