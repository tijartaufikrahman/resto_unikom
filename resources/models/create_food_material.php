<?php
session_start();
require_once __DIR__ . '../../config/config.php';

if (
    isset($_POST['name_food_material']) && isset($_POST['stok'])  &&
    isset($_POST['note_material'])
) {
    $name_food = $_POST['name_food_material'];
    $stock = $_POST['stok'];
    $note = $_POST['note_material'];
    $query_insert_materials = "INSERT INTO `food__materials` ( `name_material`, `stock`,  `note_material`) 
                                VALUES ('$name_food', '$stock','$note')";

    // Lakukan query
    if (mysqli_query($db_conn, $query_insert_materials)) {
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
    header("Location: " . URL . "/views/admin/index.php?q=food-materials");
    exit;
}
