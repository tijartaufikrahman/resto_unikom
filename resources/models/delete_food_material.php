<?php
session_start();
require_once __DIR__ . '../../config/config.php';

if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $query_delete_category = "DELETE FROM `food__materials` WHERE `id` = '$delete_id'";

    // Lakukan query
    if (mysqli_query($db_conn, $query_delete_category)) {
        // Jika berhasil, set session success
        $_SESSION['alert'] = array(
            'type' => 'success',
            'message' => 'Food Material Delete successfully.'
        );
    } else {
        // Jika terjadi kesalahan saat query, set session error
        $_SESSION['alert'] = array(
            'type' => 'error',
            'message' => 'Failed to add category.'
        );
    }
    header("Location: " . URL . "/views/admin/index.php?q=food-materials");
    exit;
}
