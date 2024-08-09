<?php
session_start();
require_once __DIR__ . '../../config/config.php';





if (isset($_POST['id_transaction']))
    if (isset($_POST['id_transaction']) && $_POST['cash'] != '' && $_POST['change'] >= 0) {

        $id = $_POST['id_transaction'];
        $cash = $_POST['cash'];
        $change = $_POST['change'];

        $id_user = $_SESSION['id'];


        date_default_timezone_set('Asia/Jakarta');

        $datetime = new DateTime();
        $date =  $datetime->format('Y-m-d H:i:s');


        $query = "UPDATE transactions 
              SET id_user = '$id_user',
                  pay_money = '$cash',
                  refund_money = '$change',
                  status_order = 'Paid',
                  date = '$date'
              WHERE id = '$id'";

        if (mysqli_query($db_conn, $query)) {

            $query_table = "SELECT t.id,t.customer_name,o.id_table,p.name_product,oli.quantity,p.price,
            t.total,t.pay_money,t.refund_money,t.date,t.created_at
            FROM 
                transactions t
            JOIN 
                orders o ON t.order_id = o.id
            JOIN 
                order_list_items oli ON o.id = oli.order_id
            JOIN 
                products p ON oli.food_id = p.id WHERE t.id = '$id'
            ";
            $result_table = mysqli_query($db_conn, $query_table);
            $row = mysqli_fetch_all($result_table, MYSQLI_ASSOC);

            // var_dump($row);
?>
        <!-- Link bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <div class="col-3 bg-white struk-custom">
            <h5 class="text-center pt-2">MARTABAKKU</h5>
            <h5 class="text-center fw-normal" style="font-size: 14px;"><?= $row[0]['date']; ?></h5>
            <table style="width: 100%;">
                <tr>
                    <td>INVOICE</td>
                    <td><?= $row[0]['id']; ?></td>
                </tr>
                <tr>
                    <td>TABLE</td>
                    <td>1</td>
                </tr>
            </table>
            <!-- <span>-------------------------------------------</span> -->
            <table class="mx-5 ">
                <!-- <tr>
                    <td>Name Product</td>
                    <td>Price</td>
                    <td>Qunatiry</td>
                </tr> -->
                <?php foreach ($row as $d) : ?>
                    <tr>
                        <td><?= $d['name_product']; ?></td>
                        <td>Rp <?= $d['price']; ?></td>
                        <td class="text-center"><?= $d['quantity']; ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3">-------------------------------------------</td>
                </tr>
                <tr>
                    <td>
                        <h5>Total </h5>
                    </td>
                    <td>
                        <h5>Rp <?= $d['total']; ?></h5>
                    </td>
                <tr>
                    <td>Cash</td>
                    <td>Rp <?= $d['pay_money']; ?></td>
                </tr>
                <tr>
                    <td>Change</td>
                    <td>Rp <?= $d['refund_money']; ?></td>
                </tr>
                <tr>
                    <td colspan="3">==========================</td>
                </tr>
            </table>
            <!-- <span>----------------------------------------------------------------</span> -->
        </div>







<?php



            $_SESSION['alert'] = array(
                'type' => 'success',
                'message' => 'payment successful'
            );
        } else {
            $_SESSION['alert'] = array(
                'type' => 'error',
                'message' => 'Failed to add category.'
            );
        }

        echo '<script type="text/javascript">';
        echo 'setTimeout(function() {';
        echo '  window.location.href="' . URL . '/views/admin/index.php?q=payment";'; // Redirect after printing
        echo '}, 1000);'; // Wait 1 second before redirecting
        echo 'var printContents = document.querySelector(".struk-custom").outerHTML;';
        echo 'var originalContents = document.body.innerHTML;';
        echo 'document.body.innerHTML = printContents;';
        echo 'window.focus();'; // Focus on the new window/tab
        echo 'window.print();'; // Print the content
        echo 'document.body.innerHTML = originalContents;'; // Restore original content
        echo '</script>';
        exit();
    } else {
        $_SESSION['alert'] = array(
            'type' => 'error',
            'message' => 'payment failed!'
        );
    }
?>