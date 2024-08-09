<?php

session_start();
require_once __DIR__ . '../../config/config.php';

if (isset($_POST['submit'])) {
    $product = $_POST['name_product'];
    $category = $_POST['category'];
    $status = $_POST['status'];
    $harga = $_POST['harga'];
    $image = $_FILES['image']['name'];



    $bahan = $_POST['ingredients'];
    $qty = $_POST['qty'];



    // var_dump($bahan);

    // var_dump($qty);


    // Stop
    // die;
    // ENd Stop


    $fileExtension = pathinfo($image, PATHINFO_EXTENSION);
    $newFileName = 'image_' . $product . '.' . $fileExtension;

    // var_dump($_FILES);
    $uploadDir = '../../public/img/'; // Direktori untuk menyimpan file yang diupload    
    $uploadFile = $uploadDir . basename($newFileName); // Path lengkap file yang diupload
    move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile);



    $query = "INSERT INTO `products` (`id`, `name_product`, `category_id`, `stok`, `price`, `image`) 
    VALUES (NULL, '$product', $category, $status, $harga, '$newFileName')";

    // Lakukan query
    if ($data = mysqli_query($db_conn, $query)) {

        $id_product = mysqli_insert_id($db_conn);

        $i = 0;
        foreach ($bahan as $b) {

            $qty_ = $qty[$i];

            $query_bahan = "INSERT INTO `product_materials` ( `id_product`, `id_material`, `qty`) 
            VALUES ( '$id_product', '$b', '$qty_');";

            mysqli_query($db_conn, $query_bahan);

            $i++;
        }





        // die;

        // Jika berhasil, set session success
        $_SESSION['alert'] = array(
            'type' => 'success',
            'message' => 'Food added successfully.'
        );
    } else {
        // Jika terjadi kesalahan saat query, set session error
        $_SESSION['alert'] = array(
            'type' => 'error',
            'message' => 'Failed to add category.'
        );
    }
    header("Location: " . URL . "/views/admin/index.php?q=new-foods");
    exit;
}
