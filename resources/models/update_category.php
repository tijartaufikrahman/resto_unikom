<?php
session_start();
require_once __DIR__ . '../../config/config.php';
if (isset($_POST['update_id'])) {

    $id = $_POST['update_id'];
    $category = $_POST['name_product'];
    $note = $_POST['note'];

    $query_update_category = "UPDATE `categories` SET 
                              `name_category` = '$category', 
                              `note` = '$note' 
                              WHERE `id` = $id";


    // Lakukan query
    if (mysqli_query($db_conn, $query_update_category)) {
        // Jika berhasil, set session success
        $_SESSION['alert'] = array(
            'type' => 'success',
            'message' => 'Category updated successfully.'
        );
    } else {
        // Jika terjadi kesalahan saat query, set session error
        $_SESSION['alert'] = array(
            'type' => 'error',
            'message' => 'Failed to add category.'
        );
    }
    header("Location: " . URL . "/views/admin/index.php?q=new-category");
    // header("Location: http://localhost/resto_unikom/resources/views/admin/index.php?q=new-category");
    exit;
}
