<?php
session_start();
require_once __DIR__ . '../../config/config.php';
if (isset($_POST['update_id'])) {

    $id = $_POST['update_id'];

    $name_food = $_POST['name_food_material'];
    $stock = $_POST['stok'];
    $note = $_POST['note_material'];

    $query_update_materials = "UPDATE `food__materials` SET 
                              `name_material` = '$name_food', 
                              `stock` = '$stock',                               
                              `note_material` = '$note' 
                              WHERE `id` = $id";


    // Lakukan query
    if (mysqli_query($db_conn, $query_update_materials)) {
        // Jika berhasil, set session success
        $_SESSION['alert'] = array(
            'type' => 'success',
            'message' => 'Material updated successfully.'
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
