<?php
require_once __DIR__ . '../../config/config.php';
session_start();
if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $chef_id = $_SESSION['id'];

    // SET status_order = 'in proses'                  
    $query = "UPDATE orders 
               SET status_order = 'done'                  
              WHERE id = $order_id";




    $query_cari_produk_qty = "SELECT oli.food_id, oli.quantity
    FROM orders o 
    JOIN order_list_items oli ON o.id = oli.order_id
    WHERE o.id = $order_id";

    $sql_product = mysqli_query($db_conn, $query_cari_produk_qty);
    $row_product = mysqli_fetch_all($sql_product, MYSQLI_ASSOC);

    // var_dump($row_product);
    foreach ($row_product as $r) {
        for ($i = 0; $i < $r['quantity']; $i++) {
            // echo "<br>";
            // echo $r['food_id'];


            $id_product = $r['food_id'];
            $query_min_bahan = "SELECT fm.name_material,fm.id,pm.qty
                FROM products p 
                JOIN product_materials pm ON p.id = pm.id_product 
                JOIN food__materials fm ON pm.id_material = fm.id 
                WHERE p.id= $id_product";

            $sql_product_bahan = mysqli_query($db_conn, $query_min_bahan);
            $row_bahan_product = mysqli_fetch_all($sql_product_bahan, MYSQLI_ASSOC);

            // var_dump($row_bahan_product);
            // die;

            foreach ($row_bahan_product as $rbp) {
                $id_bahan = $rbp['id'];
                $queri_bahan = "SELECT * FROM `food__materials` WHERE id = $id_bahan";
                $sql_tampil_bahan = mysqli_query($db_conn, $queri_bahan);
                $row_tampil_bahan = mysqli_fetch_all($sql_tampil_bahan, MYSQLI_ASSOC);

                $total = $row_tampil_bahan[0]['stock'] - $rbp['qty'];

                echo "<br>";
                echo $row_tampil_bahan[0]['name_material'];
                echo "<br>";
                echo $total;
                echo "<br>";


                $query_min_material = "UPDATE food__materials
                SET stock = $total
                WHERE id = $id_bahan";

                mysqli_query($db_conn, $query_min_material);
            }
        }
    }
    // die;


    if (mysqli_query($db_conn, $query)) {
        // Jika berhasil, set session success
        $_SESSION['alert'] = array(
            'type' => 'success',
            'message' => 'Order Status Done successfully.'
        );
    } else {
        // Jika terjadi kesalahan saat query, set session error
        $_SESSION['alert'] = array(
            'type' => 'error',
            'message' => 'Failed to add category.'
        );
    }
    header("Location: " . URL . "/views/admin/index.php?q=orderhandling-food-preparation");
    exit;
}
