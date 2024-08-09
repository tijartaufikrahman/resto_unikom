<?php

session_start();
require_once __DIR__ . '../../config/config.php';

if (isset($_POST['update'])) {
    $edit_id = $_POST['edit_id'];
    $product = $_POST['name_product'];
    $category = $_POST['category'];
    $status = $_POST['status'];
    $harga = $_POST['harga'];

    $newFileName = '';
    $image_baru = $_FILES['image_baru']['name'];



    // print_r($_FILES);
    // die;

    if (($_FILES['image_baru']['name'] != null)) {
        $image = $image_baru;

        $fileExtension = pathinfo($image, PATHINFO_EXTENSION);
        $newFileName = 'image_' . $product . '.' . $fileExtension;

        // var_dump($_FILES);
        $uploadDir = '../../public/img/'; // Direktori untuk menyimpan file yang diupload    
        $uploadFile = $uploadDir . basename($newFileName); // Path lengkap file yang diupload
        move_uploaded_file($_FILES['image_baru']['tmp_name'], $uploadFile);
    } else {
        $newFileName = $_POST['image'];
    }



    $bahan = $_POST['ingredients2'];
    $qty = $_POST['qty2'];

    // print_r($_POST);

    // var_dump($qty);

    // echo $edit_id;


    // Stop
    // var_dump($bahan);
    // var_dump($edit_id);
    // die;
    // ENd Stop





    $query = "UPDATE products
                SET name_product = '$product',
                    category_id = '$category',
                    stok = '$status',
                    price = '$harga',
                    image = '$newFileName'                    
                WHERE id = $edit_id";

    // Lakukan query
    if ($data = mysqli_query($db_conn, $query)) {



        mysqli_query($db_conn, "DELETE FROM product_materials WHERE id_product = $edit_id");

        $i = 0;
        foreach ($bahan as $b) {

            $qty_ = $qty[$i];

            $query_bahan = "INSERT INTO `product_materials` ( `id_product`, `id_material`, `qty`) 
            VALUES ( '$edit_id', '$b', '$qty_');";

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
