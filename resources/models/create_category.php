<?php
session_start();
require_once __DIR__ . '../../config/config.php';

if (isset($_POST['name_product']) && isset($_POST['note'])) {
    $category = $_POST['name_product'];
    $note = $_POST['note'];
    $query_insert_category = "INSERT INTO `categories` ( `name_category`, `note`) 
                                VALUES ('$category', '$note')";

    // Lakukan query
    if (mysqli_query($db_conn, $query_insert_category)) {
        // Jika berhasil, set session success
        $_SESSION['alert'] = array(
            'type' => 'success',
            'message' => 'Category added successfully.'
        );
    } else {
        // Jika terjadi kesalahan saat query, set session error
        $_SESSION['alert'] = array(
            'type' => 'error',
            'message' => 'Failed to add category.'
        );
    }
    header("Location: " . URL . "/views/admin/index.php?q=new-category");
    exit;
}
